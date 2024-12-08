<?php
class DistrictController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Address");
	}
	public function create(){
		view("Address");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["Population"])){
		$errors["Population"]="Invalid Population";
	}
	if(!preg_match("/^[\s\S]+$/",$data["AreaKm2"])){
		$errors["AreaKm2"]="Invalid AreaKm2";
	}
	if(!preg_match("/^[\s\S]+$/",$data["DivisionID"])){
		$errors["DivisionID"]="Invalid DivisionID";
	}

*/
		if(count($errors)==0){
			$district=new District();
		$district->name=$data["name"];
		$district->Population=$data["Population"];
		$district->AreaKm2=$data["AreaKm2"];
		$district->DivisionID=$data["DivisionID"];

			$district->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Address",District::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["Population"])){
		$errors["Population"]="Invalid Population";
	}
	if(!preg_match("/^[\s\S]+$/",$data["AreaKm2"])){
		$errors["AreaKm2"]="Invalid AreaKm2";
	}
	if(!preg_match("/^[\s\S]+$/",$data["DivisionID"])){
		$errors["DivisionID"]="Invalid DivisionID";
	}

*/
		if(count($errors)==0){
			$district=new District();
			$district->id=$data["id"];
		$district->name=$data["name"];
		$district->Population=$data["Population"];
		$district->AreaKm2=$data["AreaKm2"];
		$district->DivisionID=$data["DivisionID"];

		$district->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Address");
	}
	public function delete($id){
		District::delete($id);
		redirect();
	}
	public function show($id){
		view("Address",District::find($id));
	}
}
?>
