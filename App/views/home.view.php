<?php $this->component('header') ?>

<?php $this->component('sidebar', $tabs) ?>
<div class="main-content">
    <!-- <h1>You are at home</h1> -->

    <!-- <div style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);transition: 0.3s; width: 40%;">
        <h2><?= $id; ?></h2>
        <h2><?= $name; ?></h2>
        <h2><?= $date; ?></h2> -->

        <?php
        foreach($users as $user) {
            $this->component('card', $user); 
        }
        ?>
</div>

<?php $this->component('footer') ?>