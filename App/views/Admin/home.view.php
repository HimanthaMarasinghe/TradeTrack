<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">
    


    <div>
        <h1  class="admin-panel">Admin</h1>
        <a class="remove-user-btn"  href="<?=LINKROOT?>/Admin/removeUser">
            <h4>Remove User</h4>
        </a>
    </div>
    <div>
        <a class="remove-user-btn"  href="<?=LINKROOT?>/Admin/addNewProducts">
            <h4>Add new product</h4>
        </a>
    </div>

</div>


<?php $this->component("footer") ?>