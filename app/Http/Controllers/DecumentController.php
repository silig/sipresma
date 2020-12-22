<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DecumentController extends Controller
{
    
    public function Proposal($file){
    	 $a = ViewPDF::proposal($file);
    	 return response()->$a;
    }
    public function SuratUndangan($file){
    	
    	 ViewPDF::suratundangan($file);
    	 
    }
}
