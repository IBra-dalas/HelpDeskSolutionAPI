<?php 
require_once "models/Model.php";
//$date = date_create();
//$timestamp = date_timestamp_get($date);

class APIManager extends Model {

    //A l'initialisation 
    public function getBdRoles(){
        $req = "SELECT * FROM role";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $roles;
    } 
    public function connectBDUser($login,$mdp){
        // $req = "SELECT * from sonde as sd inner join station as s on s.IDStation = sd.IDStation WHERE sd.IDstation = :user_sonde
        // ";
        $req = "SELECT users.IDUSERS, users.login, users.password, users.IDSOCIETE, users.IDROLE, role.Privilege
        FROM `users` 
        INNER JOIN `societe` ON users.IDSOCIETE = societe.IDSOCIETE 
        INNER JOIN `role` ON users.IDROLE = role.IDROLE 
        WHERE users.login  = $login AND users.password = $mdp";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function createBDUser($nom,$prenom,$login,$mdp,$telephone,$mail,$id_entreprise,$id_role){
        $req = "INSERT INTO `users` (`nom`, `prenom`, `login`, `Password`, `telephone`,`mail`, `IDSOCIETE`, `IDROLE`) VALUES ($nom, $prenom, $login, $mdp, $telephone, $mail, $id_entreprise, $id_role)";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    public function createBDticket($title,$type,$target,$desc,$id){
        $req = "INSERT INTO ticket (title, image, Description, Commentaire, IDUSERS, IDstatus, IDType_ticket) VALUES ($title,$target,$desc,'',$id,6,$type)";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
    }
    public function getBDticketentreprise($idsociete){
        $req = "SELECT * FROM `ticket` INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE WHERE users.IDSOCIETE = $idsociete";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }

    public function getBDticketbyusers($iduser){
        $req = "SELECT * FROM `ticket` INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE WHERE users.IDUSERS = $iduser";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }

     // 
     public function GetBDTicketbystatus($idstatut){
        $req = "SELECT * from `ticket` RIGHT JOIN `statut` ON statut.IDstatus = ticket.IDstatus WHERE ticket.IDstatus = $idstatut";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
         $Ticket = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $Ticket;
    }

    public function getBDticket($idticket){
        $req = "SELECT * FROM `ticket` INNER JOIN `users` ON users.IDUSERS = ticket.IDUSERS INNER JOIN `societe` ON societe.IDSOCIETE = users.IDSOCIETE WHERE ticket.IDTICKETS = $idticket";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }

    public function getBDUser($login){
        $req = "SELECT users.IDUSERS FROM `users` WHERE users.login = $login";
        $stmt = $this->getBdd()->prepare($req);
        // $stmt->bindValue(":login",$login,":mdp",$mdp,PDO::PARAM_EVT_EXEC_POST);
        $stmt->execute();
        $lignesSonde = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesSonde;
    }
    // POUR LA PAGE ADMIN
    public function getBdSociete(){
        $req = "SELECT * from societe";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $societe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return  $societe;
    }
    public function verifBdSociete($societe,$code){
        $req = "SELECT IDSOCIETE from societe WHERE Nom_societe = $societe AND code = $code";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $societe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return  $societe;
    }
   

    public function getBdTypeTicket(){
        $req = "SELECT *  from type_ticket";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
         $typeTicket = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $typeTicket;
    }

    // Tous les releves POUR ADMIN
    public function getBdStatut(){
        $req = "SELECT *  from statut";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $status = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $status;
    }
    

    public function getBDdernierReleve($user_sonde){
        $req = "SELECT * FROM `releve` WHERE IdSonde = :user_sonde LIMIT 1";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":user_sonde",$user_sonde,PDO::PARAM_INT);
        $stmt->execute();
        $releve = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $releve;
    }

    // POUR ADMIN
    public function getBDderniersReleves(){
        $req = "SELECT * FROM `releve` LIMIT 10";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $releve = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $releve;
    }
}