<?php
echo Page::title(["title"=>"Show Room"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"room", "text"=>"Manage Room"]);
echo Page::context_open();
echo Room::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
