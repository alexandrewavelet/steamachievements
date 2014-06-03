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
 					echo '<div class="row">';
 						echo '<div class="col-md-2">';
	 						echo '<a href='.$profil->getProfileUrl().'><img src="'.$profil->getAvatar().'"></a>';
	 					echo '</div>';
 						echo '<div class="col-md-10">';
	 						echo '<ul class="list-unstyled">';
								echo '<li><strong>Username : </strong>'.$profil->getPersonaname().'</li>';
								echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
								echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
								echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
								echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
								echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
								echo '<li><strong>steam ID : </strong>'.$profil->getSteamid().'</li>';
							echo '</ul>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}

?>

<h3>jeux</h3>
<?php

	if (isset($answer_jeux)) {
		echo '<div class="row">';
			foreach ($answer_jeux as $game) {
				echo '<div class="col-md-3">';
					$logo = ($game->has_logo()) ? $game->get_logo() : 'assets/img/game_logo_default.jpg' ;
					echo '<img src="'.$logo.'" alt="'.$game->getName().'" width="100%" height="auto">';
				echo '</div>';
			}
		echo '</div>';
	}

?>

<?php

	include('snippets/footer.php');

?>