<?php
echo Page::title(["title"=>"Show StaffDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"staffdetail", "text"=>"Manage StaffDetail"]);
echo Page::context_open();
echo StaffDetail::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
