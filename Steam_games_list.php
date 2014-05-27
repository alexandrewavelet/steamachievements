<?php

	/**
	* Class Steam games list
	*/
	class Steam_games_list implements Iterator
	{
		
		protected $position;
		protected $games_list;
		protected $games_count;

		function __construct($list)
		{
			$this->games_list = $list;
			$this->games_count = count($list);
			$this->position = 0;
		}

		// Iterator implementation

		public function rewind()
		{
			$this->position = 0;
		}

		public function current()
		{
			return $this->games_list[$this->position];
		}

		public function key()
		{
			return $this->position;
		}

		public function next()
		{
			$this->position ++;
		}

		public function valid()
		{
			return isset($this->games_list[$this->position]);
		}


		// Getters
	
		/**
		* Gets the value of games_list.
		*
		* @return mixed
		*/
		public function getGames_list()
		{
			return $this->games_list;
		}

		/**
		* Gets the value of games_count.
		*
		* @return mixed
		*/
		public function getGames_count()
		{
			return $this->games_count;
		}

		public function add_game(Steam_game $game)
		{
			array_push($this->games_list, $game);
			$this->games_count ++;
		}
}

?>