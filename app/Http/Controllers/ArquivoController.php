<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ArquivoController extends Controller
{
    public function showProfile($filename)
    {
    	if(Storage::exists('public/profiles/' . $filename)){
        	return response()->file(Storage_path('app/public/profiles/' .$filename));
		}
		else{
			return "Esse arquivo não existe ou foi deletado";
        }
    }

    public function showBanner($filename)
    {
        if(Storage::exists('public/banners/' . $filename)){
            return response()->file(Storage_path('app/public/banners/' .$filename));
        }
        else{
            return "Esse arquivo não existe ou foi deletado";
        }
    }
}
