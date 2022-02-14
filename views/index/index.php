
<?php
//We are in the view object. Let's append the message value

 ?>
 <!--Main container biginning-->
 <div class="container">
   <h2>Des services professionels dans votre pays / ville</h2>
   <?php
   $towns= array("Kinshasa", "Paris", "Lubumbashi", "Goma");
   $towns2= array("Douala", "Bukavu", "Ottawa", "Antananarive");
   Utils::showItemsAsCards($towns);
   Utils::showItemsAsCards($towns2);
   echo "<br/>"
   ?>

   <h2>Les services par catégorie</h2>
   <?php
   $services= array(
     "Cyber", "Papeterie", "Kilamutu", "Laury",
     "Pompes"
   );

   Utils::showItemsAsCards($services, true);
   ?>
   <div id="btn-devs" class="my-3 center">
     <button class="btn" type="button" name="button">Toutes les catégories</button>
     <button class="btn" type="button" name="button">Tous les services</button>
   </div>


 </div>
  <!--Main container ending-->
