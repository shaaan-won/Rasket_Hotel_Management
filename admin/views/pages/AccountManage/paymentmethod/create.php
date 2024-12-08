<?php
echo Page::title(["title"=>"Create PaymentMethod"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"paymentmethod", "text"=>"Manage PaymentMethod"]);
echo Page::context_open();
echo Form::open(["route"=>"paymentmethod/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Description","type"=>"textarea","name"=>"description"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
