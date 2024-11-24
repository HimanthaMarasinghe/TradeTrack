<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content column">
            <div class="bar">
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
                <h1>Announcements</h1>
                <div>
                    <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
                    <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
                </div>
            </div>

        <div class="announcement-container scroll-box">
            
            <!-- Dropdown to select user -->
            <label for="user-select">Select User:</label>
            <select id="user-select">
            <option value="user1">Shop owner</option>
            <option value="user2">Cusomer</option>
            <option value="user3">Supplier</option>
            <option value="user4">Sales agent</option>
            </select>
            
            <!-- Textarea for the announcement message -->
            <label for="announcement-text">Your Message:</label>
            <textarea id="announcement-text" rows="10" placeholder="Write your announcement here..."></textarea>
            
            <!-- Submit button -->
            <button id="submit-btn">Submit</button>
        </div>

    <script src="announcement.js"></script>

</div>

<?php $this->component("footer") ?>