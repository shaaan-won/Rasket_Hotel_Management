<?php
echo Page::title(["title"=>"Create Billing"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"billing", "text"=>"Manage Billing"]);
echo Page::context_open();
echo Form::open(["route"=>"billing/save"]);
	echo Form::input(["label"=>"Reservation","name"=>"reservation_id","table"=>"reservations"]);
	echo Form::input(["label"=>"User","name"=>"user_id","table"=>"users"]);
	echo Form::input(["label"=>"Itemized Charges","type"=>"text","name"=>"itemized_charges"]);
	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount"]);
	echo Form::input(["label"=>"Payment Method","type"=>"text","name"=>"payment_method"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
