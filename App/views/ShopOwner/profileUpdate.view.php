<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">

<h2>Shop Owner Profile </h2>
<!-- Your html code goes here -->
 <form action="http://localhost/TradeTrack/FormTest" method="POST">
    

    <table class="Profile">
            <tr>
                <td>Shop owner's Phone Number</td>
                <td><input class="userInput" type="text" name="shopownerPhoneNo" id=""></td>
            </tr>
            <tr>
                <td>Shop Name</td>
                <td><input class="userInput" type="text" name="shopName" id=""></td>
            </tr>
            <tr>
                <td>Shop owner's  First Name</td>
                <td><input class="userInput" type="text" name="shopownerFirstName" id=""></td>
            </tr>
            <tr>
                <td>Shop owner's  last name</td>
                <td><input class="userInput" type="text" name="shopownerLastName" id=""></td>
            </tr>
            <tr>
                <td>shop address </td>
                <td><input class="userInput" type="text" name="shopaddress" id=""></td>
            </tr>
            <tr>
                <td>shop owner address </td>
                <td><input class="userInput" type="text" name="Shopowneraddress" id=""></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <input type="submit" class="btn" value="Submit">
                </td>
            </tr>
        </table>


 </form>

</div>

<?php $this->component("footer") ?>