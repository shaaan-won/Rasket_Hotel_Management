<?php
echo Page::title(["title"=>"Create District"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"district", "text"=>"Manage District"]);
echo Page::context_open();
echo Form::open(["route"=>"district/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Population","type"=>"text","name"=>"Population"]);
	echo Form::input(["label"=>"Areakm2","type"=>"text","name"=>"AreaKm2"]);
	echo Form::input(["label"=>"Divisionid","type"=>"text","name"=>"DivisionID"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
