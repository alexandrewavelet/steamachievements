<?php

	/**
	* Manager Steam API
	*/
	class Manager_api
	{
		private $steamkey = '69E4634F40383769D291FC9BF5F1C5FE';

		function __construct()
		{
			
		}

		public function get_steamid_from_username($username)
		{
			$request = 'http://steamcommunity.com/id/'.$username.'/?xml=1';

			$resultat_request = $this->get_curl($request);
			if (!$resultat_request['code'])
			{
				$reponse = array('code' => 0, 'message' => 'Erreur : '.$resultat_request['message']);
			}
			else 
			{
				preg_match("#<steamID64>[0-9]+#",$resultat_request['message'],$match);
				preg_match("#>[0-9]+#",$match[0],$match);
				preg_match("#[0-9]+#",$match[0],$match);
				$reponse = array('code' => 1, 'message' => $match[0]);
			}
			return $reponse;
		}

		public function get_owned_games_from_username($username)
		{
			$steamid = $this->get_steamid_from_username($username);
			if ($steamid['code'])
			{
				$requete = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/';
				$requete = $requete.'?key='.$this->steamkey.
							'&steamid='.$steamid['message'].'&format=json';
				$resultat_request = $this->get_curl($requete);
				if (!$resultat_request['code'])
				{
					$reponse = array('code' => 0, 'message' => 'Erreur : '.$resultat_request['message']);
				}
				else 
				{
					$reponse = array('code' => 1, 'message' => $resultat_request['message']);
				}
			}
			else
			{
				$reponse = array('code' => 0, 'message' => 'Erreur : '.$steamid['message']);
			}
			return $reponse;
		}

		// à faire
		public function get_profile_from_username($username)
		{
			$steamkey= '69E4634F40383769D291FC9BF5F1C5FE';
			$steamid = get_steamid_from_username($username);
			// TODO : get steam id from multiple usernames !
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
			}
			curl_close($ch);
			return $liste_param_steam;

		}

		public function get_curl($request)
		{
			$ch = curl_init($request);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resultat_request = curl_exec($ch);
			if (!$resultat_request)
			{
				$reponse = array('code' => 0, 'message' => curl_error($ch));
			}
			else
			{
				$reponse = array('code' => 1, 'message' => $resultat_request);
			}
			curl_close($ch);
			return $reponse;
		}

	}

?>