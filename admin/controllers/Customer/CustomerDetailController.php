<?php
class CustomerDetailController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtFirstName"])){
		$errors["first_name"]="Invalid first_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtLastName"])){
		$errors["last_name"]="Invalid last_name";
	}
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["id_card_type_name"])){
		$errors["id_card_type_name"]="Invalid id_card_type_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtIdCardNumber"])){
		$errors["id_card_number"]="Invalid id_card_number";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}

*/		global $now;
		if(count($errors)==0){
			$customerdetail=new CustomerDetail();
		$customerdetail->name=$data["name"];
		$customerdetail->first_name=$data["first_name"];
		$customerdetail->last_name=$data["last_name"];
		$customerdetail->email=$data["email"];
		$customerdetail->phone=$data["phone"];
		$customerdetail->id_card_type_name=$data["id_card_type_name"];
		$customerdetail->id_card_number=$data["id_card_number"];
		$customerdetail->address=$data["address"];
		$customerdetail->created_at=$now;
		$customerdetail->updated_at=$now;

			$customerdetail->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Customer",CustomerDetail::find($id));
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
	if(!is_valid_email($data["email"])){
		$errors["email"]="Invalid email";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPhone"])){
		$errors["phone"]="Invalid phone";
	}
	if(!preg_match("/^[\s\S]+$/",$data["id_card_type_name"])){
		$errors["id_card_type_name"]="Invalid id_card_type_name";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtIdCardNumber"])){
		$errors["id_card_number"]="Invalid id_card_number";
	}
	if(!preg_match("/^[\s\S]+$/",$data["address"])){
		$errors["address"]="Invalid address";
	}

*/	 	global $now;
		if(count($errors)==0){
			$customerdetail=new CustomerDetail();
			$customerdetail->id=$data["id"];
		$customerdetail->name=$data["name"];
		$customerdetail->first_name=$data["first_name"];
		$customerdetail->last_name=$data["last_name"];
		$customerdetail->email=$data["email"];
		$customerdetail->phone=$data["phone"];
		$customerdetail->id_card_type_name=$data["id_card_type_name"];
		$customerdetail->id_card_number=$data["id_card_number"];
		$customerdetail->address=$data["address"];
		$customerdetail->created_at=$now;
		$customerdetail->updated_at=$now;

		$customerdetail->update();
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
		CustomerDetail::delete($id);
		redirect();
	}
	public function show($id){
		view("Customer",CustomerDetail::find($id));
	}
}
?>
