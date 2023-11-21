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
<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
		<form name="formRAPPORT_VISITE" method="post" action="ModifierRapport" >
			<h1> Rapport de visite </h1>
			<label class="titre">NUMERO :</label><input type="text" size="10" name="RAP_NUM" class="zone" disabled="disabled" value="<?php echo $info['RAP_NUM'] ?>"/>
			<label class="titre">DATE VISITE :</label> <input type="text" size="10" name="RAP_DATEVISITE" class="zone" value="<?php echo $info['RAP_DATEVISITE'] ?>"/>
			<br><label class="titre">PRATICIEN :</label><select  name="PRA_NUM" class="zone" ><option>Choisissez un praticien</option>
			<?php foreach ($praticien as $table) {?>
					 <option value ="<?php  echo $table['PRA_NUM'] ;?>"  <?php if($info['PRA_NUM']== $table['PRA_NUM']){ echo "selected";}?>> <?php  echo  $table['PRA_NOM']." ".$table['PRA_PRENOM']; ?></option>
					
					
				<?php  } ?></select>
			<br><label class="titre">COEFFICIENT :</label> <input type="text" size="10" name="PRA_COEFF" class="zone" value="<?php echo $info['PRA_COEFF'] ?>"/>
			<br><label class="titre">REMPLACANT :</label>
			<br><label class="titre">DATE :</label> <input type="text" size="10" name="RAP_DATE" class="zone" value="<?php echo $info['RAP_DATE'] ?>"/>
			<br><label class="titre">MOTIF :</label><select  name="RAP_MOTIF" class="zone" onClick="selectionne('AUT',this.value,'RAP_MOTIFAUTRE');">
											<option value="PRD" <?php if($info['RAP_MOTIF']== "PRD"){ echo "selected";}?>>Périodicité</option>
											<option value="ACT" <?php if($info['RAP_MOTIF']== "ACT"){ echo "selected";}?>>Actualisation</option>
											<option value="REL" <?php if($info['RAP_MOTIF']== "REL"){ echo "selected";}?>>Relance</option>
											<option value="SOL" <?php if($info['RAP_MOTIF']== "SOL"){ echo "selected";}?>>Sollicitation praticien</option>
											<option value="AUT" <?php if($info['RAP_MOTIF']== "AUT"){ echo "selected";}?>>Autre</option>						
			</select>
			<br><br><label class="titre">BILAN :</label><textarea rows="5" cols="50" name="RAP_BILAN" class="zone"><?php echo  $info['RAP_BILAN']?></textarea> 
			<br><label class="titre" ><h3> Eléments présentés </h3></label>
		
			<br><label class="titre" >PRODUIT 1 : </label><select name="PROD1" class="zone"><option>Choisissez un medicament</option>
			<?php foreach ($medicament as $tableM) {?>
					<option value ="<?php echo $tableM['MED_DEPOTLEGAL']?>" <?php if($info['PROD1'] == $tableM['MED_DEPOTLEGAL']){ echo "selected";}?>> <?php echo  $tableM['MED_NOMCOMMERCIAL']?></option>
					
					
				<?php } ?></select>

				<br><label class="titre" >PRODUIT 2 : </label><select name="PROD2" class="zone"><option>Choisissez un medicament</option>
			<?php foreach ($medicament as $tableM) {?>
					<option value ="<?php echo $tableM['MED_DEPOTLEGAL']?>" <?php if($info['PROD2'] == $tableM['MED_DEPOTLEGAL']){ echo "selected";}?>> <?php echo $tableM['MED_NOMCOMMERCIAL']?></option>
					
					
				<?php } ?></select>

			<br><label class="titre">DOCUMENTATION OFFERTE :</label><input name="RAP_DOC" type="checkbox" class="zone"  checked="<?php echo $info['RAP_DOC'] ?>" /> 
			<br><label class="titre"><h3>Echanitllons</h3></label>
			
            <?php foreach($echantillion as $ech) {?>
                <div class="titre" id="lignes">

				<label class="titre" >Produit : </label>
				<select name="PRA_ECH<?php echo $ech['PROD_N'] ?>" class="zone"><option>Produits</option>
			<?php foreach ($medicament as $tableM) {?>
					<option value ="<?php echo $tableM['MED_DEPOTLEGAL']?>"<?php if($ech['PROD'] == $tableM['MED_DEPOTLEGAL']){ echo "selected";}?>> <?php echo $tableM['MED_NOMCOMMERCIAL'] ?></option>;
					
					
			<?php } ?></select>
			
			</div><input type="text" name="PRA_QTE1" size="2" class="zone"/><?php }?>
				<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />	
			
			<br><label class="titre">SAISIE DEFINITIVE :</label><input name="RAP_LOCK" type="checkbox" class="zone" <?php if($info['RAP_LOCK']  == 1){echo "disabled"; }?> checked="<?php echo $info['RAP_LOCK'] ?>" /> 
			<?php if($info['RAP_LOCK']  == 0){
			echo '<label class="titre"></label><div class="zone"><input type="reset" value="Annuler"></input><input type="submit"></input>';
			}?>


            
            
			
		</form>
	</div>
</div>