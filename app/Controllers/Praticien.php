<?php

namespace App\Controllers;

class Praticien extends BaseController
{
    

    //Renvoie la view formPRATICIEN.php 
    public function indexFORM_Praticien()
    {
        $modele = new \App\Models\modele();
        $idPraticien =$this->request->getPost('lstPrat');
        $infoPraticien = $modele->selectPraticien( $idPraticien) ;
        
        if(empty($infoPraticien)){
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

    
    public function praticienPrecedent(){
        $modele = new \App\Models\modele();
        $idPraticien =$this->request->getPost('lstPrat');
        
        
        if($idPraticien == " "){
            $idPraticien = 86;
        }else{
            $idPraticien = $idPraticien -1;
        }
        
        $infoPraticien = $modele->selectPraticien( $idPraticien) ;

        if(empty($infoPraticien)){
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

    public function praticienSuivant(){
        $modele = new \App\Models\modele();
        $idPraticien =$this->request->getPost('lstPrat');
        
      
        if($idPraticien == " "){
            $idPraticien = 1;
          
        }else{
            $idPraticien = $idPraticien +1;
        }
       
        
        $infoPraticien = $modele->selectPraticien( $idPraticien) ;

        if(empty($infoPraticien)){
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
}