<?php
echo Page::title(["title"=>"Show Reservation"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"reservation", "text"=>"Manage Reservation"]);
echo Page::context_open();
echo Reservation::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
