<?php
class StaffDetailController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFirstName"])){
		$errors["first_name"]="Invalid first_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtLastName"])){
		$errors["last_name"]="Invalid last_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["role_id"])){
		$errors["role_id"]="Invalid role_id";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}
	if(!preg_match("/^[\s\S]+$/",$data["work_schedule"])){
		$errors["work_schedule"]="Invalid work_schedule";
	}
	if(!preg_match("/^[\s\S]+$/",$data["hired_date"])){
		$errors["hired_date"]="Invalid hired_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["performance_score"])){
		$errors["performance_score"]="Invalid performance_score";
	}

*/		global $now;
		if(count($errors)==0){
			$staffdetail=new StaffDetail();
		$staffdetail->name=$data["name"];
		$staffdetail->first_name=$data["first_name"];
		$staffdetail->last_name=$data["last_name"];
		$staffdetail->role_id=$data["role_id"];
		$staffdetail->email=$data["email"];
		$staffdetail->phone=$data["phone"];
		$staffdetail->address=$data["address"];
		$staffdetail->work_schedule=$data["work_schedule"];
		$staffdetail->hired_date=$data["hired_date"];
		$staffdetail->performance_score=$data["performance_score"];
		$staffdetail->created_at=$now;
		$staffdetail->updated_at=$now;

			$staffdetail->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Staff",StaffDetail::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFirstName"])){
		$errors["first_name"]="Invalid first_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtLastName"])){
		$errors["last_name"]="Invalid last_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["role_id"])){
		$errors["role_id"]="Invalid role_id";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}
	if(!preg_match("/^[\s\S]+$/",$data["work_schedule"])){
		$errors["work_schedule"]="Invalid work_schedule";
	}
	if(!preg_match("/^[\s\S]+$/",$data["hired_date"])){
		$errors["hired_date"]="Invalid hired_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["performance_score"])){
		$errors["performance_score"]="Invalid performance_score";
	}

*/		global $now;
		if(count($errors)==0){
			$staffdetail=new StaffDetail();
			$staffdetail->id=$data["id"];
		$staffdetail->name=$data["name"];
		$staffdetail->first_name=$data["first_name"];
		$staffdetail->last_name=$data["last_name"];
		$staffdetail->role_id=$data["role_id"];
		$staffdetail->email=$data["email"];
		$staffdetail->phone=$data["phone"];
		$staffdetail->address=$data["address"];
		$staffdetail->work_schedule=$data["work_schedule"];
		$staffdetail->hired_date=$data["hired_date"];
		$staffdetail->performance_score=$data["performance_score"];
		$staffdetail->created_at=$now;
		$staffdetail->updated_at=$now;

		$staffdetail->update();
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
		StaffDetail::delete($id);
		redirect();
	}
	public function show($id){
		view("Staff",StaffDetail::find($id));
	}
}
?>
