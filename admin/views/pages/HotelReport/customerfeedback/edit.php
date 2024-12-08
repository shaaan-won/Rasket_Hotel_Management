<?php
echo Page::title(["title"=>"Edit CustomerFeedback"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customerfeedback", "text"=>"Manage CustomerFeedback"]);
echo Page::context_open();
echo Form::open(["route"=>"customerfeedback/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$customerfeedback->id"]);
	echo Form::input(["label"=>"User","name"=>"user_id","table"=>"users","value"=>"$customerfeedback->user_id"]);
	echo Form::input(["label"=>"Comments","type"=>"textarea","name"=>"comments","value"=>"$customerfeedback->comments"]);
	echo Form::input(["label"=>"Rating","type"=>"text","name"=>"rating","value"=>"$customerfeedback->rating"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
