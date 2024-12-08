<?php
	echo Menu::item([
		"name"=>"Division",
		"icon"=>"nav-icon fa fa-wrench",
		"route"=>"#",
		"links"=>[
			["route"=>"division/create","text"=>"Create Division","icon"=>"far fa-circle nav-icon"],
			["route"=>"division","text"=>"Manage Division","icon"=>"far fa-circle nav-icon"],
		]
	]);
