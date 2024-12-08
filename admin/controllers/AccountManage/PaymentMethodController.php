<?php
class PaymentMethodController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("AccountManage");
	}
	public function create(){
		view("AccountManage");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}

*/
		if(count($errors)==0){
			$paymentmethod=new PaymentMethod();
		$paymentmethod->name=$data["name"];
		$paymentmethod->description=$data["description"];

			$paymentmethod->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("AccountManage",PaymentMethod::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["description"])){
		$errors["description"]="Invalid description";
	}

*/
		if(count($errors)==0){
			$paymentmethod=new PaymentMethod();
			$paymentmethod->id=$data["id"];
		$paymentmethod->name=$data["name"];
		$paymentmethod->description=$data["description"];

		$paymentmethod->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("AccountManage");
	}
	public function delete($id){
		PaymentMethod::delete($id);
		redirect();
	}
	public function show($id){
		view("AccountManage",PaymentMethod::find($id));
	}
}
?>
