<?php
echo Page::title(["title"=>"Show BookingDetail"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"bookingdetail", "text"=>"Manage BookingDetail"]);
echo Page::context_open();
echo BookingDetail::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
