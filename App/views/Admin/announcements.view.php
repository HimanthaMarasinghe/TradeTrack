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
            <div class="bar">
                <div class="fg1"></div>
                <button class="btn" onclick="newAnnouncement()">
                    <h4>New Announcement</h4>
                </button>
            </div>
            <div class="panel fg1 scroll-box grid g-resp-300">
                <?php foreach($announcements as $a) { ?>
                    <div class="announcement" id="<?=$a['id']?>">
                        <div class="row">
                            <h4 class="fg1"><?php switch($a['role']){
                                case 0:
                                    echo "Customers";
                                    break;
                                case 1:
                                    echo "Shop Owners";
                                    break;
                                case 2:
                                    echo "Manufacturers";
                                    break;
                                case 3:
                                    echo "Distributors";
                                    break;
                            }?></h4>
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

        <div id="newAnouncement" class="popUpDiv hidden">
            <h2 id="makeAnnouncementPopUpTitle">Make new Announcement</h2>
            <form action="<?=LINKROOT?>/Admin/newAnnouncement" method="POST" id="makeAnnoncement" class="announcement-container">
                
                <!-- Dropdown to select user -->
                <label for="user-select">Select User:</label>
                <select id="user-select" name="role" required>
                <option value="0">Cusomers</option>
                <option value="1">Shop owners</option>
                <option value="2">Manufacturers</option>
                <option value="3">Distributors</option>
                </select>

                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Title" required>
                
                <!-- Textarea for the announcement message -->
                <label for="announcement-text">Your Message:</label>
                <textarea id="announcement-text" name="message" rows="10" placeholder="Write your announcement here..." required></textarea>
                
                <!-- Submit button -->
                <input type="Submit" id="submit-btn" class="btn w-100" value="Submit">
            </form>
        </div>

        <!-- announcement more details -->
        <div class="popUpDiv hidden" id="fullAnnouncement">
            <div class="announcement-container">
                <div class="row mg-10">
                    <h4 class="fg1">Customers</h4>
                    <div class="colomn">
                        <h5>2021-09-20</h5>
                        <h6>12:00:00</h6>
                    </div>
                </div>
                <h3 class="mg-10">Announcement Title</h3>
                <p class="mg-10">Announcement</p>
                <div class="row">
                    <button class="btn fg1" id="editAnnouncementBtn">Edit</button>
                    <button class="btn fg1" id="deleteAnnouncementBtn">Delete</button>
                </div>
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
                fetch('<?=LINKROOT?>/Admin/getAnnouncement/'+a.id, {
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
                    fullAnnouncement.querySelector('h4').textContent = role;
                    fullAnnouncement.querySelector('h5').textContent = data.date;
                    fullAnnouncement.querySelector('h6').textContent = data.time;
                    fullAnnouncement.querySelector('h3').textContent = data.title;
                    fullAnnouncement.querySelector('p').textContent = data.message;

                    document.getElementById('editAnnouncementBtn').onclick = () => editAnnouncement(data.id);
                    document.getElementById('deleteAnnouncementBtn').onclick = () => deleteAnnouncement(data.id);

                    //Change the form to edit the announcement
                    makeAnnouncementPopUpTitle.textContent = 'Edit Announcement';
                    document.getElementById('user-select').value = data.role;
                    document.getElementById('title').value = data.title;
                    document.getElementById('announcement-text').value = data.message;
                })
                .catch(error => console.error('Error:', error));
                viewPopUp('fullAnnouncement');
            });
        });

        function editAnnouncement(id){
            formSubmitBtn.value = 'Update';
            fullAnnouncement.classList.add('hidden');
            form.action = LINKROOT+'/Admin/updateAnnouncement/'+id;
            viewPopUp('newAnouncement');
        }

        function deleteAnnouncement(id){
            fetch(LINKROOT+'/Admin/deleteAnnouncement/'+id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</div>

<?php $this->component("footer") ?>