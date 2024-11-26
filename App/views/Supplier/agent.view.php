<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Sales Agent</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Sale Agen Name</td>
                <td><?=$agent['first_name']?> <?=$agent['last_name']?></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><?=$agent['sa_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$agent['address']?></td>
            </tr>
            <tr>
                <td>Busines Name</td>
                <td><?=$agent['sa_busines_name']?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a class="btn" href="<?=LINKROOT?>/Supplier/updateAgent/<?=$agent['sa_phone']?>">Update</a>
                    <button onclick="deleteSalesAgent('<?=$agent['sa_phone']?>')" class="btn">Delete</button>
                </td>
            </tr>
        </table>
        <?php if(file_exists("./images/Profile/SA/".$agent['sa_phone'].".".$agent['sa_pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Profile/SA/<?=$agent['sa_phone']?>.<?=$agent['sa_pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big"  src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
        <?php } ?>
    </div>
</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    function deleteSalesAgent(sa_phone){
        fetch(LINKROOT+'/Supplier/deleteAgent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'sa_phone=' + encodeURIComponent(sa_phone)
        })
        .then(
            location.reload()
        )
        .catch(error => console.error('Error:', error));
        }
</script>

<?php $this->component("footer") ?>