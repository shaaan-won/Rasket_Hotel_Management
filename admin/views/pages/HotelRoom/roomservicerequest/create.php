<?php
echo Page::title(["title"=>"Create RoomServicerequest"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"roomservicerequest", "text"=>"Manage RoomServicerequest"]);
echo Page::context_open();
echo Form::open(["route"=>"roomservicerequest/save"]);
	echo Form::input(["label"=>"User","name"=>"user_id","table"=>"users"]);
	echo Form::input(["label"=>"Room","name"=>"room_id","table"=>"rooms"]);
	echo Form::input(["label"=>"Request Type","type"=>"text","name"=>"request_type"]);
	echo Form::input(["label"=>"Request Description","type"=>"textarea","name"=>"request_description"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
