<?php
echo Page::title(["title"=>"Show RoomServicerequest"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"roomservicerequest", "text"=>"Manage RoomServicerequest"]);
echo Page::context_open();
echo RoomServicerequest::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
