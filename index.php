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
	}

?>

<h1>index</h1>

<ul>
	<li><a href="get_profile_from_username.php">get profile from username</a></li>
	<li><a href="get_steamid_from_username.php">get steamid from username</a></li>
	<li><a href="get_owned_games_from_username.php">get owned games from username</a></li>
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