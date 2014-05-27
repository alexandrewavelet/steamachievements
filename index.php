<?php

	if (isset($_POST['submit']))
	{
		include('Manager_api.php');
		$manager = new Manager_api();
		$id = $manager->get_steamid_from_username(htmlentities($_POST['username']));
		if ($id['code'])
		{
			$answer = $_POST['username'].' : '.$id['message'];
		}
		else
		{
			$answer = $id['message'];
		}
		$jeux = $manager->get_owned_games_from_username(htmlentities($_POST['username']));
		if ($jeux['code'])
		{
			$answer_jeux = $_POST['username'].' : '.$jeux['message'];
		}
		else
		{
			$answer_jeux = $jeux['message'];
		}
		$profil = $manager->get_profile_from_username(htmlentities($_POST['username']));
		if ($profil['code'])
		{
			$answer_profil = $profil['message'];
		}
		else
		{
			$answer_profil = $profil['message'];
		}
		$achievement_portal = $manager->get_achievement_from_username_and_gameid(htmlentities($_POST['username']),620);
		if ($profil['code'])
		{
			$achievement_portal = $achievement_portal['message'];
		}
		else
		{
			$achievement_portal = $achievement_portal['message'];
		}
		$completion_portal = $manager->get_achievement_percentage_for_game(620);
		if ($profil['code'])
		{
			$completion_portal = $completion_portal['message'];
		}
		else
		{
			$completion_portal = $completion_portal['message'];
		}
	}

?>

<h1>index</h1>

<ul>
	<li><a href="get_profile_from_username.php">get profile from username</a></li>
	<li><a href="get_steamid_from_username.php">get steamid from username</a></li>
	<li><a href="get_owned_games_from_username.php">get owned games from username</a></li>
	<li><a href="tests_games.php">tests formatage jeux</a></li>
</ul>

<h2>Username</h2>

<form action="index.php" method="POST">
	<label for="username">Username</label><input type="text" name="username" id="username" placeholder="Username" required>
	<input type="submit" name="submit" value="Valider">
</form>

<h3>steamid</h3>
<?php
	
	if (isset($id)) {
		echo '<p>'.$answer.'</p>';
	}

?>

<h3>profil</h3>
<?php
	
	if (isset($id)) {
		echo '<p>'.$answer_profil.'</p>';
	}

?>

<h3>jeux</h3>
<?php
	
	if (isset($id)) {
		echo '<p>'.$answer_jeux.'</p>';
	}

?>

<h3>Achievement Portal 2</h3>
<?php
	
	if (isset($id)) {
		echo '<p>'.$achievement_portal.'</p>';
	}

?>

<h3>Completion percentage Portal 2</h3>
<?php
	
	if (isset($id)) {
		echo '<p>'.$completion_portal.'</p>';
	}

?>