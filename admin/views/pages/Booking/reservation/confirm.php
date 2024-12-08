<?php
echo Page::title(["title"=>"Show Reservation"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"reservation", "text"=>"Manage Reservation"]);
echo Page::context_open();
echo Form::open(["route"=>"reservation/delete/$id"]);
echo "Are you sure?";
echo Reservation::html_row_details($id);
echo Form::input(["name"=>"id", "type"=>"hidden", "value"=>$id]);
echo Form::input(["name"=>"delete", "class"=>"btn btn-danger", "value"=>"Delete", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
