<?php
echo Page::title(["title"=>"Edit WorkSchedule"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"workschedule", "text"=>"Manage WorkSchedule"]);
echo Page::context_open();
echo Form::open(["route"=>"workschedule/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$workschedule->id"]);
	echo Form::input(["label"=>"Staff","name"=>"staff_id","table"=>"staffs","value"=>"$workschedule->staff_id"]);
	echo Form::input(["label"=>"Day Of Week","type"=>"text","name"=>"day_of_week","value"=>"$workschedule->day_of_week"]);
	echo Form::input(["label"=>"Start Time","type"=>"text","name"=>"start_time","value"=>"$workschedule->start_time"]);
	echo Form::input(["label"=>"End Time","type"=>"text","name"=>"end_time","value"=>"$workschedule->end_time"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
