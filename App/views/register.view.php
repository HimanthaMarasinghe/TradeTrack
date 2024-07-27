<?php $this->component('header'); ?>

<form method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="age">Age</label>
        <input type="number" name="age" id="age">
    </div>
    <div>
        <label for="date">Date</label>
        <input type="date" name="date" id="date">
    </div>
</form>

<?php $this->component('footer'); ?>