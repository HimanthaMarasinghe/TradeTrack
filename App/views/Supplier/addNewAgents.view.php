<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">

<!-- Your html code goes here -->
 <form action="http://localhost/TradeTrack/FormTest" method="POST">
    <input class="userInput" type="text" name="a" id="">
    <input type="text" name="b" id="">
    <input type="text" name="c" id="">
    <input type="text" name="d" id="">
    <input type="text" name="e" id="">
    <input type="text" name="f" id="">
    <input type="submit" name="g" id="">
 </form>

</div>

<?php $this->component("footer") ?>