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

			$resultat_request = $this->getCURL($request);
			if (!$resultat_request['code'])
			{
				$reponse = array('code' => 0, 'message' => 'Erreur : '.$resultat_request['message']);
			}
			else 
			{
				preg_match("#<steamID64>[0-9]+#",$resultat_request['message'],$match);
				$reponse = array('code' => 1, 'message' => $match[0]);
			}
			return $reponse;
		}

		public function getCURL($request)
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