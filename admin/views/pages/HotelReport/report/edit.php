<?php
echo Page::title(["title"=>"Edit Report"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"report", "text"=>"Manage Report"]);
echo Page::context_open();
echo Form::open(["route"=>"report/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$report->id"]);
	echo Form::input(["label"=>"Report Type","type"=>"text","name"=>"report_type","value"=>"$report->report_type"]);
	echo Form::input(["label"=>"Report Data","type"=>"text","name"=>"report_data","value"=>"$report->report_data"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
