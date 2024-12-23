<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    // Side menu
?>

<div class="main-content">
    <h2>Update Sales Agent Details</h2>

    <form action="<?=LINKROOT?>/Manufacturer/UpdateAgent/<?=$agent['sa_phone']?>" method="POST" enctype="multipart/form-data">
        
    <!-- Image uploading box -->
    <div class="imageUploadBox">
        <div id="imagePreview" class="imagePreviewBox">
            <div id="imageContainer">
                <?php if(file_exists("./images/Profile/SA/".$agent['sa_phone'].".".$agent['sa_pic_format'])){ ?>
                <img src="<?=LINKROOT?>/images/Profile/SA/<?=$agent['sa_phone']?>.<?=$agent['sa_pic_format']?>" 
                    alt="Image Preview" 
                    style="width: 100%; height: 100%; object-fit: cover;">
                <?php } ?>
            </div>
        </div>

        <input type="file" class="imageChooseInput" name="image" id="image" 
            accept="image/jpg, image/jpeg, image/png, image/webp" 
            onchange="previewImage(event)">

        <!-- Hidden checkbox for removing the image -->
        <input type="checkbox" name="remove_image" id="removeImageCheckbox" style="display: none;">

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

                // Uncheck the "remove image" checkbox since a new image is selected
                document.getElementById('removeImageCheckbox').checked = false;
            }
        }

        function removeImage() {
            // Clear the file input and image preview
            document.getElementById('image').value = '';
            document.getElementById('imageContainer').innerHTML = '';

            // Check the "remove image" checkbox
            document.getElementById('removeImageCheckbox').checked = true;
        }
    </script>


        
        <table class="addNewAgentsTable">
            <tr>
                <td>Sales Agent's Phone Number</td>
                <td><input class="userInput" type="text" name="sa_phone" id="" value="<?=$agent['sa_phone']?>" required></td>
            </tr>
            <tr>
                <td>Business Name</td>
                <td><input class="userInput" type="text" name="sa_busines_name" id="" value="<?=$agent['sa_busines_name']?>" required></td>
            </tr>
            <tr>
                <td>Sales Agent's First Name</td>
                <td><input class="userInput" type="text" name="sa_first_name" id="" value="<?=$agent['sa_first_name']?>" required></td>
            </tr>
            <tr>
                <td>Sales Agent's Last Name</td>
                <td><input class="userInput" type="text" name="sa_last_name" id="" value="<?=$agent['sa_last_name']?>" required></td>
            </tr>
            <tr>
                <td>Sales Agent's Address</td>
                <td><input class="userInput" type="text" name="sa_address" id="" value="<?=$agent['sa_address']?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <input type="submit" class="btn" value="Update">
                </td>
            </tr>
        </table>

    </form>
</div>

<?php $this->component("footer"); ?>
