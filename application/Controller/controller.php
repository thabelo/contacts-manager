<?php
	require_once (__DIR__.'/../Vendor/plugin/FlassMessages/Controller/flash_messages_controller.php');

	class Controller {
		function __construct() {
			$this->Flash = new FlashMessagesController();
		}
	
		function redirect($location) {
			header("Location: ".$location);
		}
	}
