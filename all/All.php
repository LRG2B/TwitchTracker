<?php


require_once "db.php";

   $query = $dbh->prepare('SELECT * FROM `streamers`'); // $dbh est la connexion initialisée dans le fichier db.php
   $query->execute();
   $tabstreamer = $query->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE HTML>
<html>
    <head>
        <title> Petit Twitch Tracker </title>
        <meta http-equiv="content-type" content="text/html; 
        charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/LeCssDuProjetWeb.css"/>
    </head>

    <body>
        <table>
                <h1 id="title"> Petit Twitch Tracker </h1>
                <article id="affichagenoms">
                    <?php foreach ($tabstreamer as $streamersId => $streamerRecup) : ?> 
                      
                        <!-- Affichage du nom --> 
                        <div class="noms">  
                            <a id = "liens" href="streamer.php?id=<?= $streamerRecup['id']; ?>">           
                        
                        <?= $streamerRecup['name'] ?>
                        <br/>
                        <img id="image" src="css/<?= $streamerRecup['id']; ?>.jpg">
                        </div>
                    
                    <?php endforeach; ?> 
                    </article>

        </table>
        <h3> <a href= "MasquerStreamer.php"> Menu choix masquage streamer </h3>

    </body>
</html>