<?php

require_once "db.php";

//Pour le JSON - toujours
//header('Content-Type: application/json');


//On récupère l'ID
$id = $_GET["id"];

//On va chercher l'article dans la base
$sql = 'SELECT * FROM `streamers-stats` WHERE `date` LIKE "%2022-05%" AND `streamer` = :id';
//Pour récupérer son prénom dans la base
$sql2 = 'SELECT * FROM `streamers` WHERE `id` = :id';
//Pour récupérer ses infos sur les plusieurs mois pour voir évolution !
//Ceci n'est qu'un test pour rank !
$sql3 = 'SELECT * FROM `streamers-stats` WHERE `streamer` = :id ORDER BY `streamers-stats`.`date`  ASC';


//On prépare la requete
$query2 = $dbh->prepare($sql);
$query = $dbh->prepare($sql2);

$queryRank = $dbh->prepare($sql3);

//On injecte les paramêtres
$query2->bindValue(":id", $id, PDO::PARAM_INT);
$query->bindValue(":id", $id, PDO::PARAM_INT);
$queryRank->bindValue(":id", $id, PDO::PARAM_INT);

//On exécture la requete
$query2->execute();
$query->execute();
$queryRank->execute();

//On récupère la donnée
$streamersRecup = $query2->fetch();
$streamerRecup = $query->fetch();

//Pour
$recupGraph = $queryRank->fetchAll();

//print_r($recupRank);

//Si la donnée est vide
if(!$streamersRecup)
{
    http_response_code(404);
    echo "La donnée est inexistante ou non accessible";
    exit;
}

if(!$streamerRecup)
{
    http_response_code(404);
    echo "La donnée est inexistante ou non accessible";
    exit;
}

$titre = strip_tags(($streamerRecup["name"]));

//Pour le graphique

?>

<!DOCTYPE HTML>
<html>
    <head>
        <!-- Pour le JSON-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"> </script>

        <meta http-equiv="content-type" content="text/html; 
        charset=utf-8" />
        <title> Streamer sélectionné : </title>
        <link rel="stylesheet" type="text/css" href="css/LeCssDuProjetWeb.css"/>
    </head>

    <body>
        <h1 id ="names"> <?=$titre ?> </h1>
        <article id="affichagestats">
        <table>               
                <tr>           
                    ID de la sauvegarde :
                    <?= $streamersRecup['id'] ?> 
                </tr>
                <tr> <td> Date : 
                    <?= $streamersRecup['date'] ?>   
                </tr> </td>
                <tr> <td>Minutes stremed :
                    <?= $streamersRecup['minutes_streamed'] ?>   
                </tr> </td>
                <tr> <td> Rank : 
                    <?= $streamersRecup['rank'] ?>
                </tr> </td> 
                <tr> <td> Average viewers : 
                    <?= $streamersRecup['avg_viewers'] ?>
                </tr> </td>  
                <tr> <td> Max viewers : 
                    <?= $streamersRecup['max_viewers'] ?>
                </tr> </td>  
                <tr> <td> Hours watched  : 
                    <?= $streamersRecup['hours_watched'] ?>
                </tr> </td>  
                <tr> <td> Followers  : 
                    <?= $streamersRecup['followers'] ?>
                </tr> </td>   
                <tr> <td> Followers total  : 
                    <?= $streamersRecup['followers_total'] ?>
                </tr> </td>  
                <tr> <td> Views  : 
                    <?= $streamersRecup['views'] ?>
                </tr> </td> 
                <tr> <td> Views total  : 
                    <?= $streamersRecup['views_total'] ?>
                </tr> </td>  
                <tr> <td> Id du streamer  : 
                    <?= $streamersRecup['streamer'] ?>
                </tr> </td>    
                <td>
                    <a href="All.php"> Retour à la liste  </a>
                </td>
        </table>
        </article>
        <table id="test">

        <div    style="height:60vh; width: 100vh;">
            <canvas id="graph", style=" height:40vh; width:80vm"></canvas>
        </div>

        <!-- Views -->

        <script>   
            const labels = [ "Mars","Avril","Mai", ];

            const data = {
                labels : labels,
            datasets: [{
                label : 'Viewers en moyennes au fil des mois',
                data : [
                    <?php if(array_key_exists('0',$recupGraph)) {echo $recupGraph[0]['avg_viewers']; } else { echo null;} ?>,
                    <?php if(array_key_exists('1',$recupGraph)) {echo $recupGraph[1]['avg_viewers']; } else { echo null;} ?>,
                    <?php if(array_key_exists('2',$recupGraph)) {echo $recupGraph[2]['avg_viewers']; } else { echo null;} ?>
                    ],
                    borderColor : ['red'],
                    
                },
                {
                    label : 'Viewers total au maximum des mois',
                    data : [
                        <?php if(array_key_exists('0',$recupGraph)) {echo $recupGraph[0]['max_viewers']; } else { echo null;} ?>,
                        <?php if(array_key_exists('1',$recupGraph)) {echo $recupGraph[1]['max_viewers']; } else { echo null;} ?>,
                        <?php if(array_key_exists('2',$recupGraph)) {echo $recupGraph[2]['max_viewers']; } else { echo null;} ?>
                    ],
                    borderColor : ['blue'],
                },      
            ]};
            const config = {
                type: 'line',
                data,
                options : {
                    title : {
                            display : true,
                            text : "Ne fonctionne pas",
                    }
                },
            };
        </script>

            <script>
                const myChart = new Chart(document.getElementById('graph').getContext('2d'), config);
            </script>

    </body>
</html>