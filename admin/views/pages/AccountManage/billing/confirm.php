<?php
echo Page::title(["title"=>"Show Billing"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"billing", "text"=>"Manage Billing"]);
echo Page::context_open();
echo Form::open(["route"=>"billing/delete/$id"]);
echo "Are you sure?";
echo Billing::html_row_details($id);
echo Form::input(["name"=>"id", "type"=>"hidden", "value"=>$id]);
echo Form::input(["name"=>"delete", "class"=>"btn btn-danger", "value"=>"Delete", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
