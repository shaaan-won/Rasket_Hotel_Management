<?php
echo Page::title(["title"=>"Show CustomerDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customerdetail", "text"=>"Manage CustomerDetail"]);
echo Page::context_open();
echo CustomerDetail::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
