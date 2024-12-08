<?php
echo Page::title(["title"=>"Create StaffRole"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"staffrole", "text"=>"Manage StaffRole"]);
echo Page::context_open();
echo Form::open(["route"=>"staffrole/save"]);
	echo Form::input(["label"=>"Role Name","type"=>"text","name"=>"role_name"]);
	echo Form::input(["label"=>"Permissions","type"=>"text","name"=>"permissions"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
