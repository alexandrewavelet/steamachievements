<?php
error_reporting(E_ERROR | E_PARSE | E_WARNING);

$user = new user;
$user->domain = "localhost"; // put your domain


class user
{
    public static $domain;

    public function signIn ()
    {
        require_once 'lightopenid-lightopenid\openid.php';
        $openid = new LightOpenID($this->domain);
        if(!$openid->mode)
        {
            $openid->identity = 'http://steamcommunity.com/openid';
            header('Location: ' . $openid->authUrl());
        }
        elseif($openid->mode == 'cancel')
        {
            print ('User has canceled authentication!');
        }
        else
        {
            if($openid->validate())
            {
                preg_match("/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/", $openid->identity, $matches); // steamID: $matches[1]
                print_r($matches[1]);
                setcookie('steamid', $matches[1], time()+(60*60*24*7), '/'); // 1 week
                #header('location: index.php');
                exit;
            }
            else
            {
                print ('fail');
            }
        }
    }
}

if(isset($_GET['login']))
{
    $steamid=$user->signIn();
    print_r($steamid);
}
if (array_key_exists( 'logout', $_POST ))
{
    setcookie('steamID', '', -1, '/');
    header('Location: index.php');
}


if(!$_COOKIE['steamID'])
{
    print ('<form action="?login" method="post">
        <input type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_border.png"/>
        </form>');
}
else
{
    print('<form method="post"><button title="Logout" name="logout">Logout</button></form>');
}
?>