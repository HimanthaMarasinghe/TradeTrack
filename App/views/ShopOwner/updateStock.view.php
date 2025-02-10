<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$customer['cus_first_name']." ".$customer['cus_last_name']?></h2>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row spc-btwn">
        <form action="http://localhost/TradeTrack/FormTest" method="POST">


        <table class="profile w-100">
            <tr>
                <td>Phone number</td>
                <td><input class="userInput" type="text" name="a" id=""></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><input type="text" name="b" id=""></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><input type="text" name="c" id=""></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><input type="text" name="d" id=""></td>
            </tr>

            <tr>
                <td colspan="2">
                        <input type="submit">
                </td>
            </tr>
            </table>
        </form>
    </div>
</div>

<?php $this->component("footer") ?>