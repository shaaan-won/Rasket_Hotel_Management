<?php
class IdCardTypeController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Customer");
	}
	public function create(){
		view("Customer");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtIdCardTypeName"])){
		$errors["id_card_type_name"]="Invalid id_card_type_name";
	}

*/		global $now;
		if(count($errors)==0){
			$idcardtype=new IdCardType();
		$idcardtype->id_card_type_name=$data["id_card_type_name"];
		$idcardtype->created_at=$now;

			$idcardtype->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Customer",IdCardType::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtIdCardTypeName"])){
		$errors["id_card_type_name"]="Invalid id_card_type_name";
	}

*/		global $now;
			if(count($errors)==0){
			$idcardtype=new IdCardType();
			$idcardtype->id=$data["id"];
		$idcardtype->id_card_type_name=$data["id_card_type_name"];
		$idcardtype->created_at=$now;

		$idcardtype->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Customer");
	}
	public function delete($id){
		IdCardType::delete($id);
		redirect();
	}
	public function show($id){
		view("Customer",IdCardType::find($id));
	}
}
?>
