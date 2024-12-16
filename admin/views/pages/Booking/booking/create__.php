<?php
echo Page::title(["title"=>"Create Booking"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"booking", "text"=>"Manage Booking"]);
echo Page::context_open();
echo Form::open(["route"=>"booking/save"]);
	echo Form::input(["label"=>"Order Total","type"=>"text","name"=>"order_total"]);
	echo Form::input(["label"=>"Paid Total","type"=>"text","name"=>"paid_total"]);
	echo Form::input(["label"=>"Remark","type"=>"textarea","name"=>"remark"]);
	echo Form::input(["label"=>"Customer","name"=>"customer_id","table"=>"customers"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
