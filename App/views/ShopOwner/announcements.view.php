<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">
            <div class="bar">
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
                <h1>Announcements</h1>
                <div class="row gap-10">
                    <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                    <?php $this->component("notification") ?>
                    <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
                </div>
            </div>
            <div class="panel fg1 scroll-box grid g-resp-300">
                <?php foreach($announcements as $a) { ?>
                    <div class="announcement" id="<?=$a['id']?>">
                        <div class="row">
                            <div class="colomn">
                                <h5><?=$a['date']?></h5>
                                <h6><?=$a['time']?></h6>
                            </div>
                        </div>
                        <h3><?=$a['title']?></h3>                        
                        <p><?=$a['message']?></p>
                    </div>
                    <?php } ?>
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

    <script src="announcement.js"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>
    <script>
        const LINKROOT = '<?=LINKROOT?>';
        const form = document.getElementById('makeAnnoncement');
        const formSubmitBtn = document.getElementById('submit-btn');
        const fullAnnouncement = document.getElementById('fullAnnouncement');
        const makeAnnouncementPopUpTitle = document.getElementById('makeAnnouncementPopUpTitle');

        function newAnnouncement(){
            //Change the form to make a new announcement
            makeAnnouncementPopUpTitle.textContent = 'Make new Announcement';
            formSubmitBtn.value = 'Submit';
            fullAnnouncement.classList.add('hidden');
            form.reset();
            form.action = LINKROOT+'/Admin/newAnnouncement';
            viewPopUp('newAnouncement');
        }

        document.querySelectorAll('.announcement').forEach(a => {
            a.addEventListener('click', () => {
                fetch('<?=LINKROOT?>/Customer/getAnnouncement/'+a.id, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                }).then(response => response.json())
                .then(data => {
                    let role = '';
                    switch(data.role){
                        case '0':
                            role = 'Customers';
                            break;
                        case '1':
                            role = 'Shop Owners';
                            break;
                        case '2':
                            role = 'Manufacturers';
                            break;
                        case '3':
                            role = 'Distributors';
                            break;
                    }
                    fullAnnouncement.querySelector('h5').textContent = data.date;
                    fullAnnouncement.querySelector('h6').textContent = data.time;
                    fullAnnouncement.querySelector('h3').textContent = data.title;
                    fullAnnouncement.querySelector('p').textContent = data.message;
                })
                .catch(error => console.error('Error:', error));
                viewPopUp('fullAnnouncement');
            });
        });
    </script>

</div>

<?php $this->component("footer") ?>