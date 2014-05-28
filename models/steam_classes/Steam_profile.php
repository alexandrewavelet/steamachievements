<?php
	/**
	* Steam profile class
	*/
class Steam_profile 
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
		foreach ($player as $key => $value) {
			$this->$key = $value;
		}
	}

	
    /**
     * Gets the value of steamid.
     *
     * @return mixed
     */
    public function getSteamid()
    {
        return $this->steamid;
    }

    /**
     * Gets the value of communityvisibilitystate.
     *
     * @return mixed
     */
    public function getCommunityvisibilitystate()
    {
        return $this->communityvisibilitystate;
    }

    /**
     * Gets the value of profilestate.
     *
     * @return mixed
     */
    public function getProfilestate()
    {
        return $this->profilestate;
    }

    /**
     * Gets the value of personaname.
     *
     * @return mixed
     */
    public function getPersonaname()
    {
        return $this->personaname;
    }

    /**
     * Gets the value of lastlogoff.
     *
     * @return mixed
     */
    public function getLastlogoff()
    {
        return $this->lastlogoff;
    }

    /**
     * Gets the value of profileurl.
     *
     * @return mixed
     */
    public function getProfileurl()
    {
        return $this->profileurl;
    }

    /**
     * Gets the value of avatar.
     *
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Gets the value of avatarmedium.
     *
     * @return mixed
     */
    public function getAvatarmedium()
    {
        return $this->avatarmedium;
    }

    /**
     * Gets the value of avatarfull.
     *
     * @return mixed
     */
    public function getAvatarfull()
    {
        return $this->avatarfull;
    }

    /**
     * Gets the value of personastate.
     *
     * @return mixed
     */
    public function getPersonastate()
    {
        return $this->personastate;
    }

    /**
     * Gets the value of primaryclanid.
     *
     * @return mixed
     */
    public function getPrimaryclanid()
    {
        return $this->primaryclanid;
    }

    /**
     * Gets the value of timecreated.
     *
     * @return mixed
     */
    public function getTimecreated()
    {
        return $this->timecreated;
    }

    /**
     * Gets the value of personastateflags.
     *
     * @return mixed
     */
    public function getPersonastateflags()
    {
        return $this->personastateflags;
    }
}

?>
