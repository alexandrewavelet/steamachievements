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
		$achievement_portal = $manager->get_achievement_from_username_and_gameid(htmlentities($_POST['username']),620);
		if ($achievement_portal['code'])
		{
			$achievement_portal = $achievement_portal['message'];
		}
		else
		{
			$achievement_portal = $achievement_portal['message'];
		}
		$completion_portal = $manager->get_achievement_percentage_for_game(620);
		if ($completion_portal['code'])
		{
			$completion_portal = $completion_portal['message'];
		}
		else
		{
			$completion_portal = $completion_portal['message'];
		}
	}

?>

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
		echo '<p>';
		echo '<strong> Username</strong> : '.$profil->getPersonaname().'<br>';
		echo '<strong> steam ID</strong> : '.$profil->getSteamid().'<br>';
		$profile_url=$profil->getProfileUrl();
		echo '<a href='.$profile_url.'>Steam page</a><br>';
		echo '</p>';
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