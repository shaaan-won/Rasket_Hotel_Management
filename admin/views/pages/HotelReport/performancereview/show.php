<?php
echo Page::title(["title"=>"Show PerformanceReview"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"performancereview", "text"=>"Manage PerformanceReview"]);
echo Page::context_open();
echo PerformanceReview::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
