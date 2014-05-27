<?php

	include('Steam_profile.php');
	include('Steam_games_list.php');
	include('Steam_game.php');

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
				$requete = $requete.'?key='.$this->steamkey.'&steamid='.$steamid['message'].'&format=json&include_appinfo=1';
				$resultat_request = $this->get_curl($requete);
				if (!$resultat_request['code'])
				{
					$reponse = array('code' => 0, 'message' => 'Erreur : '.$resultat_request['message']);
				}
				else 
				{
					$games_list = $this->get_games_list_from_json($resultat_request['message']);
					$reponse = array('code' => 1, 'message' => $games_list);
				}
			}
			else
			{
				$reponse = array('code' => 0, 'message' => 'Erreur : '.$steamid['message']);
			}
			return $reponse;
		}

		public function get_games_list_from_json($json)
		{
			$games_array = json_decode($json);
			$games_list = $games_array->response->games;
			$list = new Steam_games_list(array());
			foreach ($games_list as $game) {
				$game_array = get_object_vars($game);
				$list->add_game(new Steam_game($game_array));
			}
			return $list;
		}

		// à faire
		public function get_profile_from_username($username)
		{
			$steamid = $this->get_steamid_from_username($username);
			if ($steamid['code']) {
				// TODO : get steam id from multiple usernames !
				$requete =  'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/';
				$requete = $requete.'?key='.$this->steamkey.'&steamids='.$steamid['message'];			
				$resultat_request = $this->get_curl($requete);
				if (!$resultat_request)
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
			$steam_profile_user = new Steam_profile($reponse);
			return $steam_profile_user;

		}

		public function get_achievement_from_username_and_gameid($username,$appid)
		{
			$steamid = $this->get_steamid_from_username($username);
			if ($steamid['code']) {
				// TODO : get steam id from multiple usernames !
				$requete =  'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/';
				$requete = $requete.'?appid='.$appid.'&key='.$this->steamkey.'&steamid='.$steamid['message'].'&l=english';			
				$resultat_request = $this->get_curl($requete);
				if (!$resultat_request)
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

		public function get_achievement_percentage_for_game($appid)
		{
			// TODO : get steam id from multiple usernames !
			$requete =  'http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/';
			$requete = $requete.'?gameid='.$appid.'&format=json';			
			$resultat_request = $this->get_curl($requete);
			if (!$resultat_request)
			{
				$reponse = array('code' => 0, 'message' => 'Erreur : '.$resultat_request['message']);					
			}
			else 
			{
				$reponse = array('code' => 1, 'message' => $resultat_request['message']);
			}
			return $reponse;
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