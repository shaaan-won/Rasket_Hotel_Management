<?php
echo Page::title(["title"=>"Create BookingDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"bookingdetail", "text"=>"Manage BookingDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"bookingdetail/save"]);
	echo Form::input(["label"=>"Booking","name"=>"booking_id","table"=>"bookings"]);
	echo Form::input(["label"=>"Room","name"=>"room_id","table"=>"rooms"]);
	echo Form::input(["label"=>"From Date","type"=>"text","name"=>"from_date"]);
	echo Form::input(["label"=>"To Date","type"=>"text","name"=>"to_date"]);
	echo Form::input(["label"=>"Price","type"=>"text","name"=>"price"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
