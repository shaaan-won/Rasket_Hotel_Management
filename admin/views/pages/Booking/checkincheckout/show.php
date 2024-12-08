<?php
echo Page::title(["title"=>"Show Checkincheckout"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"checkincheckout", "text"=>"Manage Checkincheckout"]);
echo Page::context_open();
echo Checkincheckout::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
