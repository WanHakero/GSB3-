<?php

namespace App\Controllers;

class ConsulterCompteRendue extends BaseController
{
    public function indexConsulter(){

        
        $modele = new \App\Models\modele();
         
        
        return view('menuCR').view('consulterRAPPORT');
    }

    public function consulte(){
        $modele = new \App\Models\modele();

        $date_d =$this->request->getPost('DATE_D');
        $date_f =$this->request->getPost('DATE_F');

        $date_d = $modele->convertionDateBDD($date_d);
        $date_f = $modele->convertionDateBDD($date_f);
        $info =  $modele->rapportVisite('a131',$date_d ,$date_f);
        
       
        
    
        $data = [
            'info' => $info 
        ];

        return view('menuCR').view('consulterRAPPORT').view('infoRAPPORT',$data);
    }

    public function enSavoirPlus(){
        $modele = new \App\Models\modele();
        $idRapport =$this->request->getPost('RAP_NUM');
        
        $info =$modele->selectCompteRendue($idRapport);
       if($info['RAP_LOCK'] == 1){
        $info['RAP_LOCK'] = true;
       }else{
        $info['RAP_LOCK'] = false;
       }
       if($info['RAP_DOC'] == 1){
        $info['RAP_DOC'] = true;
        }else{
        $info['RAP_DOC'] = false;
       }

        $info['RAP_DATE'] = $modele-> convertionDate($info['RAP_DATE'] );
        $info['RAP_DATEVISITE'] = $modele-> convertionDate($info['RAP_DATEVISITE'] );

        $infoPraticien = $modele->selectPraticien($info['PRA_NUM']);
        $data = [
                'praticien' => $modele->selectALL('PRATICIEN'),
                'medicament' => $modele->selectALL('MEDICAMENT'),
                'info' => $info,
                'infoPra' =>  $infoPraticien,
                'echantillion' =>$modele-> selectEchantillion($idRapport)
                
            ];
    
        
        return view('menuCR').view('enSavoirPlusCR',$data);
    }
}