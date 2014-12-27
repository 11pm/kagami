<?php

function load_files($files = []){
	
	foreach ($files as $file) {
		require $file;
	}
}

$files = glob("{vendor/*.php,app/controllers/*.php}", GLOB_BRACE);

load_files($files);

$request_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$router = new Router($request_url);