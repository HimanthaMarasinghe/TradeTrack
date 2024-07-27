<div class="sidebar">
    <ul>
        <?php foreach($tabs as $tab) { ?>
        <li>
            <a href="#">
                <img src="<?=ROOT?>/images/icons/<?=$tab?>.svg" alt="">
                <span><?=$tab?></span>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>