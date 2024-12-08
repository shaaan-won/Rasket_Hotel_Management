<?php
echo Page::title(["title"=>"Edit Room"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"room", "text"=>"Manage Room"]);
echo Page::context_open();
echo Form::open(["route"=>"room/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$room->id"]);
	echo Form::input(["label"=>"Room Number","type"=>"text","name"=>"room_number","value"=>"$room->room_number"]);
	echo Form::input(["label"=>"Room Type","name"=>"room_type_id","table"=>"room_types","value"=>"$room->room_type_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
