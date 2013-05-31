<?php


//Cet encadré sera à effacer une fois la liaison définitive établie--------

mysql_connect("127.0.0.1", "gsb_user", "ini01");
mysql_select_db("test");

//-------------------------------------------------------------------------

	


	//On gère le nombre max de médicaments
	$sqlMax="SELECT count(*) nombre FROM MEDICAMENT";
	$resMax=mysql_query($sqlMax);
	$linMax=mysql_fetch_array($resMax);
	$nbMax=$linMax['nombre']-1;

		//------------------------------------//
		//	Bouton Précedent	      //
		//------------------------------------//

	//Si le bouton Précédent est utilisé
	if (ISSET($_POST['precedent']))
	{
	$num=$_POST['num'];
	//Si c'est pas le premier
		if(!$num==0)
		{
		$num=$num-1;
		}
		else //Sinon on l'envoie au dernier
		{
		$num=$nbMax;
		}
	}
	else
	{

		//------------------------------------//
		//		Bouton Suivant	      //
		//------------------------------------//

		//Si le bouton Précédent est utilisé
	if (ISSET($_POST['suivant']))	
	{
		$num=$_POST['num'];
		//Si le nombre n'est pas le dernier
		if ($num!=$nbMax)
		{
		$num=$num+1;	
		}
		else //Sinon on l'envoie au premier
		{
		$num=0;
		}
	}
	else
	{
		if (!(ISSET($_POST['suivant'])) && (!(ISSET($_POST['precedent'])))) $num=0; 
		}
	}


	//-----------------------------------------------//
	//		Affichage des Medicaments	 //
	//---------------------------------------------- //

	//Script d'affichage des données des médicaments
	$sqlMedicament="SELECT MED_DEPOTLEGAL, MED_NOMCOMMERCIAL, MED_COMPOSITION, FAM_CODE, MED_EFFETS, MED_CONTREINDIC, MED_PRIXECHANTILLON FROM MEDICAMENT LIMIT $num,1";
	$resMedicament=mysql_query($sqlMedicament);

	//On récupère toutes les données qu'on stock dans des variables
	while($ligne=mysql_fetch_array($resMedicament))
	{
		$depotlegal=$ligne['MED_DEPOTLEGAL'];
		$nomcommercial=$ligne['MED_NOMCOMMERCIAL'];
		$famcode=$ligne['FAM_CODE'];
		$composition=$ligne['MED_COMPOSITION'];
		$effet=$ligne['MED_EFFETS'];
		$contreindic=$ligne['MED_CONTREINDIC'];
		$prixechantillon=$ligne['MED_PRIXECHANTILLON'];
	}





?>
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
<div name="haut" style="margin: 2 2 2 2 ;height:6%;"><h1><img src="logo.jpg" width="100" height="60"/>Gestion des visites</h1></div>
<div name="gauche" style="float:left;width:18%; background-color:white; height:100%;">
	<h2>Outils</h2>
	<ul><li>Comptes-Rendus</li>
		<ul>
			<li><a href="formRAPPORT_VISITE.htm" >Nouveaux</a></li>
			<li>Consulter</li>
		</ul>
		<li>Consulter</li>
		<ul><li><a href="formMEDICAMENT.htm" >Médicaments</a></li>
			<li><a href="formPRATICIEN.htm" >Praticiens</a></li>
			<li><a href="formVISITEUR.htm" >Autres visiteurs</a></li>
		</ul>
	</ul>
</div>
<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
	<form name="formMEDICAMENT" method="post" action="formMEDICAMENT.php">
		<h1> Pharmacopee </h1>
		<input type="hidden" name="num" value="<?=$num?>" />
		<label class="titre">DEPOT LEGAL :</label><input type="text" size="10" name="MED_DEPOTLEGAL" class="zone" value="<?=$depotlegal?>"/>
		<label class="titre">NOM COMMERCIAL :</label><input type="text" size="25" name="MED_NOMCOMMERCIAL" class="zone" value="<?=$nomcommercial?>" />
		<label class="titre">FAMILLE :</label><input type="text" size="5" name="FAM_CODE" class="zone" value="<?=$famcode?>" />
		<label class="titre">COMPOSITION :</label><textarea rows="5" cols="50" name="MED_COMPOSITION" class="zone" ><?=$composition?></textarea>
		<label class="titre">EFFETS :</label><textarea rows="5" cols="50" name="MED_EFFETS" class="zone"><?=$effet?></textarea>
		<label class="titre">CONTRE INDIC. :</label><textarea rows="5" cols="50" name="MED_CONTREINDIC" class="zone"><?=$contreindic?></textarea>
		<label class="titre">PRIX ECHANTILLON :</label><input type="text" size="7" name="MED_PRIXECHANTILLON" class="zone" value="<?=$prixechantillon?>" />
		<label class="titre">&nbsp;</label><input class="zone" type="submit" name="precedent" value="<" /><input class="zone" type="submit" name="suivant" value=">" />
	</form>
	</div>
</div>
</body>
</html>
