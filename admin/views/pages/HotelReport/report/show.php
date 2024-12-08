<?php
echo Page::title(["title"=>"Show Report"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"report", "text"=>"Manage Report"]);
echo Page::context_open();
echo Report::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
