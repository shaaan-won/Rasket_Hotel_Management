<?php
echo Page::title(["title"=>"Create StaffDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"staffdetail", "text"=>"Manage StaffDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"staffdetail/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"First Name","type"=>"text","name"=>"first_name"]);
	echo Form::input(["label"=>"Last Name","type"=>"text","name"=>"last_name"]);
	echo Form::input(["label"=>"Role","name"=>"role_id","table"=>"roles"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone"]);
	echo Form::input(["label"=>"Address","type"=>"textarea","name"=>"address"]);
	echo Form::input(["label"=>"Work Schedule","type"=>"text","name"=>"work_schedule"]);
	echo Form::input(["label"=>"Hired Date","type"=>"text","name"=>"hired_date"]);
	echo Form::input(["label"=>"Performance Score","type"=>"text","name"=>"performance_score"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
