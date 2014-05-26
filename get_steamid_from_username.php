<?php

function get_steamid_from_username($username)
{
	$request = 'http://steamcommunity.com/id/'.$username.'/?xml=1';
	$ch = curl_init($request);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resultat_request = curl_exec($ch);	
	if (!$resultat_request)
	{
		echo "<p>Erreur</p><p>".curl_error($ch)."</p>";
		return -1;
	}
	else 
	{
		preg_match("#<steamID64>[0-9]+#",$resultat_request,$match);
		return $match[0];
	}
	curl_close($ch);
}

get_steamid_from_username("arnitri");

?>