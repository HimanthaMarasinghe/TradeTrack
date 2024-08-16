<div class="sidebar">
    <img class="app-logo" src="<?=ROOT?>/images/Logo/Logo.png" alt="">
    <ul>
        <?php foreach($tabs as $tab) { ?>
        <li>
            <a href="<?=LINKROOT?>/<?=$userType?>/<?= str_replace(' ', '', $tab)?>" class ="<?php if($active == $tab) echo "active"; ?>">
                <svg>
                    <use href="<?=ROOT?>/images/icons/icons.svg#<?= str_replace(' ', '', $tab)?>"></use>
                </svg>
                <span><?=$tab?></span>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>