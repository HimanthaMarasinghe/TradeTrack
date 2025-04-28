<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <a href="<?=LINKROOT?>/Admin/manufacturers">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </a>
        <h2>Manufacturer details</h2>
        <div style="opacity: 0;">
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Company name</td>
                <td><?=$manufacturer['company_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$manufacturer['company_address']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$manufacturer['man_phone']?></td>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/Profile/<?=$manufacturer['man_phone']?>.<?=$manufacturer['pic_format']?>" 
        alt=""
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
    </div>
    <h3>Distributors</h3>
    <div class="grid g-resp-200 scroll-box">
    <?php
    // Get distributors for a manufacturer
    $distributor = new DistributorM();
        
        // Use manufacturer phone from the data passed from the controller
        if (isset($manufacturer['man_phone'])) {
           // $distributorForManufacturer = $distributor->searchDistributors(['%', null, $manufacturer['man_phone']]);
                   // Direct SQL query as a test
            $sql = "SELECT * FROM distributors WHERE man_phone = :man_phone";
            $distributorForManufacturer = $distributor->query($sql, ['man_phone' => $manufacturer['man_phone']]);
            
            if(!empty($distributorForManufacturer)){
                foreach($distributorForManufacturer as $disManu){
                    ?>
                    <a href="<?=ROOT?>/Admin/distributor/<?=$disManu['dis_phone']?>" class="card btn-card colomn aspect-ratio">
                        <img 
                            class="profile-img" 
                            src="<?=ROOT?>/images/Profile/<?=$disManu['dis_phone']?>.<?=$disManu['pic_format']?>" 
                            alt=""
                            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
                        <div class="details h-50 ovf-hdn">
                            <h4><?=$disManu['dis_busines_name']?></h4>
                            <h4><?=$disManu['dis_phone']?></h4>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo '<p>No distributors found for this manufacturer.</p>';
            }
        } else {
            echo '<p>Manufacturer information not available.</p>';
        }
    ?>
</div>
<?php $this->component("footer") ?>