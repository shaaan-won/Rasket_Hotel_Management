<?php
class BookingApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["bookings"=>Booking::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["bookings"=>Booking::pagination($page,$perpage),"total_records"=>Booking::count()]);
	}
	function find($data){
		echo json_encode(["booking"=>Booking::find($data["id"])]);
	}
	function delete($data){
		Booking::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$booking=new Booking();
		$booking->created_at=$data["created_at"];
		$booking->order_total=$data["order_total"];
		$booking->paid_total=$data["paid_total"];
		$booking->remark=$data["remark"];
		$booking->customer_detail_id=$data["customer_detail_id"];

		$booking->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$booking=new Booking();
		$booking->id=$data["id"];
		$booking->created_at=$data["created_at"];
		$booking->order_total=$data["order_total"];
		$booking->paid_total=$data["paid_total"];
		$booking->remark=$data["remark"];
		$booking->customer_detail_id=$data["customer_detail_id"];

		$booking->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
