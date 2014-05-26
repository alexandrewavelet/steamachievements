<?php

	include('Manager_api.php');

	$manager = new Manager_api();

	$games = $manager->get_owned_games_from_username('arnitri');

	$games_array = json_decode($games['message']);

	$games_list = $games_array->response->games;

	foreach ($games_list as $game) {
		$game_array = get_object_vars($game);
		foreach ($game_array as $key => $value) {
			echo $key.' => '.$value.'<br>';
		}
		echo '<hr>';
	}

	echo '<hr>';

	echo '<h1>Game count</h1>';

	var_dump($games_array->response->game_count);

?>