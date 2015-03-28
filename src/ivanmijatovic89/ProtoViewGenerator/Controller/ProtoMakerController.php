<?php

namespace ivanmijatovic89\ProtoViewGenerator\Controller;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;

//Proto create
use dam1r89\ProtoGenerator\ContextDataParser;
use dam1r89\ProtoGenerator\Proto;

class ProtoMakerController extends Controller {

    private $templatesPath;

	public function __construct()
	{
        $this->templatesPath = base_path().'/vendor/dam1r89/proto-generator/src/dam1r89/ProtoGenerator/templates/';

        ///Users/mijat/Projects/damir/vendor/dam1r89/proto-generator/src/dam1r89/ProtoGenerator/templates/standard
        // Users/mijat/Projects/damir/vendor/dam1r89/proto-generator/src/dam1r89/ProtoGenerator/templates/standard
	}


	public function index()
	{

//        $a = Artisan::call('proto category --fields=\'{"name":{"type":"text"},"description":{"type":"text"}}\'');
//        print_r($a);
//        die();
        $tables = $this->getTables();
//		return view('protomaker::tests',['tables'=>$tables]);
		return view('protomaker::index',['tables'=>$tables] );
	}

    public function protoMakeCrud()
    {


        $model  = \Request::get('model');
        $fields = \Request::get('fields');

        $template = \Request::get('template');
        $output   = \Request::get('output');

        $namespace = \Request::get('namespace');

        $parser = new ContextDataParser(   $model  , $fields  );
        $context = $parser->getContextData();

        //  --data here
        if(isset($namespace) AND !empty($namespace)){
            $context['namespace'] = $namespace;
        }else{
            $context['namespace'] = 'App\\';
        }



        // Init Message
        $msg = '';

        // create Crud
        $p = Proto::create( $this->templatesPath . $template , base_path().'/'.$output , $context);

        $msg .= "Model/Modul name: <b>".$model."</b><br>";
        $msg .= "Namespace: <b>".$context['namespace']."</b><br>";
        $msg .= "Template: <b>$template</b><br>";
        $msg .= "Output folder: <b>$output</b><br>";
        $msg .= '<b>Fields</b> : ';
        foreach($fields as $field =>$val){
            $msg .= $field .' ,';
        }
        $msg .= '<hr>';

        // all Generated Files
        foreach ($p->getFiles() as $file) {
                $msg .= substr($file->dest, strlen(base_path()) + 1) . "<br>";
        }

        if($template == 'modul'){
            // Module Template
            $msg .= '<br>Generating routes.php inside module '.ucfirst($model).' folder. '.$output. "/Http/routes.php <br>";
            $msg .= 'to migrate type command : php artisan module:migrate '.$model;

        }elseif($template == 'standard' OR $template = 'translate'){
            // Standard template
            $msg .= "<br><b>Add to the routes:</b>" . "<br>";
            $msg .= "Route::model('".$context['collection']."', '".$context['namespace']."Models\\".$context['model']."');" . "<br>";
            $msg .= "Route::resource('".$context['collection']."', '".$context['controller']."Controller'); " . "<br><br>";
            $msg .= "Do not forget to run <b>php artisan migrate</b> " . "<br>";
        }

        if($p->generate(true)){
            $response = "<h2>You successfully create CRUD for <b>".$context['model']."</b></h2><br>". $msg;
            return \Response::json(['status'=>200,'msg'=>$response ]);
        }else{
            return \Response::json(['status'=>400,'msg'=>'There was an Error' ]);
        }
        return;
    }

    public function docs()
    {
        return view('protomaker::docs');
    }



    public function getTables()
    {
        $allTable = DB::select('SHOW TABLES');

        $name = 'Tables_in_'.DB::connection()->getDatabaseName();
        foreach($allTable as $table)
        {
            if ($table->$name != 'migrations') {
                $tables[] = $table->$name;
            }
        }

        if(isset($tables)) {
            foreach ($tables as $table) {
                $fields = \Illuminate\Support\Facades\Schema::getColumnListing($table);
                foreach ($fields as $field) {
                    $data[$table][] = $field;
                }
            }
            return $data;
        }else{
            return [];
        }

    }

}
