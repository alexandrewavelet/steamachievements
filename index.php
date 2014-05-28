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

	if (isset($_POST['submit']))
	{

		$id = $manager->get_steamid_from_username(htmlentities($_POST['username']));
		$answer = $id['message'];

		$jeux = $manager->get_owned_games_from_username(htmlentities($_POST['username']));
		$answer_jeux = $jeux['message'];

		$profil = $manager->get_profile_from_username(htmlentities($_POST['username']));

		$achievement_portal = $manager->get_achievement_from_username_and_gameid(htmlentities($_POST['username']),620);
		$achievement_portal = $achievement_portal['message'];

		$completion_portal = $manager->get_achievement_percentage_for_game(620);
		$completion_portal = $completion_portal['message'];
	}

	include('snippets/header.php');

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
		echo '<div class="row">';
 			echo '<div class="col-md-4 col-md-offset-2">';
 				echo '<div class="cadre_tentative">';
 					echo '<img class="pull-left" src="'.$profil->getAvatar().'">';
 						echo '<ul class="list-unstyled">';
							echo '<li><strong>Username : </strong>'.$profil->getPersonaname().'</li>';
							echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
						echo '</ul>';
					echo '<a href='.$profil->getProfileUrl().'>Steam page</a><br>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}

?>

<h3>jeux</h3>
<?php

	if (isset($answer_jeux)) {
		echo '<table>';
			foreach ($answer_jeux as $game) {
				echo '<tr>';
					echo '<td>';
						if ($game->has_logo()) {
							echo '<img src="'.$game->get_logo().'" alt="'.$game->getName().'">';
						}else{
							echo '<img src="assets/img/game_logo_default.jpg" alt="'.$game->getName().'">';
						}
					echo '</td>';
					echo '<td>'.$game->getName().'</td>';
				echo '</tr>';
			}
		echo '</table>';
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

<?php

	include('snippets/footer.php');

?>