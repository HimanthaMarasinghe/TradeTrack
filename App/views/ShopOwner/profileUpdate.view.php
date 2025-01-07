<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">

<h2>Shop Owner Profile </h2>
<!-- Your html code goes here -->
 <form action="<?=LINKROOT?>/ShopOwner/profileUpdate" method="POST">
    

    <table class="ProfileUpd">
            <tr>
                <td>Shop owner's Phone Number</td>
                <td><input class="userInput" type="text" name="so_phone" id="" value="<?=$_SESSION['shop_owner']['phone']?>"></td>
            </tr>
            <tr>
                <td>Shop Name</td>
                <td><input class="userInput" type="text" name="shop_name" id="" value="<?=$_SESSION['shop_owner']['shop_name']?>"></td>
            </tr>
            <tr>
                <td>Shop owner's  First Name</td>
                <td><input class="userInput" type="text" name="so_first_name" id="" value="<?=$_SESSION['shop_owner']['first_name']?>"></td>
            </tr>
            <tr>
                <td>Shop owner's  last name</td>
                <td><input class="userInput" type="text" name="so_last_name" id="" value="<?=$_SESSION['shop_owner']['last_name']?>"></td>
            </tr>
            <tr>
                <td>shop address </td>
                <td><input class="userInput" type="text" name="shop_address" id="" value="<?=$_SESSION['shop_owner']['shop_address']?>"></td>
            </tr>
            <tr>
                <td>shop owner address </td>
                <td><input class="userInput" type="text" name="so_address" id="" value="<?=$_SESSION['shop_owner']['address']?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <input type="submit" class="btn" value="Update">
                </td>
            </tr>
        </table>


 </form>

</div>

<?php $this->component("footer") ?>