<?php
echo Page::title(["title"=>"Edit Payment"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"payment", "text"=>"Manage Payment"]);
echo Page::context_open();
echo Form::open(["route"=>"payment/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$payment->id"]);
	echo Form::input(["label"=>"Reservation","name"=>"reservation_id","table"=>"reservations","value"=>"$payment->reservation_id"]);
	echo Form::input(["label"=>"Amount","type"=>"text","name"=>"amount","value"=>"$payment->amount"]);
	echo Form::input(["label"=>"Payment Method","name"=>"payment_method_id","table"=>"payment_methods","value"=>"$payment->payment_method_id"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
