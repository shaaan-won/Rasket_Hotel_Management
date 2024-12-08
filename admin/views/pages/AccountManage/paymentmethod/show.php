<?php
echo Page::title(["title"=>"Show PaymentMethod"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"paymentmethod", "text"=>"Manage PaymentMethod"]);
echo Page::context_open();
echo PaymentMethod::html_row_details($id);
echo Page::context_close();
echo Page::body_close();
