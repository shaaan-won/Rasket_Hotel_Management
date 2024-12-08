<?php
echo Page::title(["title"=>"Edit StaffRole"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"staffrole", "text"=>"Manage StaffRole"]);
echo Page::context_open();
echo Form::open(["route"=>"staffrole/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$staffrole->id"]);
	echo Form::input(["label"=>"Role Name","type"=>"text","name"=>"role_name","value"=>"$staffrole->role_name"]);
	echo Form::input(["label"=>"Permissions","type"=>"text","name"=>"permissions","value"=>"$staffrole->permissions"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
