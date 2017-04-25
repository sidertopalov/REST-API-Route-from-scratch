<?php

/**
 * Autoload file
 * if u want to load any folder just added it to $directories
 */

$directories = array("Route", "App/interface", "App/Controllers", "database", "Output");

foreach ($directories as $folder) {
	foreach(glob($folder.'/*.*') as $file) {
	   	include $file;
	}
}