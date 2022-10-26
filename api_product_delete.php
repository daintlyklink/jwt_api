<?php
require_once "auth.php";
$data=null;
if(check_token()){
	if($_REQUEST['id']==""){
		$errmsg.="Invalid delete id\n";
	}

	if($errmsg==""){
		$product=json_decode(file_get_contents("product_list.json"),true);
		unset($product[$_REQUEST['id']]);
		file_put_contents("product_list.json",json_encode($product));
		$data['status']=true;
		$data['scsmsg']="Produk berhasil dihapus";
	}else{
		$data['status']=false;
		$data['errmsg']=$errmsg;
	}
}else{
	$data['status']=false;
	$data['errmsg']="Invalid session token";
}
echo json_encode($data);
?>