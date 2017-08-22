<?php 

require "crud.php";


	class Items extends CRUD{ // CreateReadUpdateDelete


		function __construct() {
            parent::__construct();

		}

	
// ajout des produits
		public function addItem($items = array()){

			if(!isset($items['libelle'])){

				return 0;
			}
			elseif(!isset($items['description'])){
				return 0;
			}
			elseif(!isset($items['stocks'])){
				return 0;
			}
			elseif(!isset($items['price'])){
				return 0;
            }
            //$items["categories_idcategories"] = $idCategories;
			$this->insert($items, "items" );
        }

        // modification d'un item
        public function modifyItem($itemData){
            if(!isset($itemData['iditems'])){
                return 0;
            }
            $idItem = array("iditems" => $itemData['iditems']);
            unset($itemData['iditems']);    
            $this->update($itemData, $idItem, "items" );
            
        }

        // suppression d'un item
        public function deleteItem($idItem){
            if(!isset($idItem['iditems'])){
                return 0;
            }
            $idItem =  $idItem['iditems']);
            $this->delete($idItem, "items");
        }
    
        // suppression d'un item à une commande
        public function deleteItemInOrder($idItem){
            if(!isset($idItem['iditems'])){
                return 0;
            }
            $idItem =  $idItem['iditems']);
            $this->delete($idItem, "items");
        }

         // liste des images et de l'item
         public function listenerItem($idItem, $type = null){
            if(!isset($idItem)){
                return 0;
            }
            if($type == null)
            $myItem = $this->select("*", "items", array("clients_idclients"=> $userId));
            else
            $myItem = $this->select("*", "delivery", array("clients_idclients"=> $userId, "type"=> $type));
            var_dump($myDelivery);
        }
    
    }
  
   

    $test = new Items();
   //$test->addItem(array('libelle' => "Mike" , 'description' => "Sylvestre", 'stocks' =>"254", 'price' => "2.99", 'categories_idcategories'=> "1"));
    //$test->modifyItem(array("iditems" => 18,'description' => "Sylvestre un compagnon de vie ", 'stocks' =>"254"));
  
   // requete suppression
    //$test->deleteItem(array("iditems" =>18));

    // requeter suppression d'un item à une commande
    //$test->deleteItemInOrder(array("iditems" =>18));

    // liste des images et de l'item
    $test->listenerItem;

    