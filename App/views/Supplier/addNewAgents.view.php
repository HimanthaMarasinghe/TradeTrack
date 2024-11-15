<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    // Side menu
?>

<div class="main-content">
    <h2>Add New Sales Agent</h2>

    <form action="<?=LINKROOT?>/Supplier/addNewAgents" method="POST" enctype="multipart/form-data">
        
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

        <script>
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
        </script>

        
        <table class="addNewAgentsTable">
            <tr>
                <td>Sales Agent's Phone Number</td>
                <td><input class="userInput" type="text" name="sa_phone" id="" required></td>
            </tr>
            <tr>
                <td>Business Name</td>
                <td><input class="userInput" type="text" name="sa_busines_name" id="" required></td>
            </tr>
            <tr>
                <td>Sales Agent's First Name</td>
                <td><input class="userInput" type="text" name="sa_first_name" id="" required></td>
            </tr>
            <tr>
                <td>Sales Agent's Last Name</td>
                <td><input class="userInput" type="text" name="sa_last_name" id="" required></td>
            </tr>
            <tr>
                <td>Sales Agent's Address</td>
                <td><input class="userInput" type="text" name="sa_address" id="" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <input type="submit" class="btn" value="Add">
                </td>
            </tr>
        </table>

    </form>
</div>

<?php $this->component("footer"); ?>