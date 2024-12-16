<?php
echo Page::title(["title"=>"Edit BookingDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"bookingdetail", "text"=>"Manage BookingDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"bookingdetail/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$bookingdetail->id"]);
	echo Form::input(["label"=>"Booking","name"=>"booking_id","table"=>"bookings","value"=>"$bookingdetail->booking_id"]);
	echo Form::input(["label"=>"Room","name"=>"room_id","table"=>"rooms","value"=>"$bookingdetail->room_id"]);
	echo Form::input(["label"=>"From Date","type"=>"text","name"=>"from_date","value"=>"$bookingdetail->from_date"]);
	echo Form::input(["label"=>"To Date","type"=>"text","name"=>"to_date","value"=>"$bookingdetail->to_date"]);
	echo Form::input(["label"=>"Price","type"=>"text","name"=>"price","value"=>"$bookingdetail->price"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
