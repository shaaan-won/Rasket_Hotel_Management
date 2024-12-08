<?php
echo Page::title(["title"=>"Show RoomType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"roomtype", "text"=>"Manage RoomType"]);
echo Page::context_open();
echo RoomType::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
