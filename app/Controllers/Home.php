<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        $session = session();
        $nom = $session->get('nom');
        echo "ok";
       
       if(!empty($nom))
        {
            return view('menuCR');
        }
        else
        {
            return view('connexion');
        } 
        
    }
    //Gere la connexion du visiteur puis renvoie la vue menuCR si la connexion est réussie
    public function connexion()
    {
        $session = session();
        $modele = new \App\Models\modele();
        $nom =$this->request->getPost('NOM');
        $mdp =$this->request->getPost('MDP');
      if($modele->verifConnexion($nom,$mdp))
        {
            $visiteur =$modele->getVisiteur($nom,$mdp);
            $_SESSION['id'] = $visiteur['VIS_MATRICULE'];
            $_SESSION['nom'] = $nom;
            return view('menuCR');
        }
        else
        {
            return view('connexion')
                    .view('error');
        }
       
    }
    //Détruit la session de connexion
    public function deconnexion()
    {
        $session = session();
        if($session->destroy())
        {
            return view('connexion');
        }
    }
    
    //Renvoie la view formMEDICAMENT.php 
    public function indexFORM_Medicament()
    {
        $modele = new \App\Models\modele();
        $data =['tableMedicament' => $modele->selectALL('MEDICAMENT')];
        return view('menuCR')
                .view('formMEDICAMENT',$data);
    }

    //Renvoie la view formPRATICIEN.php 
    public function indexFORM_Praticien()
    {
        $modele = new \App\Models\modele();
        $idPraticien =$this->request->getPost('lstPrat');
        $infoPraticien = $modele->selectPraticien( $idPraticien) ;
        
        if($infoPraticien == null){
            $data =['tablePraticien' => $modele->selectALL('PRATICIEN'),
            'Num' => " ",
            'Nom'=> " ",
            'Prenom'=> " ",
            'Adresse'=> " ",
            'CP'=> " ",
            'COEFNOTORIETE'=> " ",
            'Code'=> " "];
        }else{
            $data =['tablePraticien' => $modele->selectALL('PRATICIEN'),
            'Num' => $infoPraticien['PRA_NUM'],
            'Nom'=> $infoPraticien['PRA_NOM'],
            'Prenom'=> $infoPraticien['PRA_PRENOM'],
            'Adresse'=> $infoPraticien['PRA_ADRESSE'],
            'CP'=> $infoPraticien['PRA_CP'],
            'COEFNOTORIETE'=> $infoPraticien['PRA_COEFNOTORIETE'],
            'Code'=> $infoPraticien['TYP_CODE']];
        }
       
        return view('menuCR')
                .view('formPRATICIEN',$data);
    }

    //Renvoie la view formVISITEUR.php 
    public function indexFORM_Visiteur()
    {
        return view('menuCR')
                .view('formVISITEUR');
    }

    //Renvoie la view formRAPPORT_VISITE.php 
    public function indexRapport_Visiteur()
    {
        return view('menuCR')
                .view('formRAPPORT_VISITE.php');
    }
}
