<?php
echo Page::title(["title"=>"Edit Invoice"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"invoice", "text"=>"Manage Invoice"]);
echo Page::context_open();
echo Form::open(["route"=>"invoice/update"]);
	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$invoice->id"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$invoice->name"]);
	echo Form::input(["label"=>"Customer Detail","name"=>"customer_detail_id","table"=>"customer_details","value"=>"$invoice->customer_detail_id"]);
	echo Form::input(["label"=>"Customer Detail Name","type"=>"text","name"=>"customer_detail_name","value"=>"$invoice->customer_detail_name"]);
	echo Form::input(["label"=>"Reservation","name"=>"reservation_id","table"=>"reservations","value"=>"$invoice->reservation_id"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount","value"=>"$invoice->total_amount"]);
	echo Form::input(["label"=>"Tax Amount","type"=>"text","name"=>"tax_amount","value"=>"$invoice->tax_amount"]);
	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status","value"=>"$invoice->payment_status"]);

echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
