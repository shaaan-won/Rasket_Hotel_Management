<?php
class CustomerDetailApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["customer_details"=>CustomerDetail::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["customer_details"=>CustomerDetail::pagination($page,$perpage),"total_records"=>CustomerDetail::count()]);
	}
	function find($data){
		echo json_encode(["customerdetail"=>CustomerDetail::find($data["id"])]);
	}
	function delete($data){
		CustomerDetail::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$customerdetail=new CustomerDetail();
		$customerdetail->name=$data["name"];
		$customerdetail->first_name=$data["first_name"];
		$customerdetail->last_name=$data["last_name"];
		$customerdetail->email=$data["email"];
		$customerdetail->phone=$data["phone"];
		$customerdetail->id_card_type_name=$data["id_card_type_name"];
		$customerdetail->id_card_number=$data["id_card_number"];
		$customerdetail->address=$data["address"];

		$customerdetail->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
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
		$customerdetail->updated_at=$now;

		$customerdetail->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
