<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css.css">
		<title>Explorateur de fichiers</title>

	</head>
<body>

<?php
$nb_fichier = 0;
$dossierDemander;
$arborescence;

if (isset($_GET['arborescence']) && $_GET['arborescence'] != '/personnel'){
    
    $arborescence = $_GET['arborescence'];
    $monchemin = "../".$arborescence;

    if ($arborescence != ""){

        
        $retour = strrpos($arborescence, "/"); 

        $retour = substr($arborescence, 0, $retour); 
        
        echo '<p><a href="?arborescence='.$retour.'"><i class="fas fa-arrow-left fa-2x"></i></a></p>';
       
        echo '<div class="arborescence">Arborescence = ' . $arborescence .'</div>';
    }
}

else {
    $arborescence = "/Personnel";
    $monchemin = "../Personnel";
    echo '<p><a href="./"><i class="fas fa-arrow-left fa-2x"></i></a></p>';

}

?>

<div class="listederoulante">
<?php
if ($dossier = opendir($monchemin)) {
    while (false !== ($fichier = readdir($dossier))) {
        if ($fichier != '.' && $fichier != '..' && $fichier != 'explorateurdefichiers.php' && $fichier != '.git' && $fichier != 'css.css')
        {
            if (is_dir($monchemin."/".$fichier) || $fichier == 'explorateurdefichiers')
            {
                $nb_fichier++;
                echo '<li><a href="?arborescence=' .$arborescence. '/' .$fichier. '">' . $fichier . '</a></li>';
            }
            else 
            { 
                $nb_fichier++;
                echo '<li><a href=" ' .$arborescence.'/' .$fichier. '">' . $fichier . '</a></li>';
            }   
        } 
    } 

    echo '</ul><br />';
    echo 'Il y a <strong>' . $nb_fichier . '</strong> fichier(s) dans le dossier';

    closedir($dossier);
} 
else
{
    echo "Le dossier n' a pas pu être ouvert";
}
?>

</body>

	</html>