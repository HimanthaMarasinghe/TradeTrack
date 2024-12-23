<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    // Side menu
?>

<div class="main-content">
    <h2>Add New Sales Agent</h2>

    <form action="<?=LINKROOT?>/Manufacturer/addNewAgents" method="POST" enctype="multipart/form-data">
        
    <!-- Image uploading box -->
        <div class="imageUploadBox">
            <div id="imagePreview" class="imagePreviewBox">
                <div id="imageContainer"></div>
            </div>

            
            <input type="file" class="imageChooseInput" name="image" id="image" 
                accept="image/jpg, image/jpeg, image/png, image/webp" 
                onchange="previewImage(event)">
            
            
            <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>

            <p>Agent's Image</p>
        </div>
        
        <table class="addNewAgentsTable">
            <tr>
                <td>Sales Agent's Phone Number</td>
                <td><input class="userInput" type="text" name="phone" id="sa_phone" required></td>
            </tr>
            <tr>
                <td>Business Name</td>
                <td><input class="userInput" type="text" name="sa_busines_name" id="" required></td>
            </tr>
            <tr>
                <td>Sales Agent's First Name</td>
                <td><input class="userInput" type="text" name="first_name" id="sa_first_name" required></td>
            </tr>
            <tr>
                <td>Sales Agent's Last Name</td>
                <td><input class="userInput" type="text" name="last_name" id="sa_last_name" required></td>
            </tr>
            <tr>
                <td>Sales Agent's Address</td>
                <td><input class="userInput" type="text" name="address" id="sa_address" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <input type="submit" class="btn" value="Add">
                </td>
            </tr>
        </table>

    </form>
</div>


<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
            function triggerFileInput() {
                document.getElementById('image').click();
            }

            function previewImage(event) {
                const imageContainer = document.getElementById('imageContainer');
                imageContainer.innerHTML = '';

                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Image Preview';
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        imageContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }

            function removeImage() {
                document.getElementById('image').value = '';
                document.getElementById('imageContainer').innerHTML = '';
            }

            let phone = document.getElementById('sa_phone');
            let fname =document.getElementById('sa_first_name');
            let lname =document.getElementById('sa_last_name');
            let address =document.getElementById('sa_address');
            
            phone.addEventListener('input', function (e){
                this.value = this.value.replace(/[^0-9]/g, "");

                if(e.target.value.length == 10){
                    fetch(LINKROOT+'/LogedInUserCommon/getUserDetails', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'phone=' + encodeURIComponent(e.target.value)
                    }).then(response => response.json())
                    .then(data => {
                        if(data){
                            fname.value = data.first_name;
                            lname.value = data.last_name;
                            address.value = data.address;

                            fname.readOnly = true;
                            lname.readOnly = true;
                            address.readOnly = true;
                        }
                        else{
                            fname.value = '';
                            lname.value = '';
                            address.value = '';

                            fname.readOnly = false;
                            lname.readOnly = false;
                            address.readOnly = false;
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }

                if(e.target.value.length > 10)
                    e.target.value = e.target.value.substring(0, 10);

            })
        </script>

<?php $this->component("footer"); ?>
