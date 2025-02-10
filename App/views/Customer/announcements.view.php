<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">
            <div class="bar">
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
                <h1>Announcements</h1>
                <div>
                    <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
                    <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
                </div>
            </div>
            <div class="panel fg1 scroll-box grid g-resp-300" id="elements-Scroll-Div">
            </div>


<!-- PopUps -->
        <div id="popUpBackDrop" class="hidden"></div>

        <!-- announcement more details -->
        <div class="popUpDiv hidden" id="fullAnnouncement">
            <div class="announcement-container">
                <div class="row mg-10">
                    <div class="colomn">
                        <h5>2021-09-20</h5>
                        <h6>12:00:00</h6>
                    </div>
                </div>
                <h3 class="mg-10">Announcement Title</h3>
                <p class="mg-10">Announcement</p>
            </div>
        </div>

        <div id="notification-container"></div>
    <script>
        const ROOT = "<?=ROOT?>";
        const LINKROOT = "<?=LINKROOT?>"
        const ws_id = "<?=$_SESSION['customer']['phone']?>";
        const ws_token = "<?=$_SESSION['web_socket_token']?>";
        const Announcements = <?=json_encode($announcements, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT)?>;
    </script>
    <script src="<?=ROOT?>/js/receiveAnnouncement.js" type="module"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>


</div>

<?php $this->component("footer") ?>