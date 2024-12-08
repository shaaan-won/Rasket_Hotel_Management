<?php
class RoomServicerequestController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("HotelRoom");
	}
	public function create(){
		view("HotelRoom");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["user_id"])){
		$errors["user_id"]="Invalid user_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["room_id"])){
		$errors["room_id"]="Invalid room_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRequestType"])){
		$errors["request_type"]="Invalid request_type";
	}
	if(!preg_match("/^[\s\S]+$/",$data["request_description"])){
		$errors["request_description"]="Invalid request_description";
	}

*/	global $now;
		if(count($errors)==0){
			$roomservicerequest=new RoomServicerequest();
		$roomservicerequest->user_id=$data["user_id"];
		$roomservicerequest->room_id=$data["room_id"];
		$roomservicerequest->request_type=$data["request_type"];
		$roomservicerequest->request_description=$data["request_description"];
		$roomservicerequest->created_at=$now;
		$roomservicerequest->updated_at=$now;

			$roomservicerequest->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("HotelRoom",RoomServicerequest::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["user_id"])){
		$errors["user_id"]="Invalid user_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["room_id"])){
		$errors["room_id"]="Invalid room_id";
	}
	if(!preg_match("/^[\s\S]+$/",$_POST["txtRequestType"])){
		$errors["request_type"]="Invalid request_type";
	}
	if(!preg_match("/^[\s\S]+$/",$data["request_description"])){
		$errors["request_description"]="Invalid request_description";
	}

*/	global $now;
		if(count($errors)==0){
			$roomservicerequest=new RoomServicerequest();
			$roomservicerequest->id=$data["id"];
		$roomservicerequest->user_id=$data["user_id"];
		$roomservicerequest->room_id=$data["room_id"];
		$roomservicerequest->request_type=$data["request_type"];
		$roomservicerequest->request_description=$data["request_description"];
		$roomservicerequest->created_at=$now;
		$roomservicerequest->updated_at=$now;

		$roomservicerequest->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("HotelRoom");
	}
	public function delete($id){
		RoomServicerequest::delete($id);
		redirect();
	}
	public function show($id){
		view("HotelRoom",RoomServicerequest::find($id));
	}
}
?>
