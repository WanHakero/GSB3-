<html>
<head>
	<title>formulaire PRATICIEN</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			label.titre { width : 180 ;  clear:left; float:left; } 
			.zone { width : 300 ; float : left; color:white } -->
	</style>
</head>

<body>	


<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
		<h1> Praticiens </h1>
		<form name="formListeRecherche" method="post" action="Praticien">
			<select name="lstPrat" class="titre" >
				<option>Choisissez un praticien</option>
				<?php foreach ($tablePraticien as $table) {
					echo "<option value ='".$table['PRA_NUM']."'>".$table['PRA_NOM']." ".$table['PRA_PRENOM']."</option>";
					
					
				 } ?>
				
			</select>
			<input type="submit" value="chercher" />
		</form>
		<form id="formPraticien">
			<label class="titre">NUMERO :</label><label size="5" name="PRA_NUM" class="zone" ><?php echo  $Num; ?></label>
			<label class="titre">NOM :</label><label size="25" name="PRA_NOM" class="zone" ><?php echo $Nom ?></label>
			<label class="titre">PRENOM :</label><label size="30" name="PRA_PRENOM" class="zone" ><?php echo $Prenom ?></label>
			<label class="titre">ADRESSE :</label><label size="50" name="PRA_ADRESSE" class="zone" ><?php echo $Adresse ?></label>
			<label class="titre">CP :</label><label size="5" name="PRA_CP" class="zone" ><?php echo $CP ?></label>
			<label class="titre">COEFF. NOTORIETE :</label><label size="7" name="PRA_COEFNOTORIETE" class="zone" ><?php echo $COEFNOTORIETE ?></label>
			<label class="titre">TYPE :</label><label size="3" name="TYP_CODE" class="zone" ><?php echo $Code ?></label>
			<label class="titre">&nbsp;</label><div class="zone">
		</form>		
		<form name="formPrecedent" action="PraticienP" method="POST">
			<input type="hidden" name="lstPrat" value="<?php echo  $Num; ?>" />
			<input type="submit" value="&lt;" />
		</form>
		<form name="formSuivant" action="PraticienS" method="POST">
			<input type="hidden" name="lstPrat" value="<?php echo  $Num; ?>" />
			<input type="submit" value="&gt;" />
		</form>
		 
	</div>
</div>

</body>
</html>