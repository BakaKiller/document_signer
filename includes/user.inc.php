<?php
class user {
    public static $TABLE = 'user';
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $creationdate;
    public $lastconnection;
    public $privatekey;
    public $active;

    function __construct($data) {
        global $db;
        if ($data->id) {
            $user = $db->read(self::$TABLE, $data->id)->fetch();
        } else if ($data->email) {
            $user = $db->read(self::$TABLE, $data->email, 'email')->fetch();
        } else {
            throw new Exception('No id or email given !');
        }

        $this->id = $user->id;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->creationdate = $user->creationdate;
        $this->lastconnection = $user->lastconnection;
        $this->privatekey = $user->privatekey;
        $this->active = ($user->active == 1 ? true : false);
    }

    public function __set($name, $value) {
        if ($name == 'password') {
            $this->password = hash('sha256', $value);
        }
    }

    public function __destruct() {
        global $db;
        $db->update(
            self::$TABLE,
            [
                'lastname' => $this->lastname,
                'firstname' => $this->firstname,
                'email' => $this->email,
                'password' => $this->password,
                'lastconnection' => time(),
                'active' => ($this->active === true ? 1 : 0)
            ]
        );
    }

    public static function create($email, $password, $lastname = null, $firstname = null) {
        global $db;
        $time = time();
        $salt = rand(0, 1000);
        $user = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => hash('sha256', $password),
            'creationdate' => $time,
            'lastconnection' => $time,
            'privatekey' => hash('sha256', "$email-$time-$salt")
        ];
        $db->create(self::$TABLE, $user);
    }
}