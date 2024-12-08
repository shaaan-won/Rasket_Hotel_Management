<?php
echo Page::title(["title"=>"Edit Checkincheckout"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"checkincheckout", "text"=>"Manage Checkincheckout"]);
echo Page::context_open();
echo Form::open(["route"=>"checkincheckout/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$checkincheckout->id"]);
	echo Form::input(["label"=>"Reservation","name"=>"reservation_id","table"=>"reservations","value"=>"$checkincheckout->reservation_id"]);
	echo Form::input(["label"=>"Comments","type"=>"textarea","name"=>"comments","value"=>"$checkincheckout->comments"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
