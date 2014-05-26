<?php
include("get_profile_from_username.php");
	/**
	* Steam Profil API
	*/
	class Profil_API
	{
		protected $steamid;
		protected $communityvisibilitystate;
		protected $profilestate;
		protected $personaname;
		protected $lastlogoff;
		protected $profileurl;
		protected $avatar;
		protected $avatarmedium;
		protected $avatarfull;
		protected $personastate;
		protected $primaryclanid;
		protected $timecreated;
		protected $personastateflags;

		function __construct($profil)
		{
			$profil=explode("&",$profil["message"]);
			$profil=json_decode($profil[0]);
			$profil=$profil->response;
			$player=$profil->players;
			$player=$player[0];
			$this->steamid=$player->steamid;
			$this->communityvisibilitystate=$player->communityvisibilitystate;
			$this->profilestate=$player->profilestate;
			$this->personaname=$player->personaname;
			$this->lastlogoff=$player->lastlogoff;
			$this->profileurl=$player->profileurl;
			$this->avatar=$player->avatar;
			$this->avatarmedium=$player->avatarmedium;
			$this->avatarfull=$player->avatarfull;
			$this->personastate=$player->personastate;
			$this->primaryclanid=$player->primaryclanid;
			$this->timecreated=$player->timecreated;
			$this->personastateflags=$player->personastateflags;
		}

	}
	include('Manager_api.php');
	$manager = new Manager_api();
	$prof=$manager->get_profile_from_username("arnitri");
	$profile= new Profil_API($prof);
	print_r($profile);
?>