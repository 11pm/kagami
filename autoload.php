<?php

function load_files($files = []){
	
	foreach ($files as $file) {
		require $file;
	}
}

$files = glob("{vendor/*.php,app/controllers/*.php,app/services/*,app/routes.php}", GLOB_BRACE);

load_files($files);