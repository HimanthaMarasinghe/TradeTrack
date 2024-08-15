<div class="sidebar">
    <ul>
        <?php foreach($tabs as $tab) { ?>
        <li>
            <a href="http://localhost/TradeTrack/<?=$userType?>/<?= str_replace(' ', '', $tab)?>" class ="<?php if($active == $tab) echo "active"; ?>">
                <img src="<?=ROOT?>/images/icons/<?=$tab?>.svg" alt="">
                <span><?=$tab?></span>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>