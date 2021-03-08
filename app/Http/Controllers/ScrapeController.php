<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ScrapeController extends Controller
{

	public function __construct()
	{
		ini_set('max_execution_time', 1000);
	}


	public function solo(){
		
		return view('solo');
	}


    public function onePage($url){

   	$text = file_get_contents($url);
  
   	if (!empty($text)) {
   		$pattern = "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
    	$res = preg_match_all($pattern,$text,$matches);
	
    	$mail = array();
	 	if ($res) {
			foreach(array_unique($matches[0]) as $email) {
				$mail[] = $email;
			}
	    }
	    else {
	      		$mail[] = "Not Found";
	    }
  	}
  	// dd($mail);
   	return view('solo')->with('mail',$mail);
   }

   

   public function singleSite(Request $request) {

	   	$home = chop($request->site,"/");
	  
		$url = $home.'/sitemap_index.xml';
		$check = @get_headers($home); 

		if($check){
			$checkTwo = @get_headers($url);
			$a = preg_match('/\b404\b/', $checkTwo[0]);
				
			if($a > 0){
				return $this->onePage($home);
			}
			else {
			 	$xml = simplexml_load_file($url);
			   	$all_url = array();
		   		$mail= array();
			   	foreach($xml as $s){
			   		$suburl = simplexml_load_file($s->loc);
			   		// print_r($suburl);
			   		// dd($suburl);
		   			foreach($suburl as $surl){
	   				 	$turl = (string)$surl->loc;
	   				 	// dd($turl);
	   				 	// // echo "<pre>";
	   				 	// // print_r($turl);
	   				 	
	   				   	$text = file_get_contents($turl);
					   	if (!empty($text)) {
					   		$pattern = "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
					    	$res = preg_match_all($pattern,$text,$matches);
					    
						 	if ($res) {
								foreach(array_unique($matches[0]) as $email) {
									array_push($mail,$email);
								}
						    }
						    
  						}
		   			}
			   	}
			   	 
		   		$mail = array_unique($mail);
				return view('solo')->with('mail',$mail);
				  
			}
		}
		else{
		
			return view('solo')->with('home',$home);
		}

   }


}
