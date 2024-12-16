<?php
echo Page::title(["title"=>"Edit Booking"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"booking", "text"=>"Manage Booking"]);
echo Page::context_open();
echo Form::open(["route"=>"booking/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$booking->id"]);
	echo Form::input(["label"=>"Order Total","type"=>"text","name"=>"order_total","value"=>"$booking->order_total"]);
	echo Form::input(["label"=>"Paid Total","type"=>"text","name"=>"paid_total","value"=>"$booking->paid_total"]);
	echo Form::input(["label"=>"Remark","type"=>"textarea","name"=>"remark","value"=>"$booking->remark"]);
	echo Form::input(["label"=>"Customer Detail","name"=>"customer_detail_id","table"=>"customer_details","value"=>"$booking->customer_detail_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
