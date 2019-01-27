<?php
	require_once __DIR__.'/../../data/data_controllers/places_management_controller.php';

	$places_management_controller = new places_management_controller();
	$places_management_controller->do_action();
	
?>