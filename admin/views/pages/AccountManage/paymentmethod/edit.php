<?php
echo Page::title(["title"=>"Edit PaymentMethod"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"paymentmethod", "text"=>"Manage PaymentMethod"]);
echo Page::context_open();
echo Form::open(["route"=>"paymentmethod/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$paymentmethod->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$paymentmethod->name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description","value"=>"$paymentmethod->description"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
