<?php 

require "crud.php";


	class Users extends CRUD{ // CreateReadUpdateDelete


		function __construct() {
            parent::__construct();
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

			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT); // cryptage du mdp.

			$this->insert($user, "clients" );

        }
        
        public function addfavorie($userId, $itemId){
            if(!is_int($userId)){
                return 0;
            }
            elseif(!is_int($itemId)){
                return 0;
            }
            $idFavorie = $this->insert(array("clients_idclients" => $userId,"items_iditems" => $itemId), "clients_has_items");
        }

        // afficher les favorie
        public function listenerFavorie($userId){
            if(!is_int($userId)){
                return 0;
            }
            $myFavorie = $this->select("*", "listenerFavorie", array("idclients"=> $userId));
            var_dump($myFavorie);

            //requete de selection en mysql
            // en jointuremanuelle afin de faire une view   
        //     SELECT
        //     i.*, c.idclients
        // FROM
        //     `items` i, 
        //     `clients` c,
        //     `clients_has_items` chi
        // WHERE
        //     chi.items_iditems = `iditems` AND chi.clients_idclients = c.idclients AND // sans la suite pour créer la vue // c.idclients = 1
        }

        // afficher les adresses
        public function listenerDelivery($userId, $type = null){
            if(!isset($userId)){
                return 0;
            }
            if($type == null)
            $myDelivery = $this->select("*", "delivery", array("clients_idclients"=> $userId));
            else
            $myDelivery = $this->select("*", "delivery", array("clients_idclients"=> $userId, "type"=> $type));
            var_dump($myDelivery);
        }

        public function addDelivery($userId, $delivery){
            if(!isset($userId)){
                return 0;
            }
            elseif(!isset($delivery['street'])){
                return 0;
            }
            elseif(!isset($delivery['city'])){
                return 0;
            }
            elseif(!isset($delivery['country'])){
                return 0;
            }
            $delivery["clients_idclients"] = $userId;
            $idDelivery = $this->insert($delivery, "delivery");
            
        }

        // ajouter des commandes
        public function addOrder($userId, $deliveryId){
            if(!is_int($userId)){
                return 0;
            }
            elseif(!is_int($deliveryId)){
                return 0;
            }
            $order = array('num_order'=> $this->randomByUserAlphNum());
			$order["clients_idclients"] = $userId;
			$order["delivery_iddelivery"] = $deliveryId;
			$idOrder = $this->insert( $order, "orders" );
        }

        /// affichage des commandes
        public function listenerOrder($userId, $dateOrder = null){
            if(!is_int($userId)){
                return 0;
            }
            if($dateOrder == null)
            $myOrders = $this->select("*", "orders", array("clients_idclients"=> $userId));
            else
            $myOrders = $this->select("*", "orders", array("clients_idclients"=> $userId, "date_order"=> $dateOrder));
            var_dump($myOrders);
        }

  
    /*************************************/
    //création d'un random alpha numérique
        private function randomByUserAlphNum(){
            return "#".substr(md5(uniqid("User",true)), 10);
        }
    }
  
   

    $test = new Users();
    //$test->addUser(array('firstname' => "Mike" , 'lastname' => "Sylvestre", 'email' =>"Mike@Mike.Mike", 'password' => "motdepasse", 'phone' => "0652638987", 'civility' => "f" ));

    //$test->addfavorie(1,3);
    
    //$test->listenerFavorie(1);

    //$test->listenerDelivery(1, Livraisons);
    //$test->addDelivery(2, array('street' => "rue de d'ici", 'city' => "Paris", 'country' => "France", 'type' => "Livraisons"));
    //$test->addOrder(1,1);
    
    $test->listenerOrder(1,0);