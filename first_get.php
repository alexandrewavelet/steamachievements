<?php
$steamkey= '69E4634F40383769D291FC9BF5F1C5FE';
$steamid = '76561198120359242.76561198120359242'; //get_steam_id();
$requete =  'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/';
$requete = $requete.'?key='.$steamkey.
			'&steamids='.$steamid;			

$ch = curl_init($requete);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$resultat_request = curl_exec($ch);

if (!$resultat_request)
	{echo "<p>Erreur</p><p>".curl_error($ch)."</p>";}

else 
{
	$liste_parametres = explode("&",$resultat_request);
	foreach($liste_parametres as $param_steam)
	{
		$list_param_steam=json_decode($param_steam);
		foreach($list_param_steam as $response)
		{
			foreach ($response as $player ) {
				$liste_param_steam=$player;
			};
		} 
	}
	echo "<pre>";
	print_r($liste_param_steam);
	echo "</pre>";

}

curl_close($ch);

?>