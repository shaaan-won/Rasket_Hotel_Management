<?php
echo Page::title(["title"=>"Edit PerformanceReview"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"performancereview", "text"=>"Manage PerformanceReview"]);
echo Page::context_open();
echo Form::open(["route"=>"performancereview/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$performancereview->id"]);
	echo Form::input(["label"=>"Staff","name"=>"staff_id","table"=>"staffs","value"=>"$performancereview->staff_id"]);
	echo Form::input(["label"=>"Review Date","type"=>"text","name"=>"review_date","value"=>"$performancereview->review_date"]);
	echo Form::input(["label"=>"Review Score","type"=>"text","name"=>"review_score","value"=>"$performancereview->review_score"]);
	echo Form::input(["label"=>"Review Comments","type"=>"textarea","name"=>"review_comments","value"=>"$performancereview->review_comments"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
