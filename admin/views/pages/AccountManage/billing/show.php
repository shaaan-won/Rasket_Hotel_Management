<?php
echo Page::title(["title"=>"Show Billing"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"billing", "text"=>"Manage Billing"]);
echo Page::context_open();
echo Billing::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
