<?php

	include('Manager_api.php');

	$manager = new Manager_api();

	$games = $manager->get_owned_games_from_username('arnitri');
	$games_list = $games['message'];

	echo '<table>';
		foreach ($games_list as $game) {
			echo '<tr>';
				echo '<td><img src="'.$game->get_logo().'" alt="'.$game->getName().'"></td>';
				echo '<td>'.$game->getName().'</td>';
			echo '</tr>';
		}
	echo '<table>';

?>