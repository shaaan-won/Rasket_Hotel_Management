<?php
echo Page::title(["title"=>"Create IdCardType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"idcardtype", "text"=>"Manage IdCardType"]);
echo Page::context_open();
echo Form::open(["route"=>"idcardtype/save"]);
	echo Form::input(["label"=>"Id Card Type Name","type"=>"text","name"=>"id_card_type_name"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
