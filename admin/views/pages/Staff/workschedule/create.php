<?php
echo Page::title(["title"=>"Create WorkSchedule"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"workschedule", "text"=>"Manage WorkSchedule"]);
echo Page::context_open();
echo Form::open(["route"=>"workschedule/save"]);
	echo Form::input(["label"=>"Staff","name"=>"staff_id","table"=>"staffs"]);
	echo Form::input(["label"=>"Day Of Week","type"=>"text","name"=>"day_of_week"]);
	echo Form::input(["label"=>"Start Time","type"=>"text","name"=>"start_time"]);
	echo Form::input(["label"=>"End Time","type"=>"text","name"=>"end_time"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
