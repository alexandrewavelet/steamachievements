<?php

	/**
	* steam game class
	*/
	class Steam_game
	{
		
		protected $appid;
		protected $name;
		protected $playtime_forever;
		protected $playtime_2weeks = 0;
		protected $img_icon_url;
		protected $img_logo_url;
		protected $has_community_visible_stats;


		function __construct($array_infos)
		{
			foreach ($array_infos as $key => $value) {
				$this->$key = $value;
			}
		}
	
		/**
		* Gets the value of appid.
		*
		* @return mixed
		*/
		public function getAppid()
		{
			return $this->appid;
		}

		/**
		* Gets the value of name.
		*
		* @return mixed
		*/
		public function getName()
		{
			return $this->name;
		}

		/**
		* Gets the value of playtime_forever.
		*
		* @return mixed
		*/
		public function getPlaytime_forever()
		{
			return $this->playtime_forever;
		}

		/**
		* Gets the value of playtime_2weeks.
		*
		* @return mixed
		*/
		public function getPlaytime_2weeks()
		{
			return $this->playtime_2weeks;
		}

		/**
		* Gets the value of img_icon_url.
		*
		* @return mixed
		*/
		public function getImg_icon_url()
		{
			return $this->img_icon_url;
		}

		/**
		* Gets the value of img_logo_url.
		*
		* @return mixed
		*/
		public function getImg_logo_url()
		{
			return $this->img_logo_url;
		}

		/**
		* Gets the value of has_community_visible_stats.
		*
		* @return mixed
		*/
		public function getHas_community_visible_stats()
		{
			return $this->has_community_visible_stats;
		}

		// functions

		public function has_logo()
		{
			$value = (isset($this->img_logo_url) && $this->img_logo_url != '') ? true : false ;
			return $value;
		}

		public function get_logo()
		{
			$url = 'http://media.steampowered.com/steamcommunity/public/images/apps/'.$this->appid.'/'.$this->img_logo_url.'.jpg';
			return $url;
		}
}

?>