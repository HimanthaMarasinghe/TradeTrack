<div class="card center-al">
    <?php if (isset($image)): ?>
        <img src="<?php echo $image; ?>" alt="Card image" class="card-img-top">
    <?php endif; ?>
    <div class="card-body">
        <h5 class="card-title"><?php echo $name; ?></h5>
        <p class="card-text"><?php echo $age; ?></p>
    </div>
</div>
