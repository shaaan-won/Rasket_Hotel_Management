<?php
class ReportController extends Controller{
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
	if(!preg_match("/^[\s\S]+$/",$_POST["txtReportType"])){
		$errors["report_type"]="Invalid report_type";
	}
	if(!preg_match("/^[\s\S]+$/",$data["report_data"])){
		$errors["report_data"]="Invalid report_data";
	}

*/		global $now;
		if(count($errors)==0){
			$report=new Report();
		$report->report_type=$data["report_type"];
		$report->report_data=$data["report_data"];
		$report->created_at=$now;

			$report->save();
		redirect();
		}else{
			 print_r($errors);
		}
	}
}
public function edit($id){
		view("HotelReport",Report::find($id));
}
public function update($data,$file){
	if(isset($data["update"])){
	$errors=[];
/*
	if(!preg_match("/^[\s\S]+$/",$_POST["txtReportType"])){
		$errors["report_type"]="Invalid report_type";
	}
	if(!preg_match("/^[\s\S]+$/",$data["report_data"])){
		$errors["report_data"]="Invalid report_data";
	}

*/		global $now;
		if(count($errors)==0){
			$report=new Report();
			$report->id=$data["id"];
		$report->report_type=$data["report_type"];
		$report->report_data=$data["report_data"];
		$report->created_at=$now;

		$report->update();
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
		Report::delete($id);
		redirect();
	}
	public function show($id){
		view("HotelReport",Report::find($id));
	}
}
?>
