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

<div name="droite" style="float:left;width:70%;height:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
   <br>
		<?php foreach($info as $unInfo){ ?>

            

            <form name="formListeRecherche" method="post" action="enSavoirPlus">
            <input type="hidden" name="RAP_NUM" value="<?php echo  $unInfo['RAP_NUM']; ?>" />
                 N° <?php echo $unInfo['RAP_NUM']?> "Date saisie : <?php echo$unInfo['RAP_DATE']?>   <input type="submit" value="En savoir plus" />
            </form>
     <?php  }?>
	
    
	</div>
</div>
</body>
</html>