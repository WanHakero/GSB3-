<?php
/*-------------------------- D�claration de la classe -----------------------------*/
class clstBDD {

/*----------------Propri�t�s de la classe  -----------------------------------*/
var $connexion ; 
var $dsn ="" ;

/*---------------------- Acc�s aux propri�t�s --------------------------------------*/
	function getConnexion() {
		return $this->connexion;
	}
	
/* --------------   Connexion � une base par un ODBC-------------- ------------------- */
	function connecte($pNomDSN, $pUtil, $pPasse) {
		//tente d'�tablir une connexion � une base de donn�es 
		$this->connexion = odbc_connect( $pNomDSN , $pUtil, $pPasse );	
		return $this->connexion; 		
	}
/* --------------   Requetes sur la base -------------- ------------------- */

	function requeteAction($req) {
		//ex�cute une requ�te action (insert, update, delete), ne retourne pas de r�sultat
		odbc_do($this->connexion,$req);
	}
	
	function requeteSelect($req) {
		//interroge la base (select) et retourne le curseur correspondant
		$retour = odbc_do($this->connexion,$req);
		return $retour;
	}
	
	function close() {
		odbc_close($this->connexion);
	}
}
?>