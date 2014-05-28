<?php

	session_start();

	function __autoload($class)
	{
		static $classDir = '/models';
		$file = str_replace('\\', DIRECTORY_SEPARATOR, ltrim($class, '\\')) . '.php';
		require "$classDir/$file";
	}

	include('models/Manager_api.php');

	$manager = new Manager_api();

	if (isset($_GET['action'])) {
		$action = htmlentities($_GET['action']);
	}

	switch ($action) {
		case 'value':
			
			break;

		default:
			$file = 'form_profile.php';
			break;
	}

	include('snippets/header.php');
	include('views/profiles/'.$file);
	include('snippets/footer.php');

?>