<?php
echo Page::title(["title"=>"Show CustomerFeedback"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customerfeedback", "text"=>"Manage CustomerFeedback"]);
echo Page::context_open();
echo CustomerFeedback::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
