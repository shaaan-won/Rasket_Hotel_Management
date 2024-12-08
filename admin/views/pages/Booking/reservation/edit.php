<?php
echo Page::title(["title"=>"Edit Reservation"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"reservation", "text"=>"Manage Reservation"]);
echo Page::context_open();
echo Form::open(["route"=>"reservation/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$reservation->id"]);
	echo Form::input(["label"=>"User","name"=>"user_id","table"=>"users","value"=>"$reservation->user_id"]);
	echo Form::input(["label"=>"Customer","name"=>"customer_id","table"=>"customer_details","value"=>"$reservation->customer_id"]);
	echo Form::input(["label"=>"Room","name"=>"room_id","table"=>"rooms","value"=>"$reservation->room_id"]);
	echo Form::input(["label"=>"Check In Date","type"=>"text","name"=>"check_in_date","value"=>"$reservation->check_in_date"]);
	echo Form::input(["label"=>"Check Out Date","type"=>"text","name"=>"check_out_date","value"=>"$reservation->check_out_date"]);
	echo Form::input(["label"=>"Special Requests","type"=>"textarea","name"=>"special_requests","value"=>"$reservation->special_requests"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount","value"=>"$reservation->total_amount"]);
	echo Form::input(["label"=>"Remaining Amount","type"=>"text","name"=>"remaining_amount","value"=>"$reservation->remaining_amount"]);
	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status","value"=>"$reservation->payment_status"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
