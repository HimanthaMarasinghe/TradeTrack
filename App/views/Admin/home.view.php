<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">
    

<!-- Your html code goes here -->
    <div>
        <h1  class="admin-panel">Admin</h1>
        <a class="remove-user-btn"  href="http://localhost/TradeTrack/Admin/removeUser">
            <h4>Remove User</h4>
        </a>
    </div>

</div>

<?php $this->component("footer") ?>