<?php
	class FlashMessagesController {

		public function __construct() {
			if (!session_id()) {
				session_start();
			}
		}

		public function error($message) {
			$_SESSION['flash'] = [];
			$_SESSION['flash']['color'] = 'tomato-extra';
			$_SESSION['flash']['message'] = $message;
		}

		public function message($message) {
			$_SESSION['flash'] = [];
			$_SESSION['flash']['color'] = 'green-extra';
			$_SESSION['flash']['message'] = $message;
		}

		public function info($message) {
			$_SESSION['flash'] = [];
			$_SESSION['flash']['color'] = 'orange';
			$_SESSION['flash']['message'] = $message;
		}
	}

