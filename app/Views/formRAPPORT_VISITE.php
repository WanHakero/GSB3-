<html><head>
	<title>formulaire RAPPORT_VISITE</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			label.titre { width : 180 ;  clear:left; float:left; } 
			.zone { width : 30car ; float : left; color:5599EE } -->
	</style>
	<script language="javascript">
		function selectionne(pValeur, pSelection,  pObjet) {
			//active l'objet pObjet du formulaire si la valeur s�lectionn�e (pSelection) est �gale � la valeur attendue (pValeur)
			if (pSelection==pValeur) 
				{ formRAPPORT_VISITE.elements[pObjet].disabled=false; }
			else { formRAPPORT_VISITE.elements[pObjet].disabled=true; }
		}
	</script>
	
	 <script language="javascript">
        function ajoutLigne( pNumero){//ajoute une ligne de produits/qt� � la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incr�mente le num�ro de ligne
            var laDiv=document.getElementById("lignes");	//r�cup�re l'objet DOM qui contient les donn�es
			var titre = document.createElement("label") ;	//cr�e un label
			laDiv.appendChild(titre) ;						//l'ajoute � la DIV
			titre.setAttribute("class","titre") ;			//d�finit les propri�t�s
			titre.innerHTML= "   Produit : ";
			var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
			laDiv.appendChild(liste) ;
			liste.setAttribute("name","PRA_ECH"+pNumero) ;
			liste.setAttribute("class","zone");
			//remplit la liste avec les valeurs de la premi�re liste construite en PHP � partir de la base
			liste.innerHTML=formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
			var qte = document.createElement("input");
			laDiv.appendChild(qte);
			qte.setAttribute("name","PRA_QTE"+pNumero);
			qte.setAttribute("size","2"); 
			qte.setAttribute("class","zone");
			qte.setAttribute("type","text");
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion �venementielle en faisant �voluer le num�ro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }
    </script>
</head>

<body>

<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
		<form name="formRAPPORT_VISITE" method="post" action="RapportVisiteurE">
			<h1> Rapport de visite </h1>
			<label class="titre">NUMERO :</label><input type="text" size="10" name="RAP_NUM" class="zone" />
			<label class="titre">DATE VISITE :</label><input type="text" size="20" name="RAP_DATEVISITE" class="zone" />
			<label class="titre">PRATICIEN :</label><select  name="PRA_NUM" class="zone" ><option>Choisissez un praticien</option>
			<?php foreach ($praticien as $table) {?>
					 <option value ="<?php  echo $table['PRA_NUM'] ?>" > <?php  echo  $table['PRA_NOM']." ".$table['PRA_PRENOM'] ?></option>;
					
					
				<?php  } ?></select>
			<label class="titre">COEFFICIENT :</label><input type="text" size="6" name="PRA_COEFF" class="zone" /> 
			<label class="titre">REMPLACANT :</label><input type="checkbox" class="zone" checked="false" onClick="selectionne(true,this.checked,'PRA_REMPLACANT');"/><select name="PRA_REMPLACANT" disabled="disabled" class="zone" ></select>
			<label class="titre">DATE :</label><input type="text" size="20" name="RAP_DATE" class="zone" />
			<label class="titre">MOTIF :</label><select  name="RAP_MOTIF" class="zone" onClick="selectionne('AUT',this.value,'RAP_MOTIFAUTRE');">
											<option value="PRD">Périodicité</option>
											<option value="ACT">Actualisation</option>
											<option value="REL">Relance</option>
											<option value="SOL">Sollicitation praticien</option>
											<option value="AUT">Autre</option>
										</select><input type="text" name="RAP_MOTIFAUTRE" class="zone" disabled="disabled" />
			<label class="titre">BILAN :</label><textarea rows="5" cols="50" name="RAP_BILAN" class="zone" ></textarea> 
			<label class="titre" ><h3> Eléments présentés </h3></label>
			<label class="titre" >PRODUIT 1 : </label><select name="PROD1" class="zone"><option>Choisissez un medicament</option>
			<?php foreach ($medicament as $tableM) {
					echo "<option value ='".$tableM['MED_DEPOTLEGAL']."'>".$tableM['MED_NOMCOMMERCIAL']."</option>";
					
					
				 } ?></select>
			<label class="titre" >PRODUIT 2 : </label><select name="PROD2" class="zone"><option>Choisissez un medicament</option>
			<?php foreach ($medicament as $tableM) {
					echo "<option value ='".$tableM['MED_DEPOTLEGAL']."'>".$tableM['MED_NOMCOMMERCIAL']."</option>";
					
					
				 } ?></select>
			<label class="titre">DOCUMENTATION OFFERTE :</label><input name="RAP_DOC" type="checkbox" class="zone" checked="false" />
			<label class="titre"><h3>Echanitllons</h3></label>
			<div class="titre" id="lignes">
				<label class="titre" >Produit : </label>
				<select name="PRA_ECH1" class="zone"><option>Produits</option>
			<?php foreach ($medicament as $tableM) {
					echo "<option value ='".$tableM['MED_DEPOTLEGAL']."'>".$tableM['MED_NOMCOMMERCIAL']."</option>";
					
					
				 } ?></select><input type="text" name="PRA_QTE1" size="2" class="zone"/>
				<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />			
			</div>		
			<label class="titre">SAISIE DEFINITIVE :</label><input name="RAP_LOCK" type="checkbox" class="zone" checked="false" />
			
			<label class="titre"></label><div class="zone"><input type="reset" value="Annuler"></input><input type="submit"></input>
			
		</form>
	</div>
</div>
</body>
</html>