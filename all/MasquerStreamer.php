<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; 
        charset=utf-8" />
        <title> Choix masquer streamer : </title>
        <link rel="stylesheet" type="text/css" href="css/LeCssDuProjetWeb.css"/>
    </head>

    <body>
    
        <table>
            <h1 id ="names"> Voulez-vous masquer un streamer ? </h1>
            <h2 id="secondarytitle"> Si oui, choississez le streamer à masquer : </h2>
            <article id="affichagenoms">
                <tr><td><a href="CompareAllStreamer.php?id=<?= 1 ?>"> Antoine Daniel </td></tr>
                <tr> <td><a href="CompareAllStreamer.php?id=<?= 3 ?>"> Domingo </td> </tr>
                <tr> <td><a href="CompareAllStreamer.php?id=<?= 6 ?>"> Kameto </td> </tr>
                <tr> <td><a href="CompareAllStreamer.php?id=<?= 5 ?>"> Mynthos </td> </tr>
                <tr> <td><a href="CompareAllStreamer.php?id=<?= 4 ?>"> Ponce </td> </tr>
                <tr> <td><a href="CompareAllStreamer.php?id=<?= 2 ?>"> Zerator </td>  </tr>
            </article>
        </table>
    
        <table >
            <h2 id="retour"> Si non, allez
            <a href="CompareAllStreamer.php?id=<?= 0 ?>"> ICI </h2>
        </table>
        <h3> <a href="All.php"> Retour Menu "Tous les streamers" </h3>
    </body>
</html>
