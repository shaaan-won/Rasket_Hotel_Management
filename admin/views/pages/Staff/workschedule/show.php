<?php
echo Page::title(["title"=>"Show WorkSchedule"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"workschedule", "text"=>"Manage WorkSchedule"]);
echo Page::context_open();
echo WorkSchedule::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
