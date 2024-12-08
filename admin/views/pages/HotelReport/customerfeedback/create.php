<?php
echo Page::title(["title"=>"Create CustomerFeedback"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customerfeedback", "text"=>"Manage CustomerFeedback"]);
echo Page::context_open();
echo Form::open(["route"=>"customerfeedback/save"]);
	echo Form::input(["label"=>"User","name"=>"user_id","table"=>"users"]);
	echo Form::input(["label"=>"Comments","type"=>"textarea","name"=>"comments"]);
	echo Form::input(["label"=>"Rating","type"=>"text","name"=>"rating"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
