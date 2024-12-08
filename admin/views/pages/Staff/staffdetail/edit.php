<?php
echo Page::title(["title"=>"Edit StaffDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"staffdetail", "text"=>"Manage StaffDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"staffdetail/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$staffdetail->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$staffdetail->name"]);
	echo Form::input(["label"=>"First Name","type"=>"text","name"=>"first_name","value"=>"$staffdetail->first_name"]);
	echo Form::input(["label"=>"Last Name","type"=>"text","name"=>"last_name","value"=>"$staffdetail->last_name"]);
	echo Form::input(["label"=>"Role","name"=>"role_id","table"=>"roles","value"=>"$staffdetail->role_id"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email","value"=>"$staffdetail->email"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone","value"=>"$staffdetail->phone"]);
	echo Form::input(["label"=>"Address","type"=>"textarea","name"=>"address","value"=>"$staffdetail->address"]);
	echo Form::input(["label"=>"Work Schedule","type"=>"text","name"=>"work_schedule","value"=>"$staffdetail->work_schedule"]);
	echo Form::input(["label"=>"Hired Date","type"=>"text","name"=>"hired_date","value"=>"$staffdetail->hired_date"]);
	echo Form::input(["label"=>"Performance Score","type"=>"text","name"=>"performance_score","value"=>"$staffdetail->performance_score"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
