<?php
function check_token(){
	$requestHeaders = apache_request_headers();

	if($requestHeaders['Authorization']=="Bearer ".md5("id_1")){
		return true;
	}else{
		return false;
	}
}
?>