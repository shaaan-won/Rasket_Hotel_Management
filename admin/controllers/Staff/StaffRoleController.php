<?php
class StaffRoleController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Staff");
	}
	public function create(){
		view("Staff");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRoleName"])){
		$errors["role_name"]="Invalid role_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["permissions"])){
		$errors["permissions"]="Invalid permissions";
	}

*/
		if(count($errors)==0){
			$staffrole=new StaffRole();
		$staffrole->role_name=$data["role_name"];
		$staffrole->permissions=$data["permissions"];

			$staffrole->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Staff",StaffRole::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRoleName"])){
		$errors["role_name"]="Invalid role_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["permissions"])){
		$errors["permissions"]="Invalid permissions";
	}

*/
		if(count($errors)==0){
			$staffrole=new StaffRole();
			$staffrole->id=$data["id"];
		$staffrole->role_name=$data["role_name"];
		$staffrole->permissions=$data["permissions"];

		$staffrole->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Staff");
	}
	public function delete($id){
		StaffRole::delete($id);
		redirect();
	}
	public function show($id){
		view("Staff",StaffRole::find($id));
	}
}
?>
