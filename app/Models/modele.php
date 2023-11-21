<?php
namespace App\Models;
use CodeIgniter\Model;

class modele extends Model
{

    
    //Renvoie  un tableau avec les tous les information de la table mis en paramétre
    public function selectALL($table){
        $bdd = db_connect();
        $builder = $bdd ->table($table);
        $query = $builder -> get();
        $row = $query->getResultArray();
        $bdd->close;
        return $row;
    }

     //Verifie les informations de connexion d'un visiteur
     public function verifConnexion($nom,$mdp){
        $bdd = db_connect();
        $date = $mdp." 00:00:00";
        $query = $bdd->query('SELECT * FROM VISITEUR WHERE VIS_NOM = "'.$nom.'" AND VIS_DATEEMBAUCHE = "'.$date.'"');
        $nb = $query->getNumRows();
        $bdd->close;
        if($nb == 1)
            return true;
        else
            return false;
    }

    public function getVisiteur($nom,$mdp){
        $bdd = db_connect();
        $date = $mdp." 00:00:00";
        $builder = $bdd ->table("VISITEUR");
        $builder->where('VIS_NOM', $nom);
        $builder->where('VIS_DATEEMBAUCHE', $date);
        $query = $builder -> get();
        $row = $query->getRowArray();
        $bdd->close;
        return $row;
    }

    public function estLock(){
        $bdd = db_connect();
        $builder = $bdd ->table("RAPPORT_VISITE");
        $builder->where('RAP_LOCK',0);
        $query = $builder -> get();
        $row = $query->getRowArray();
        $bdd->close;
        return $row;
    }
    //Renvoie les information du praticine mis en parametre
    public function selectPraticien($IDpraticien){
        $bdd = db_connect();
        $builder = $bdd ->table('PRATICIEN');
        $builder->where('PRA_NUM', $IDpraticien);
        $query = $builder -> get();
        $row = $query->getRowArray();
        $bdd->close;
        return $row;
    }
    //Renvoie les information du medicament avec son numero de ligne dans la base de données
    public function selectMedicament($NumeLigne){
        $bdd = db_connect();
        $builder = $bdd ->table('MEDICAMENT');
        $builder->limit(1,$NumeLigne);
        $query = $builder -> get();
        $row = $query->getRowArray();
        $bdd->close;
        return $row;
    }

    public function insertTable($table,$data){
        $bdd = db_connect();
        $bdd->table($table)->insert($data);
    }

    public function selectCompteRendue($IDCP){
        $bdd = db_connect();
        $builder = $bdd ->table('RAPPORT_VISITE');
        $builder->where('RAP_NUM', $IDCP);
        $query = $builder -> get();
        $row = $query->getRowArray();
        $bdd->close;
        return $row;
    }

    public function selectEchantillion($IDCP){
        $bdd = db_connect();
        $builder = $bdd ->table('RAPPORT_VISITE_ECHANTILLIONTI');
        $builder->where('RAP_NUM', $IDCP);
        $query = $builder -> get();
        $row = $query->getResultArray();
        $bdd->close;
        return $row;
    }
    

   /* public function dateForm(){
    
    for($i = 0; $i < 30; $i++){
        $jour[$i] = $i+1;
    }
    for($i = 0; $i < 12; $i++){
        $moisID[$i] = $i+1;
    }
    $mois[1] ='Janvier';
    $mois[2] ='Février';
    $mois[3] ='Mars';
    $mois[4] ='Avril';
    $mois[5] ='Mai';
    $mois[6] ='Juin';
    $mois[7] ='Juillet';
    $mois[8] ='Août';
    $mois[9] ='Septembre';
    $mois[10] ='Octobre';
    $mois[11] ='Novembre';
    $mois[12] ='Décembre';

    $today = date("Y");

    for($i = 0; $i < 20; $i++){
        $annee[$i] = $today -1;
    }
    $date =[
        'unJour' => $jour,
        'unMoisID' => $moisID,
        'unMois' => $mois,
        'uneAnnee' =>$annee
    ];
    return $date;
    }*/

    public function convertionDateBDD($date){
       $partiD = explode("/", $date);

       $newDate = $partiD[2]."-".$partiD[1]."-".$partiD[0];
       return $newDate;
    }
    
    public function convertionDate($date){
        $partiD = explode("-", $date);
 
        $newDate = $partiD[2]."/".$partiD[1]."/".$partiD[0];
        return $newDate;
     }
    public function rapportVisite($visiteur,$dateD,$dateFin){
        $bdd = db_connect();
        $query = $bdd->query("SELECT * FROM RAPPORT_VISITE WHERE VIS_MATRICULE ='".$visiteur."' AND RAP_DATE BETWEEN '".$dateD."' AND '".$dateFin."' ORDER BY RAP_DATE" );
       
        $row = $query->getResultArray();
        $bdd->close;
        return $row;


    }

    public function modifRapportVisite($id,$data)
    {
        $bdd = db_connect();
        $builder =$bdd->table("RAPPORT_VISITE");
        $builder->where('RAP_NUM', $id);
        $builder->update($data);
    }

    
}