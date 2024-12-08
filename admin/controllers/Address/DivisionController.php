<?php
class DivisionController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCapitalcity"])){
		$errors["CapitalCity"]="Invalid CapitalCity";
	}

*/
		if(count($errors)==0){
			$division=new Division();
		$division->name=$data["name"];
		$division->Population=$data["Population"];
		$division->AreaKm2=$data["AreaKm2"];
		$division->CapitalCity=$data["CapitalCity"];

			$division->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Address",Division::find($id));
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCapitalcity"])){
		$errors["CapitalCity"]="Invalid CapitalCity";
	}

*/
		if(count($errors)==0){
			$division=new Division();
			$division->id=$data["id"];
		$division->name=$data["name"];
		$division->Population=$data["Population"];
		$division->AreaKm2=$data["AreaKm2"];
		$division->CapitalCity=$data["CapitalCity"];

		$division->update();
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
		Division::delete($id);
		redirect();
	}
	public function show($id){
		view("Address",Division::find($id));
	}
}
?>
