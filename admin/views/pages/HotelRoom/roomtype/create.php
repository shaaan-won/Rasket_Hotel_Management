<?php
echo Page::title(["title"=>"Create RoomType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"roomtype", "text"=>"Manage RoomType"]);
echo Page::context_open();
echo Form::open(["route"=>"roomtype/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description"]);
	echo Form::input(["label"=>"Max Occupancy","type"=>"text","name"=>"max_occupancy"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
