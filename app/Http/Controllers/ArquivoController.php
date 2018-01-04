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

    public function showProfiles($folder, $filename)
    {
    	if(Storage::exists('public/'. $folder . '/' . $filename)){
        	return response()->file(Storage_path('app/public/'. $folder . '/' .$filename));
		}
		else{
			return "Esse arquivo não existe ou foi deletado";
        }
    }
}
