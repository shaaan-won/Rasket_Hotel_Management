<?php
echo Page::title(["title"=>"Edit CustomerDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customerdetail", "text"=>"Manage CustomerDetail"]);
echo Page::context_open();
echo Form::open(["route"=>"customerdetail/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$customerdetail->id"]);
	echo Form::input(["label"=>"First Name","type"=>"text","name"=>"first_name","value"=>"$customerdetail->first_name"]);
	echo Form::input(["label"=>"Last Name","type"=>"text","name"=>"last_name","value"=>"$customerdetail->last_name"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email","value"=>"$customerdetail->email"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone","value"=>"$customerdetail->phone"]);
	echo Form::input(["label"=>"Id Card Type Name","type"=>"text","name"=>"id_card_type_name","value"=>"$customerdetail->id_card_type_name"]);
	echo Form::input(["label"=>"Id Card Number","type"=>"text","name"=>"id_card_number","value"=>"$customerdetail->id_card_number"]);
	echo Form::input(["label"=>"Address","type"=>"textarea","name"=>"address","value"=>"$customerdetail->address"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
