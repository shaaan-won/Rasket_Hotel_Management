<?php
class BillingController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["reservation_id"])){
		$errors["reservation_id"]="Invalid reservation_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["user_id"])){
		$errors["user_id"]="Invalid user_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["itemized_charges"])){
		$errors["itemized_charges"]="Invalid itemized_charges";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPaymentMethod"])){
		$errors["payment_method"]="Invalid payment_method";
	}

*/		global $now;
		if(count($errors)==0){
			$billing=new Billing();
		$billing->reservation_id=$data["reservation_id"];
		$billing->user_id=$data["user_id"];
		$billing->itemized_charges=$data["itemized_charges"];
		$billing->total_amount=$data["total_amount"];
		$billing->payment_method=$data["payment_method"];
		$billing->payment_date=$now;
		$billing->created_at=$now;

			$billing->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("AccountManage",Billing::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["reservation_id"])){
		$errors["reservation_id"]="Invalid reservation_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["user_id"])){
		$errors["user_id"]="Invalid user_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["itemized_charges"])){
		$errors["itemized_charges"]="Invalid itemized_charges";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtPaymentMethod"])){
		$errors["payment_method"]="Invalid payment_method";
	}

*/		global $now;
		if(count($errors)==0){
			$billing=new Billing();
			$billing->id=$data["id"];
		$billing->reservation_id=$data["reservation_id"];
		$billing->user_id=$data["user_id"];
		$billing->itemized_charges=$data["itemized_charges"];
		$billing->total_amount=$data["total_amount"];
		$billing->payment_method=$data["payment_method"];
		$billing->payment_date=$now;
		$billing->created_at=$now;

		$billing->update();
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
		Billing::delete($id);
		redirect();
	}
	public function show($id){
		view("AccountManage",Billing::find($id));
	}
}
?>
