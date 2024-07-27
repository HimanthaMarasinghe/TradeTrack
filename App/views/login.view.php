<form method="post">

    <?php
    if(!empty($errors)) 
        echo implode('<br>', $errors);
    ?>

    <label for="name">Name</label>
    <input name="name" type="text">
    <input type="submit">
</form>