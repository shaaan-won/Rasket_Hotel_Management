<?php
echo Page::title(["title"=>"Create Checkincheckout"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"checkincheckout", "text"=>"Manage Checkincheckout"]);
echo Page::context_open();
echo Form::open(["route"=>"checkincheckout/save"]);
	echo Form::input(["label"=>"Reservation","name"=>"reservation_id","table"=>"reservations"]);
	echo Form::input(["label"=>"Comments","type"=>"textarea","name"=>"comments"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
