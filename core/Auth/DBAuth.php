<?php
namespace Core\Auth;

use Core\Database\Database;

/**
* 
*/
class DBAuth
{
    private $db;

    function __construct(Database $db)
    {
        $this->db = $db;
    }


    public function getUserID()
    {
        if($this->logged()){
            return $_SESSION['auth'];
        }
        return false;
    }


    /**
     * Se connecter à l'application
     * @param $email
     * @param $password
     * @return boolean
     */
    public function login($email, $password)
    {
        $user = $this->db->prepare('SELECT * FROM users WHERE email = ?', [$email], null, true);
        if ($user) {
            if($user->password === sha1($password)){
                $_SESSION['auth'] = $user->id;
                $_SESSION['type'] = $user->type;
                return true;
            }
        }
        return false;
    }

    /**
     * Vérifier si l'utilisateur est connecté
     * @return boolean
     */
    public function logged()
    {
        return isset($_SESSION['auth']);
    }

}