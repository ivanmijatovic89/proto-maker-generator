<?php

namespace ivanmijatovic89\ProtoViewGenerator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Session;

class ProtoMakerController extends Controller {

	public function __construct()
	{
		// $this->middleware('auth');
	}

	
	public function index()
	{
		return view('protomaker::index');
	}

}
