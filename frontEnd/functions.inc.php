<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_pet($con,$limit='',$cat_id='',$pet_id=''){
	$sql="select pet.*,categories.categories from pet,categories where pet.status=1 ";
	if($cat_id!=''){
		$sql.=" and pet.categories_id=$cat_id ";
	}
	if($pet_id!=''){
		$sql.=" and pet.id=$pet_id ";
	}
	$sql.=" and pet.categories_id=categories.id ";
	$sql.=" order by pet.id desc";
	if($limit!=''){
		$sql.=" limit $limit";
	}
	
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
?>