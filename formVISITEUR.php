<?php
//----------------------------------------------------------------------------------------------//
//		Cette page permet de consulter les visiteur par d�partement			//	
//----------------------------------------------------------------------------------------------//

//-------------------------A VIRE POUR LA VERSION FINALE----------------------------//
//Connexion � la BDD

mysql_connect("127.0.0.1","gsb_user","ini01");
mysql_select_db("test");
//----------------------------------------------------------------------------------//

?>
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
<div name="haut" style="margin: 2 2 2 2 ;height:6%;"><h1><img src="logo.jpg" width="100" height="60"/>Gestion des visites</h1></div>
<div name="gauche" style="float:left;width:18%; background-color:white; height:100%;">
	<h2>Outils</h2>
	<ul><li>Comptes-Rendus</li>
		<ul>
			<li><a href="formRAPPORT_VISITE.php" >Nouveaux</a></li>
			<li>Consulter</li>
		</ul>
		<li>Consulter</li>
		<ul><li><a href="formMEDICAMENT.php" >M�dicaments</a></li>
			<li><a href="formPRATICIEN.php" >Praticiens</a></li>
			<li><a href="formVISITEUR.php" >Autres visiteurs</a></li>
		</ul>
	</ul>
</div>
<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;background-color:77AADD;color:white;height:88%;">
	<form name="formVISITEUR" method="post" action=>
		<h1> Visiteurs </h1>
		<form "Fdpt" method="post" action="formVISITEUR.php" >

		<select name="lstDept" class="titre">
<?php
//-------RECUPERATION DES DEPARTEMENT POUR LA LISTE DEROULANTE----------//
$sqlDpt="SELECT DEP_CODE, DEP_NOM FROM DEPARTEMENT";
$resDpt=mysql_query($sqlDpt);

//On r�cup�re le reusltat de la requ�te dans un tableau
while($ligneDpt=mysql_fetch_array($resDpt))
{
$idDpt=$ligneDpt['DEP_CODE'];
$nomDpt=$ligneDpt['DEP_NOM'];
if(ISSET($_POST['lstDept']) && $_POST['lstDept']=="$idDpt")
{
$idDepart=$_POST['lstDept'];
?>
<option value="<?=$idDepart?>" selected><?=$nomDpt?></option>
<?
}
else
{
?>
<option value="<?=$idDpt?>"><?=$nomDpt?></option>
<?
}
}
?>

		</select>
		<input type="submit" name="action" value="Choisir" />
		</form>


<?php
		if(ISSET($_POST['action'])=="Choisir")
		{ 
		$dptChoisi=$_POST['lstDept'];
		//On s�l�ctionne les Visiteur selon leur d�partement
		$sqlVis="SELECT * FROM VISITEUR WHERE DEP_CODE='$dptChoisi'";
		$resVis=mysql_query($sqlVis);
?>
<select name="lstVisiteur" class="zone">
<?php		
		//On l'affiche dans la liste
		while($ligneVis=mysql_fetch_array($resVis))
		{
		$visiteurNum=$ligneVis['VIS_MATRICULE'];
		$visiteurNom=$ligneVis['VIS_NOM'];
		$visiteurPrenom=$ligneVis['Vis_PRENOM'];
?>
<br />
		<option value="<?=$visiteurNum?>"><?=$visiteurNom?> <?=$visiteurPrenom?></option>
</select>
<?php
		}
		
?>
		<label class="titre">NOM :</label><input type="text" size="25" name="VIS_NOM" class="zone" value="<?=$visiteurNomFV?>"/>
		<label class="titre">PRENOM :</label><input type="text" size="50" name="Vis_PRENOM" class="zone" />
		<label class="titre">ADRESSE :</label><input type="text" size="50" name="VIS_ADRESSE" class="zone" value="<?=$visiteurAdresse?>"/>
		<label class="titre">CP :</label><input type="text" size="5" name="VIS_CP" class="zone" />
		<label class="titre">VILLE :</label><input type="text" size="30" name="VIS_VILLE" class="zone" />
		<label class="titre">SECTEUR :</label><input type="text" size="1" name="SEC_CODE" class="zone" />
		<label class="titre">&nbsp;</label><input class="zone"type="button" value="<"></input><input class="zone"type="button" value=">"></input>
	
	<?php
	}
		
?>
</form>
	
	</div>
</div>
</body>
</html>
