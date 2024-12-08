<?php
echo Page::title(["title"=>"Show Payment"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"payment", "text"=>"Manage Payment"]);
echo Page::context_open();
echo Payment::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
