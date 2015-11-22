<?php
function cURL_HTTP_Request($url,$post=null,$header=false,$cookie=false){
	$ch=curl_init($url);
	if(is_array($post)){
		curl_setopt($ch,CURLOPT_POST,true);
		$post=http_build_query($post);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
	}
	if($header){
		curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
	}
	if($cookie){
		curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie);
		curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie);
	}
	
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($ch,CURLINFO_HEADER_OUT,true); 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	
	$data=curl_exec($ch);
	$return=new stdClass;
	$return->html=$data;
	$return->header=curl_getinfo($ch);
	curl_close($ch);
	if(!$data){
		return false;
	}
	return $return;
}
?>
