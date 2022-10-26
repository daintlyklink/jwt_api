<?php
$data=null;
if($_REQUEST['username']=="test" && $_REQUEST['password']=="test"){
	$user=array(
		"fullname"=>"test",
		"token"=>md5("id_1")
	);
	$data['status']=true;
	$data['scsmsg']="Login Success";
	$data['session']=$user;
}else{
	$data['status']=false;
	$data['errmsg']="Invalid username & password";
}
echo json_encode($data);
?>