<?php
echo Page::title(["title"=>"Show Division"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"division", "text"=>"Manage Division"]);
echo Page::context_open();
echo Division::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
