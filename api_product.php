<?php
require_once "auth.php";

$data=null;
if(check_token()){
	$product=array(
		array(
			"nama"=>"Produk 1",
			"sku"=>"P001",
			"brand"=>"Kingdon",
			"deskripsi"=>"Produk Utama 1",
			"variasi"=>array(
				array(
					"nama"=>"Varian 1",
					"sku"=>"V101",
					"harga_jual"=>15000,
				),
				array(
					"nama"=>"Varian 2",
					"sku"=>"V102",
					"harga_jual"=>18000,
				),
				array(
					"nama"=>"Varian 3",
					"sku"=>"V103",
					"harga_jual"=>25000,
				),
			)
		),
		array(
			"nama"=>"Produk 2",
			"sku"=>"P002",
			"brand"=>"Samson",
			"deskripsi"=>"Produk Utama 2",
			"variasi"=>array(
				array(
					"nama"=>"Varian 1",
					"sku"=>"V201",
					"harga_jual"=>1000,
				),
				array(
					"nama"=>"Varian 2",
					"sku"=>"V202",
					"harga_jual"=>1800,
				),
				array(
					"nama"=>"Varian 3",
					"sku"=>"V203",
					"harga_jual"=>2000,
				),
			)
		)
	);
	//get product file
	$product_file=json_decode(file_get_contents("product_list.json"),true);
	if(!$product_file) $product_file=array();
	$product=array_merge($product,$product_file);

	$data['status']=true;
	$data['scsmsg']="Produk ditemukan";
	$data['product']=$product;
}else{
	$data['status']=false;
	$data['errmsg']="Invalid session token";
}
echo json_encode($data);
?>