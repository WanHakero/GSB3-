<html>
<head>
	<title>formulaire VISITEUR</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			.titre { width : 180 ;  clear:left; float:left; } 
			.zone { width : 30car ; float : left; color:7091BB } -->
	</style>
</head>

<body>

<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
	<h1> Visiteurs </h1>
	<form name="formListeRecherche" method="post" action="Visiteur">
        <select name="lstVis" class="titre" >
			<option>Choisissez un visiteur</option>
			<?php foreach ($tableVisiteur as $table) {
				echo "<option value ='".$table['VIS_MATRICULE']."'>".$table['VIS_NOM']." ".$table['Vis_PRENOM']."</option>";				
			 } ?>
				
		</select>
		<input type="submit" value="chercher" />
	</form>
	
	<form name="formVISITEUR">
		<label class="titre">NOM :</label><input type="text" name="VIS_NOM" class="zone" value="<?php echo  $Nom; ?>"/>
		<label class="titre">PRENOM :</label><input type="text" name="Vis_PRENOM" class="zone" value="<?php echo  $Prenom; ?>"/>
		<label class="titre">ADRESSE :</label><input type="text" name="VIS_ADRESSE" class="zone" value="<?php echo  $Adresse; ?>"/>
		<label class="titre">CP :</label><input type="text" name="VIS_CP" class="zone" value="<?php echo  $CP; ?>"/>
		<label class="titre">VILLE :</label><input type="text" name="VIS_VILLE" class="zone" value="<?php echo  $Ville; ?>"/>
		<label class="titre">SECTEUR :</label><input type="text" name="SEC_CODE" class="zone" value="<?php echo  $Secteur; ?>"/>
	</form>
    <form name="formPrecedent" action="VisiteurP" method="POST">
			<input type="hidden" name="lstVis" value="<?php echo  $Mat; ?>" />
			<input type="submit" value="&lt;" />
		</form>
		<form name="formSuivant" action="VisiteurS" method="POST">
			<input type="hidden" name="lstVis" value="<?php echo  $Mat; ?>" />
			<input type="submit" value="&gt;" />
		</form>
	</div>
</div>

</body>
</html>