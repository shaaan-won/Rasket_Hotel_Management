<?php
class BookingDetailController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("Booking");
	}
	public function create(){
		view("Booking");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["booking_id"])){
		$errors["booking_id"]="Invalid booking_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["room_id"])){
		$errors["room_id"]="Invalid room_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["from_date"])){
		$errors["from_date"]="Invalid from_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["to_date"])){
		$errors["to_date"]="Invalid to_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["price"])){
		$errors["price"]="Invalid price";
	}

*/		
		if(count($errors)==0){
			$bookingdetail=new BookingDetail();
		$bookingdetail->booking_id=$data["booking_id"];
		$bookingdetail->room_id=$data["room_id"];
		$bookingdetail->from_date=$data["from_date"];
		$bookingdetail->to_date=$data["to_date"];
		$bookingdetail->price=$data["price"];

			$bookingdetail->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Booking",BookingDetail::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["booking_id"])){
		$errors["booking_id"]="Invalid booking_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["room_id"])){
		$errors["room_id"]="Invalid room_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["from_date"])){
		$errors["from_date"]="Invalid from_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["to_date"])){
		$errors["to_date"]="Invalid to_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["price"])){
		$errors["price"]="Invalid price";
	}

*/
		if(count($errors)==0){
			$bookingdetail=new BookingDetail();
			$bookingdetail->id=$data["id"];
		$bookingdetail->booking_id=$data["booking_id"];
		$bookingdetail->room_id=$data["room_id"];
		$bookingdetail->from_date=$data["from_date"];
		$bookingdetail->to_date=$data["to_date"];
		$bookingdetail->price=$data["price"];

		$bookingdetail->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("Booking");
	}
	public function delete($id){
		BookingDetail::delete($id);
		redirect();
	}
	public function show($id){
		view("Booking",BookingDetail::find($id));
	}
}
?>
