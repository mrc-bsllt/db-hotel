<?php
  include __DIR__."/database.php";

  if(!empty($_GET["var"])) {
    if($_GET["var"] == "park") {

      $hotels = array_filter($hotels,
      function($value) {
        return $value["parking"];
      });

    } elseif ($_GET["var"] == "1" || $_GET["var"] == "2" || $_GET["var"] == "3" || $_GET["var"] == "4" || $_GET["var"] == "5") {

      $hotels = array_filter($hotels,
      function($value) {
        return $value["vote"] == $_GET["var"];
      });

    } elseif ($_GET["var"] == "dist") {
      $newElement = [$hotels[0]];

      for ($i=0; $i < count($hotels); $i++) {
        if($hotels[$i]["distance_to_center"] > $newElement["distance_to_center"]) {
          $newElement = [$hotels[$i]];
        }
      }
      $hotels = $newElement;
    }
  }
?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>php snack3</title>
   </head>
   <body>
     <?php foreach ($hotels as $hotel) { ?>
        <div class="hotel" style="border: 1px solid black; padding: 20px">
          <h2><?= $hotel["name"]; ?></h2>
          <p><?= $hotel["description"]; ?></p>
          <span><?php
          if($hotel["parking"]) {
            echo "Parcheggio disponibile!";
          } else {
            echo "Parcheggio non disponibile!";
          }
           ?></span>
           <p>Voto: <?= $hotel["vote"]; ?></p>
           <p>Distanza dal centro: <?= $hotel["distance_to_center"]; ?> km</p>
        </div>
     <?php } ?>


   </body>
 </html>
