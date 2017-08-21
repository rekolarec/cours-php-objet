<?php 
	class Users{ // CreateReadUpdateDelete


		/*
			Variable Global
		*/
		private $db;

		function __construct($host, $user, $password, $database) {
            require_once "config.php";
            $this->host = DB_HOST;
            $this->user = DB_USER;
            $this->password = DB_PASSWORD;
            $this->database = DB_NAME;
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->user,$this->password, 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'))
			$this->db = new CRUD("localhost","root","","myshop");
		}
	
		public function addUser($user = array()){
			if(!isset($user['firstname'])){
                return 0;
			}
			elseif(!isset($user['lastname'])){
                return 0;
            }
			elseif(!isset($user['email'])){
                return 0;
            }
			elseif(!isset($user['password'])){
                return 0;
            }
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT); // Cryptage du mdp
            $this->$bd->insert(array("firstname","lastname","email","password"), $user,"clients");
        }
	}