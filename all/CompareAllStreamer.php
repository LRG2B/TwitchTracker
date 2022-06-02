<?php

/*try {
    $host = 'localhost'; /// Adresse de la base de données
     $name = 'basetwitch'; // Nom de la base de données à utiliser
     $user = 'root'; // Utilisateur de la base de données
     $pass = ''; // Mot de passe de la base de données
     $dbh = new PDO("mysql:host=$host;dbname=$name", $user,$pass);
    }

    catch (PDOException $e) { // En cas d'erreur récupération
        print "Erreur !: " . $e->getMessage() . "<br!/"; //Définition du message d'erreur
        die(); // Arrêt du script
       }*/
       require_once "db.php";

       $id = $_GET["id"];


   //RANK
   $queryRank = $dbh->prepare('SELECT `name`,`rank` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%"  AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`rank` ASC');

   //Rajout
   $queryRank->bindValue(":id", $id,PDO::PARAM_INT);

   $queryRank->execute();
   $tabstreamersRank = $queryRank->fetchAll();
   //$tabstreamersRank = $queryRank->fetchAll();

   //Followers
   $queryFollowers = $dbh->prepare('SELECT `name`,`followers` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%"  AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`followers` DESC');
   $queryFollowers->bindValue(":id", $id,PDO::PARAM_INT);
   $queryFollowers->execute();
   $tabstreamersFollowers = $queryFollowers->fetchAll();

   //Followers Max
   $queryFollowersMax = $dbh->prepare('SELECT `name`,`followers_total` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%"  AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`followers_total` DESC');
   $queryFollowersMax->bindValue(":id", $id,PDO::PARAM_INT);
   $queryFollowersMax->execute();
   $tabstreamersFollowersMax = $queryFollowersMax->fetchAll();
   
   //Avg_viewers
   $queryAVGViewers = $dbh->prepare('SELECT `name`,`avg_viewers` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%" AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`avg_viewers` DESC');
   $queryAVGViewers->bindValue(":id", $id,PDO::PARAM_INT);
   $queryAVGViewers->execute();
   $tabstreamersAVGViewers = $queryAVGViewers->fetchAll();

   //Max_viewers
   $queryMaxViewers = $dbh->prepare('SELECT `name`,`max_viewers` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%" AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`max_viewers` DESC');
   $queryMaxViewers->bindValue(":id", $id,PDO::PARAM_INT);
   $queryMaxViewers->execute();
   $tabstreamersMaxV = $queryMaxViewers->fetchAll();

   //Hours_watched
   $queryHoursW = $dbh->prepare('SELECT `name`,`hours_watched` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%" AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`hours_watched` DESC');
   $queryHoursW->bindValue(":id", $id,PDO::PARAM_INT);
   $queryHoursW->execute();
   $tabstreamersHoursW = $queryHoursW->fetchAll();

   //Views
   $queryViews = $dbh->prepare('SELECT `name`,`views` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%" AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`views` DESC');
   $queryViews->bindValue(":id", $id,PDO::PARAM_INT);
   $queryViews->execute();
   $tabsViews = $queryViews->fetchAll();

   //ViewsTotal
   $queryViewsTotal = $dbh->prepare('SELECT `name`,`views_total` FROM `streamers`
   INNER JOIN `streamers-stats` ON `streamers`.id = `streamers-stats`.streamer
   WHERE date LIKE "%2022-05%" AND `streamers`.id != :id
   ORDER BY `streamers-stats`.`views_total` DESC');
   $queryViewsTotal->bindValue(":id", $id,PDO::PARAM_INT);
   $queryViewsTotal->execute();
   $tabsViewsTotal = $queryViewsTotal->fetchAll();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; 
        charset=utf-8" />
        <title> Comparaison entre tous les streamers </title>
        <link rel="stylesheet" type="text/css" href="css/LeCssDuProjetWeb.css"/>
    </head>

    <body>
        <h1 id ="names"> Comparaison des streamers sur le mois de Mai </h1>
        <h3> <a href = "MasquerStreamer.php">Retourner selection masquage </a> </h3>
        <h2> Le classement des Rank :  </h2>
        <table>
        <?php foreach ($tabstreamersRank as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td> 
                <td><?= $streamersRecup['rank'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des followers :</h2>
        <?php foreach ($tabstreamersFollowers as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['followers'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des followers au total :</h2>
        <?php foreach ($tabstreamersFollowersMax as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['followers_total'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des viewers en moyenne :</h2>
        <?php foreach ($tabstreamersAVGViewers as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['avg_viewers'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des viewers maximum :</h2>
        <?php foreach ($tabstreamersMaxV as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['max_viewers'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des heures streamés :</h2>
        <?php foreach ($tabstreamersHoursW as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['hours_watched'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des vues :</h2>
        <?php foreach ($tabsViews as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['views'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>

        <table>
        <h2>Le classement des vues au total :</h2>
        <?php foreach ($tabsViewsTotal as $streamersRecup) : ?> 
                <tr> 
                <td><?= $streamersRecup['name'] ?> </td>  
                <td><?= $streamersRecup['views_total'] ?> </td> 
                </tr>
        <?php endforeach; ?> 
        </table>
    </body>
</html>