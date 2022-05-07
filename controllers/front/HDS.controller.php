<?php
 require_once "models/front/HDS.DAL.php";
 require_once "models/Model.php";
 require_once "models/back/JsonService/Json.php";

 
    class APIController {
        private $apimanager;
    
        public function __construct(){
            $this->apimanager = new APIManager();
        }
        public function getUser($iduser){  
            $roles = $this->apimanager->getBdUser($iduser);
             Json::sendJSON($roles);
         }

        public function getRoles(){  
           $roles = $this->apimanager->getBdRoles();
            Json::sendJSON($roles);
        }
        public function postConnect($login,$mdp){ 
            $connect = $this->apimanager->connectBdUser($login,$mdp);
            Json::sendJSON($connect);
        }
        public function create_compte($nom,$prenom,$login,$mdp,$telephone,$mail,$id_entreprise,$id_role){ 
            $create_compte = $this->apimanager->createBdUser($nom,$prenom,$login,$mdp,$telephone,$mail,$id_entreprise,$id_role);
            Json::sendJSON($create_compte);
        }
        public function create_ticket($title,$type,$target,$desc,$id){ 
            $create_ticket = $this->apimanager->createBDticket($title,$type,$target,$desc,$id);
            Json::sendJSON($create_ticket);
        }
        
        
        public function GetTicketbystatus($idsociete){ 
            $GetTicketEntreprise = $this->apimanager->GetBDTicketbystatus($idsociete);
            Json::sendJSON($GetTicketEntreprise);
        }

        public function GetTicketEntreprise($idsociete){ 
            $GetTicketEntreprise = $this->apimanager->getBDticketentreprise($idsociete);
            Json::sendJSON($GetTicketEntreprise);
        }

        public function GetTicketbyusers($iduser){ 
            $GetTicketEntreprise = $this->apimanager->getBDticketbyusers($iduser);
            Json::sendJSON($GetTicketEntreprise);
        }

        public function getticket($idticket){ 
            $GetTicketEntreprise = $this->apimanager->getBDticket($idticket);
            Json::sendJSON($GetTicketEntreprise);
        }

        public function getcompte($login){ 
            $get_compte = $this->apimanager->getBdUser($login);
            Json::sendJSON($get_compte);
        }
      //  public function getReleveUser($releve_user){
      //      $releve = $this->apimanager->getBDReleves($releve_user);
      //      Json::sendJSON($releve);
     //   }
       // public function getUser($user_sonde){
       //     $sonde = $this->apimanager->getBDSonde($user_sonde);
       //     Json::sendJSON($sonde);
      //  }
        public function getStatus(){
            $status = $this->apimanager->getBdStatut();
            Json::sendJSON($status);

        }    
        public function getTypeTicket(){
            $typeTicket = $this->apimanager->getBdTypeTicket();
            Json::sendJSON($typeTicket);
            // echo "<pre>";
            // print_r($stations);
            // echo "</pre>";
           
        }
        public function getSociete(){
            $societe = $this->apimanager->getBdSociete();
            Json::sendJSON($societe);
        }
        public function verifSociete($societe,$code){
            $verifsociete = $this->apimanager->verifBdSociete($societe,$code);
            Json::sendJSON($verifsociete);
        }
        
    }
