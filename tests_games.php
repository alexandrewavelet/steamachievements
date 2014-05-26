<?php

	include('Manager_api.php');
	include('Steam_game.php');

	$manager = new Manager_api();

	$games = $manager->get_owned_games_from_username('arnitri');

	$games_array = json_decode($games['message']);

	$games_list = $games_array->response->games;

	$games_objects = array();

	foreach ($games_list as $game) {
		$game_array = get_object_vars($game);
		array_push($games_objects, new Steam_game($game_array));
	}

	echo '<table>';
		foreach ($games_objects as $game) {
			echo '<tr>';
				echo '<td><img src="http://media.steampowered.com/steamcommunity/public/images/apps/'.$game->getAppid().'/'.$game->getImg_logo_url().'.jpg" alt="'.$game->getName().'"></td>';
				echo '<td>'.$game->getName().'</td>';
			echo '</tr>';
		}
	echo '<table>';

?>