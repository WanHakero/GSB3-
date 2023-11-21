<?php

namespace App\Controllers;

class RapportVisite extends BaseController
{
    public function indexRapport_Visiteur()
    {
        $modele = new \App\Models\modele();
       
        
        
       if($rv=$modele->estLock()){

        $idRapport =$rv['RAP_NUM'];
        
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

       echo  $info['PROD1'];
       echo  $info['PROD2'];
       
        return view('menuCR').view('enSavoirPlusCR',$data);
        }
        else{

        $erreur = '';
        $data = ['praticien' => $modele->selectALL('PRATICIEN'),
        'medicament' => $modele->selectALL('MEDICAMENT')
        ];
        return view('menuCR')
                .view('formRAPPORT_VISITE',$data);
    }
    }

    public function envoyerRapport()
    {
        $session = session();
        
        $i = 1;
        $produitN = 'PRA_ECH'.$i;
        $modele = new \App\Models\modele();

        
        
       $rapport =[
            'VIS_MATRICULE' => $_SESSION['id'],
            'RAP_NUM' => $this->request->getPost('RAP_NUM'),
            'RAP_DATEVISITE' => $this->request->getPost('RAP_DATEVISITE'),
            'PRA_NUM' => $this->request->getPost('PRA_NUM'),
            'PRA_COEFF' => $this->request->getPost('PRA_COEFF'),
            'RAP_DATE' => $this->request->getPost('RAP_DATE'),
            'RAP_MOTIF' => $this->request->getPost('RAP_MOTIF'),
            'RAP_BILAN' => $this->request->getPost('RAP_BILAN'),
            'PROD1' => $this->request->getPost('PROD1'),
            'PROD2' => $this->request->getPost('PROD2'),
            'RAP_DOC' => $this->request->getPost('RAP_DOC'),
            'RAP_LOCK' => $this->request->getPost('RAP_LOCK')
       ];
       
       $rules = [
        'PRA_NUM'=> 'required|numeric',
        'RAP_DATEVISITE' => 'required|valid_date[d/m/Y])',
        'PRA_COEFF' => 'numeric',
        'RAP_DATE'=> 'required|valid_date[d/m/Y]'
     ];
       
       
       
     

       $data = ['praticien' => $modele->selectALL('PRATICIEN'),
       'medicament' => $modele->selectALL('MEDICAMENT')];
       
       
        
        
       
        if($this->validate($rules)){
               
       $rapport['RAP_DATEVISITE'] =  $modele-> convertionDateBDD($rapport['RAP_DATEVISITE']);
       $rapport['RAP_DATE'] =  $modele-> convertionDateBDD($rapport['RAP_DATE']);

        
       if(empty($rapport['RAP_DOC'])){
        $rapport['RAP_DOC'] = 0;
        }else{
            $rapport['RAP_DOC'] = 1;
        }
        if(empty($rapport['RAP_LOCK'])){
            $rapport['RAP_LOCK'] = 0;
        }else{
            $rapport['RAP_LOCK'] = 1;
        }
        $modele -> insertTable('RAPPORT_VISITE',$rapport);
        while(! empty($info =$this->request->getPost($produitN))){
            
            $echantillion= [
                'RAP_NUM' => $this->request->getPost('RAP_NUM'),
                'PROD'  => $this->request->getPost($produitN)
            ];
            $modele -> insertTable('RAPPORT_VISITE_ECHANTILLIONTI',$echantillion);
            $i = $i+1;
            $produitN = 'PRA_ECH'.$i;
            
        }

            $er['ereur'] = "Compte rendu valider";
            return view('menuCR');
        }else{
            $er['ereur'] = "Erreur dans les champ";
            
            return view('menuCR')
            .view('formRAPPORT_VISITE',$data);

        }
    }
        public function modifierRapport(){
            $session = session();
            $modele = new \App\Models\modele();

            $rv=$modele->estLock();

            $idRapport =$rv['RAP_NUM'];
        
            $rapport =[
                 'VIS_MATRICULE' => $_SESSION['id'],
                 'RAP_NUM' => $idRapport,
                 'RAP_DATEVISITE' => $this->request->getPost('RAP_DATEVISITE'),
                 'PRA_NUM' => $this->request->getPost('PRA_NUM'),
                 'PRA_COEFF' => $this->request->getPost('PRA_COEFF'),
                 'RAP_DATE' => $this->request->getPost('RAP_DATE'),
                 'RAP_MOTIF' => $this->request->getPost('RAP_MOTIF'),
                 'RAP_BILAN' => $this->request->getPost('RAP_BILAN'),
                 'PROD1' => $this->request->getPost('PROD1'),
                 'PROD2' => $this->request->getPost('PROD2'),
                 'RAP_DOC' => $this->request->getPost('RAP_DOC'),
                 'RAP_LOCK' => $this->request->getPost('RAP_LOCK')
            ];
            
            $rules = [
             'PRA_NUM'=> 'required|numeric',
             'RAP_DATEVISITE' => 'required|valid_date[d/m/Y])',
             'PRA_COEFF' => 'numeric',
             'RAP_DATE'=> 'required|valid_date[d/m/Y]'
          ];
         
         
        if($this->validate($rules)){
           
            $rapport['RAP_DATEVISITE'] =  $modele-> convertionDateBDD($rapport['RAP_DATEVISITE']);
            $rapport['RAP_DATE'] =  $modele-> convertionDateBDD($rapport['RAP_DATE']);
     
             
            if(empty($rapport['RAP_DOC'])){
             $rapport['RAP_DOC'] = 0;
             }else{
                 $rapport['RAP_DOC'] = 1;
             }
             if(empty($rapport['RAP_LOCK'])){
                 $rapport['RAP_LOCK'] = 0;
             }else{
                 $rapport['RAP_LOCK'] = 1;
             }
             $modele -> modifRapportVisite( $rapport['RAP_NUM'],$rapport);
             return view('menuCR');
            }else{
                
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
        
        
        
       
    }
