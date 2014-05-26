<?php

include("get_steamid_from_username.php");

function get_owned_games_from_username($username) 
{
	$steamkey= '69E4634F40383769D291FC9BF5F1C5FE';
	$steamid = get_steamid_from_username($username);
	// TODO : get steam id from multiple usernames !
	$requete = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/';
	$requete = $requete.'?key='.$steamkey.'&steamid='.$steamid.'&format=json';
	$ch = curl_init($requete);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$resultat_request = curl_exec($ch);
	if (!$resultat_request)
	{
		echo "<p>Erreur</p><p>".curl_error($ch)."</p>";
	}
	else 
	{
		$liste_parametres = json_decode($resultat_request);
	}
	curl_close($ch);
	return $liste_parametres;
}

var_dump(get_owned_games_from_username("arnitri"));

?>