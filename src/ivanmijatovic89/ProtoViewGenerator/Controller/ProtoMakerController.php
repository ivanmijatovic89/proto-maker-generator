<?php

namespace ivanmijatovic89\ProtoViewGenerator\Controller;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;

class ProtoMakerController extends Controller {

	public function __construct()
	{

	}

	
	public function index()
	{

//        $a = Artisan::call('proto category --fields=\'{"name":{"type":"text"},"description":{"type":"text"}}\'');
//        print_r($a);
//        die();
        $tables = $this->getTables();
		return view('protomaker::index',['tables'=>$tables] );
	}


    public function getTables()
    {
        $allTable = DB::select('SHOW TABLES');
        foreach($allTable as $table)
        {
            $t = $table->Tables_in_jsonmodul;
            if($t != 'migrations'){
                $tables[] = $t;
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
