<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumeroController extends Controller
{

    public function getNumero(Request $request){
    	$sesion = $request->session();
    	if($sesion->has('storage') == False){
			$sesion->put('storage', array());
    	}
    	$numero = null;
    	while($numero == null){
    		$numero = rand();
    		if(in_array($numero, $sesion->get('storage'))){
    			$numero = null;
    		}
    		else{
    			$sesion->push('storage', $numero);
    		}
    	}
    	return $numero;
    }

    public function postNumero(Request $request){
    	if($request->session()->has('storage') == True){
    		return json_encode($request->session()->get('storage'));
    	}
    	else{
    		return json_encode([]);
    	}
    }
}
