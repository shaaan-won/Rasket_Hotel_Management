<?php
echo Page::title(["title"=>"Create PerformanceReview"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"performancereview", "text"=>"Manage PerformanceReview"]);
echo Page::context_open();
echo Form::open(["route"=>"performancereview/save"]);
	echo Form::input(["label"=>"Staff","name"=>"staff_id","table"=>"staffs"]);
	echo Form::input(["label"=>"Review Date","type"=>"text","name"=>"review_date"]);
	echo Form::input(["label"=>"Review Score","type"=>"text","name"=>"review_score"]);
	echo Form::input(["label"=>"Review Comments","type"=>"textarea","name"=>"review_comments"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
