<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">

<!-- Your html code goes here -->
 <?php print_r($_SESSION) ?>

</div>

<?php $this->component("footer") ?>