<?php
echo Page::title(["title"=>"Edit District"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"district", "text"=>"Manage District"]);
echo Page::context_open();
echo Form::open(["route"=>"district/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$district->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$district->name"]);
	echo Form::input(["label"=>"Population","type"=>"text","name"=>"Population","value"=>"$district->Population"]);
	echo Form::input(["label"=>"Areakm2","type"=>"text","name"=>"AreaKm2","value"=>"$district->AreaKm2"]);
	echo Form::input(["label"=>"Divisionid","type"=>"text","name"=>"DivisionID","value"=>"$district->DivisionID"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
