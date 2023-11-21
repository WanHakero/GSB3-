<html>
<head>
	<title>formulaire MEDICAMENT</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			label.titre { width : 180 ;  clear:left; float:left; } 
			.zone { width : 30car ; float : left; color:7091BB } -->
	</style>
</head>

<body>

<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
		<h1> Pharmacopee </h1>
		<form name="formMEDICAMENT" method="post" action="MedicamentC">
		
			
				<label class="titre">DEPOT LEGAL :</label><input type="text" size="10" name="MED_DEPOTLEGAL" class="zone" value="<?php echo $Medicament['MED_DEPOTLEGAL'] ?>"/>
				<label class="titre">NOM COMMERCIAL :</label><input type="text" size="25" name="MED_NOMCOMMERCIAL" class="zone" value="<?php echo $Medicament['MED_NOMCOMMERCIAL'] ?>"/>
				<label class="titre">FAMILLE :</label><input type="text" size="3" name="FAM_CODE" class="zone" value="<?php echo $Medicament['FAM_CODE'] ?>"/>
				<label class="titre">COMPOSITION :</label><textarea rows="5" cols="50" name="MED_COMPOSITION" class="zone" ><?php echo $Medicament['MED_COMPOSITION'] ?></textarea>
				<label class="titre">EFFETS :</label><textarea rows="5" cols="50" name="MED_EFFETS" class="zone" ><?php echo $Medicament['MED_EFFETS'] ?></textarea>
				<label class="titre">CONTRE INDIC. :</label><textarea rows="5" cols="50" name="MED_CONTREINDIC" class="zone" ><?php echo $Medicament['MED_CONTREINDIC'] ?></textarea>
				<label class="titre">PRIX ECHANTILLON :</label><input type="text" size="7" name="MED_PRIXECHANTILLON" class="zone" value="<?php echo $Medicament['MED_PRIXECHANTILLON'] ?>"/>
				<label class="titre">&nbsp;</label>
				<input class="zone" type="submit" name="sens" value="&lt;"></input><input class="zone" type="submit" name="sens" value="&gt;"></input>
				<input type="hidden" name="ligne" value="<?php echo  $Ligne; ?>" />
		
	</form>
	</div>
</div>
</body>
</html>