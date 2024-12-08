<?php
class CheckincheckoutController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$data["reservation_id"])){
		$errors["reservation_id"]="Invalid reservation_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["comments"])){
		$errors["comments"]="Invalid comments";
	}

*/		global $now;
		if(count($errors)==0){
			$checkincheckout=new Checkincheckout();
		$checkincheckout->reservation_id=$data["reservation_id"];
		$checkincheckout->check_in_time=$now;
		$checkincheckout->check_out_time=$now;
		$checkincheckout->comments=$data["comments"];
		$checkincheckout->created_at=$now;

			$checkincheckout->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("Booking",Checkincheckout::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["reservation_id"])){
		$errors["reservation_id"]="Invalid reservation_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["comments"])){
		$errors["comments"]="Invalid comments";
	}

*/		global $now;
		if(count($errors)==0){
			$checkincheckout=new Checkincheckout();
			$checkincheckout->id=$data["id"];
		$checkincheckout->reservation_id=$data["reservation_id"];
		$checkincheckout->check_in_time=$now;
		$checkincheckout->check_out_time=$now;
		$checkincheckout->comments=$data["comments"];
		$checkincheckout->created_at=$now;

		$checkincheckout->update();
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
		Checkincheckout::delete($id);
		redirect();
	}
	public function show($id){
		view("Booking",Checkincheckout::find($id));
	}
}
?>
