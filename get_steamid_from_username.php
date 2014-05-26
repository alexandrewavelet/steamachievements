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
		$reponse = -1;
	}
	else 
	{
		preg_match("#<steamID64>[0-9]+#",$resultat_request,$match);
		preg_match("#>[0-9]+#",$match[0],$match);
		preg_match("#[0-9]+#",$match[0],$match);
		$reponse = $match[0];
	}
	curl_close($ch);
	return $reponse;
}

?>