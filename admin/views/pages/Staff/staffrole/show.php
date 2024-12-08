<?php
echo Page::title(["title"=>"Show StaffRole"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"staffrole", "text"=>"Manage StaffRole"]);
echo Page::context_open();
echo StaffRole::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
