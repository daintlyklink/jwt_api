<?php
require_once "auth.php";
$data=null;
if(check_token()){
	if($_REQUEST['product_nama']==""){
		$errmsg.="Nama Produk harus diisi\n";
	}
	if($_REQUEST['product_sku']==""){
		$errmsg.="SKU harus diisi\n";
	}elseif($_REQUEST['product_sku']=="P001" || $_REQUEST['product_sku']=="P002"){
		$errmsg.="Produk utama tidak dapat diubah\n";
	}

	if($errmsg==""){
		$product=json_decode(file_get_contents("product_list.json"),true);
		$arr_vnama=explode(",",$_REQUEST['varian_nama']);
		$arr_vsku=explode(",",$_REQUEST['varian_sku']);
		$arr_vharga=explode(",",$_REQUEST['varian_harga']);
		$varian=array();
		for($i=0;$i<5;$i++){
			if($arr_vsku[$i]){
				$varian[]=array(
					"nama"=>$arr_vnama[$i],
					"sku"=>$arr_vsku[$i],
					"harga_jual"=>$arr_vharga[$i],
				);
			}
		}
		$product[$_REQUEST['product_sku']]=array(
			"nama"=>$_REQUEST['product_nama'],
			"sku"=>$_REQUEST['product_sku'],
			"brand"=>$_REQUEST['product_brand'],
			"deskripsi"=>$_REQUEST['product_deskripsi'],
			"variasi"=>$varian,
		);
		file_put_contents("product_list.json",json_encode($product));
		$data['status']=true;
		$data['scsmsg']="Produk berhasil ditambahkan";
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