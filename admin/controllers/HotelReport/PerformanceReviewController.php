<?php
class PerformanceReviewController extends Controller{
	public function __construct(){
	}
	public function index(){
		view("HotelReport");
	}
	public function create(){
		view("HotelReport");
	}
public function save($data,$file){
	if(isset($data["create"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["staff_id"])){
		$errors["staff_id"]="Invalid staff_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["review_date"])){
		$errors["review_date"]="Invalid review_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["review_score"])){
		$errors["review_score"]="Invalid review_score";
	}
	if(!preg_match("/^[\s\S]+$/",$data["review_comments"])){
		$errors["review_comments"]="Invalid review_comments";
	}

*/	global $now;
		if(count($errors)==0){
			$performancereview=new PerformanceReview();
		$performancereview->staff_id=$data["staff_id"];
		$performancereview->review_date=$data["review_date"];
		$performancereview->review_score=$data["review_score"];
		$performancereview->review_comments=$data["review_comments"];
		$performancereview->created_at=$now;

			$performancereview->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("HotelReport",PerformanceReview::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$data["staff_id"])){
		$errors["staff_id"]="Invalid staff_id";
	}
	if(!preg_match("/^[\s\S]+$/",$data["review_date"])){
		$errors["review_date"]="Invalid review_date";
	}
	if(!preg_match("/^[\s\S]+$/",$data["review_score"])){
		$errors["review_score"]="Invalid review_score";
	}
	if(!preg_match("/^[\s\S]+$/",$data["review_comments"])){
		$errors["review_comments"]="Invalid review_comments";
	}

*/		global $now;
		if(count($errors)==0){
			$performancereview=new PerformanceReview();
			$performancereview->id=$data["id"];
		$performancereview->staff_id=$data["staff_id"];
		$performancereview->review_date=$data["review_date"];
		$performancereview->review_score=$data["review_score"];
		$performancereview->review_comments=$data["review_comments"];
		$performancereview->created_at=$now;

		$performancereview->update();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
	public function confirm($id){
		view("HotelReport");
	}
	public function delete($id){
		PerformanceReview::delete($id);
		redirect();
	}
	public function show($id){
		view("HotelReport",PerformanceReview::find($id));
	}
}
?>
