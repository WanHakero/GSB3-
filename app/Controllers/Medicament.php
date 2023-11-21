<?php

namespace App\Controllers;

class Medicament extends BaseController
{

     //Renvoie la view formMEDICAMENT.php 
     public function indexFORM_Medicament()
     {
        $modele = new \App\Models\modele();
        $data =["Ligne" =>  0,
        "Medicament" => $modele->selectMedicament(0)];
         
         return view('menuCR')
                 .view('formMEDICAMENT',$data);
     }

     public function choixMedicament(){
        $modele = new \App\Models\modele();
        $ligne =$this->request->getPost('ligne');
        $infoFormulaire=$this->request->getPost('sens');
       
            if($infoFormulaire == "<"){
                if($ligne == 0){
                    $ligne = 0;
                }else{
                    $ligne = $ligne - 1;
                }
            }else{
                $ligne = $ligne + 1;
            }
         
         
         $data =["Ligne" =>  $ligne,
        "Medicament" => $modele->selectMedicament($ligne)];

        return view('menuCR')
        .view('formMEDICAMENT',$data);
     }

}