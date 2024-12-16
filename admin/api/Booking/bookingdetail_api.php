<?php
class BookingDetailApi{
	public function __construct(){
	}
	function index(){
		echo json_encode(["booking_details"=>BookingDetail::all()]);
	}
	function pagination($data){
		$page=$data["page"];
		$perpage=$data["perpage"];
		echo json_encode(["booking_details"=>BookingDetail::pagination($page,$perpage),"total_records"=>BookingDetail::count()]);
	}
	function find($data){
		echo json_encode(["bookingdetail"=>BookingDetail::find($data["id"])]);
	}
	function delete($data){
		BookingDetail::delete($data["id"]);
		echo json_encode(["success" => "yes"]);
	}
	function save($data,$file=[]){
		$bookingdetail=new BookingDetail();
		$bookingdetail->booking_id=$data["booking_id"];
		$bookingdetail->room_id=$data["room_id"];
		$bookingdetail->from_date=$data["from_date"];
		$bookingdetail->to_date=$data["to_date"];
		$bookingdetail->price=$data["price"];

		$bookingdetail->save();
		echo json_encode(["success" => "yes"]);
	}
	function update($data,$file=[]){
		$bookingdetail=new BookingDetail();
		$bookingdetail->id=$data["id"];
		$bookingdetail->booking_id=$data["booking_id"];
		$bookingdetail->room_id=$data["room_id"];
		$bookingdetail->from_date=$data["from_date"];
		$bookingdetail->to_date=$data["to_date"];
		$bookingdetail->price=$data["price"];

		$bookingdetail->update();
		echo json_encode(["success" => "yes"]);
	}
}
?>
