<?php
echo Page::title(["title"=>"Show IdCardType"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"idcardtype", "text"=>"Manage IdCardType"]);
echo Page::context_open();
echo IdCardType::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
