<?php
class InvoiceController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["customer_detail_id"])){
		$errors["customer_detail_id"]="Invalid customer_detail_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCustomerDetailName"])){
		$errors["customer_detail_name"]="Invalid customer_detail_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["reservation_id"])){
		$errors["reservation_id"]="Invalid reservation_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tax_amount"])){
		$errors["tax_amount"]="Invalid tax_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["payment_status"])){
		$errors["payment_status"]="Invalid payment_status";
	}

*/		global $now;
		if(count($errors)==0){
			$invoice=new Invoice();
		$invoice->name=$data["name"];
		$invoice->customer_detail_id=$data["customer_detail_id"];
		$invoice->customer_detail_name=$data["customer_detail_name"];
		$invoice->reservation_id=$data["reservation_id"];
		$invoice->total_amount=$data["total_amount"];
		$invoice->tax_amount=$data["tax_amount"];
		$invoice->payment_status=$data["payment_status"];
		$invoice->created_at=$now;
		$invoice->updated_at=$now;

			$invoice->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("AccountManage",Invoice::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtName"])){
		$errors["name"]="Invalid name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["customer_detail_id"])){
		$errors["customer_detail_id"]="Invalid customer_detail_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtCustomerDetailName"])){
		$errors["customer_detail_name"]="Invalid customer_detail_name";
	}
	if(!preg_match("/^[\s\S]+$/",$data["reservation_id"])){
		$errors["reservation_id"]="Invalid reservation_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["total_amount"])){
		$errors["total_amount"]="Invalid total_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["tax_amount"])){
		$errors["tax_amount"]="Invalid tax_amount";
	}
	if(!preg_match("/^[\s\S]+$/",$data["payment_status"])){
		$errors["payment_status"]="Invalid payment_status";
	}

*/		global $now;
		if(count($errors)==0){
			$invoice=new Invoice();
			$invoice->id=$data["id"];
		$invoice->name=$data["name"];
		$invoice->customer_detail_id=$data["customer_detail_id"];
		$invoice->customer_detail_name=$data["customer_detail_name"];
		$invoice->reservation_id=$data["reservation_id"];
		$invoice->total_amount=$data["total_amount"];
		$invoice->tax_amount=$data["tax_amount"];
		$invoice->payment_status=$data["payment_status"];
		$invoice->created_at=$now;
		$invoice->updated_at=$now;

		$invoice->update();
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
		Invoice::delete($id);
		redirect();
	}
	public function show($id){
		view("AccountManage",Invoice::find($id));
	}
}
?>
