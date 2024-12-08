<?php
echo Page::title(["title"=>"Edit RoomType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"roomtype", "text"=>"Manage RoomType"]);
echo Page::context_open();
echo Form::open(["route"=>"roomtype/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$roomtype->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$roomtype->name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description","value"=>"$roomtype->description"]);
	echo Form::input(["label"=>"Max Occupancy","type"=>"text","name"=>"max_occupancy","value"=>"$roomtype->max_occupancy"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
