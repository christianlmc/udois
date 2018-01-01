<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ArquivoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($filename)
    {
    	if(Storage::exists('public/'.$filename)){
        	// return response()->download(Storage_path('app/public/'.$filename), null, [], null);
        	return response()->file(Storage_path('app/public/'.$filename));
		}
		else{
			return "Esse arquivo não existe ou foi deletado";
        }
    }
}
