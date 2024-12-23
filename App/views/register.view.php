<?php $this->component("header", $styleSheet); ?>

<div class="regBackground">
    <div class="regFormBackground">
        <h2>Register</h2>
        <form id="registerForm" method="POST" enctype="multipart/form-data">
            <div class="row gap-10">
                <div>
                    <div class="imageUploadBox">
                        <h3>Add your profile image</h3>
                        <div class="imagePreviewBox">
                            <div id="imageContainer"></div>
                        </div>
                        <input type="file" class="imageChooseInput" name="user_image" id="image" 
                            accept="image/jpg, image/jpeg, image/png, image/webp" 
                            onchange="previewImage(event)">
                        <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
                        <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>
                    </div>

                    <!-- For shop Owner -->
                    <div class="imageUploadBox s-js hidden">
                        <h3>Add an image of your shop</h3>
                        <div class="imagePreviewBox">
                            <div id="shop_imageContainer"></div>
                        </div>
                        <input disabled type="file" class="imageChooseInput s-js hidden" name="shop_image" id="shop_image" 
                            accept="image/jpg, image/jpeg, image/png, image/webp" 
                            onchange="previewImageShop(event)">
                        <button type="button" class="imageChooseBtn" onclick="triggerFileInputShop()">Choose</button>
                        <button type="button" class="imageRemoveBtn" onclick="removeImageShop()">Remove</button>
                    </div>
                </div>
                    <!-- Table -->
                    <table class="registerTable">
                    <!-- <thead>
                        <tr>
                            <th colspan="2"><h2>Register</h2></th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <!-- Image Upload Box -->
                        <!-- <tr>
                            <td colspan="2">
                            <div class="imageUploadBox">
                                <div id="imagePreview" class="imagePreviewBox">
                                    <div id="imageContainer"></div>
                                </div>
                                <input type="file" class="imageChooseInput" name="image" id="image" 
                                    accept="image/jpg, image/jpeg, image/png, image/webp" 
                                    onchange="previewImage(event)">
                                <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
                                <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>
                            </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td>First Name</td>
                            <td><input class="userInput" type="text" name="first_name" id="firstName" placeholder="Enter your first name" required></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><input class="userInput" type="text" name="last_name" id="lastName" placeholder="Enter your last name" required></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><input class="userInput" type="text" name="phone" id="phoneNumber" placeholder="Enter your phone number" required></td>
                        </tr>
                        <!-- <tr>
                            <td>Email</td>
                            <td><input class="userInput" type="email" name="email" id="email" placeholder="Enter your email address" required></td>
                        </tr> -->
                        <tr>
                            <td>Address</td>
                            <td><input class="userInput" type="text" name="address" id="address" placeholder="Enter your address" required></td>
                        </tr>
                        <!-- <tr>
                            <td>Gender</td>
                            <td>
                                <label class="customRadio">
                                    <input type="radio" name="gender" value="male" required>
                                    <span>Male</span>
                                </label>
                                <label class="customRadio">
                                    <input type="radio" name="gender" value="female">
                                    <span>Female</span>
                                </label>
                            </td>
                        </tr> -->
                        <!-- <tr>
                            <td>Date of Birth</td>
                            <td><input class="userInput" type="date" name="dob" id="dob" required></td>
                        </tr> -->
                        <tr>
                            <td>Register As</td>
                            <td>
                                <label class="customRadio">
                                    <input type="radio" name="role" value="0" onchange="updateForm()" checked>
                                    <span>Customer</span>
                                </label>
                                <label class="customRadio">
                                    <input type="radio" name="role" value="1"onchange="updateForm()">
                                    <span>Shop Owner</span>
                                </label>
                                <label class="customRadio">
                                    <input type="radio" name="role" value="2" onchange="updateForm()">
                                    <span>Manufacturer</span>
                                </label>
                            </td>
                        </tr>


                        <!-- For shop Owner -->
                        <tr class="s-js hidden">
                            <td>Shop Name</td>
                            <td><input disabled class="userInput s-js hidden" type="text" name="shop_name" placeholder="Enter your shop name" required></td>
                        </tr>
                        
                        <tr class="s-js hidden">
                            <td>Shop Address</td>
                            <td><input disabled class="userInput s-js hidden" type="text" name="shop_address" placeholder="Enter your shop address" required></td>
                        </tr>
                        
                        <!-- For Manufactures -->
                        <tr class="m-js hidden">
                            <td>Company name</td>
                            <td><input disabled class="userInput m-js hidden" type="text" name="company_name" placeholder="Enter your Company name" required></td>
                        </tr>
                        
                        <tr class="m-js hidden">
                            <td>Company Address</td>
                            <td><input disabled class="userInput m-js hidden" type="text" name="company_address" placeholder="Enter your Company address" required></td>
                        </tr>

                        <!-- Password -->
                        <tr>
                            <td>Password</td>
                            <td><input class="userInput" type="password" name="password" id="password" placeholder="Enter your password" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td>
                                <input class="userInput" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password" required>
                                <span id="passwordError" class="error"></span>
                            </td>
                        </tr>
                        <!-- Agree to Terms -->
                        <tr>
                            <td><input type="checkbox" id="agreeTerms" onclick="toggleSubmitButton()" required></td>
                            <td>
                                <label class="termsLabel">
                                    I agree to the <a href="#" target="_blank">Terms and Conditions</a>
                                </label>
                                <span id="termsError" class="error"></span>
                            </td>
                        </tr>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <td colspan="2">
                                <div class="formFooter">
                                    
                                </div>
                            </td>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
            <input type="submit" id="submitButton" class="btn w-100" value="Submit">
        </form>
    </div>
</div>

<script>
    // Trigger file input
    function triggerFileInput() {
        document.getElementById('image').click();
    }

    // Preview uploaded image
    function previewImage(event) {
        const imageContainer = document.getElementById('imageContainer');
        imageContainer.innerHTML = '';

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
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

    // Remove uploaded image
    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imageContainer').innerHTML = '';
    }


    // For shop owners' image

    // Trigger file input
    function triggerFileInputShop() {
        document.getElementById('shop_image').click();
    }

    // Preview uploaded image
    function previewImageShop(event) {
        const imageContainer = document.getElementById('shop_imageContainer');
        imageContainer.innerHTML = '';

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
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

    // Remove uploaded image
    function removeImageShop() {
        document.getElementById('shop_image').value = '';
        document.getElementById('shop_imageContainer').innerHTML = '';
    }

    // Real-time password validation
    document.getElementById('confirmPassword').addEventListener('input', function () {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        const errorSpan = document.getElementById('passwordError');

        if (password !== confirmPassword) {
            errorSpan.textContent = 'Passwords do not match!';
            errorSpan.style.color = 'red';
        } else {
            errorSpan.textContent = '';
        }
    });

    // Enable or disable the submit button
    function toggleSubmitButton() {
        const agreeTerms = document.getElementById('agreeTerms');
        const submitButton = document.getElementById('submitButton');

        submitButton.disabled = !agreeTerms.checked;
    }

    // Form submission handling
    function handleSubmit(event) {
        event.preventDefault();
        const form = document.getElementById('registerForm');
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            document.getElementById('passwordError').textContent = 'Passwords do not match!';
            document.getElementById('passwordError').style.color = 'red';
            return false;
        }

        if (form.checkValidity()) {
            alert('Registered Successfully!');
            window.location.href = "login"; // Redirect to login page
        } else {
            form.reportValidity();
        }
    }
    // Enable or disable the submit button
    function toggleSubmitButton() {
        const agreeTerms = document.getElementById('agreeTerms');
        const submitButton = document.getElementById('submitButton');

        // Enable the button only if the checkbox is checked
        submitButton.disabled = !agreeTerms.checked;

        // Provide feedback if the checkbox is not checked
        const termsError = document.getElementById('termsError');
        if (!agreeTerms.checked) {
            termsError.textContent = 'You must agree to the Terms and Conditions.';
            termsError.style.color = 'red';
        } else {
            termsError.textContent = '';
        }
    }




    function updateForm(){
        const selectedOption = document.querySelector('input[name="role"]:checked').value;
        const shopInput = document.querySelectorAll('input.s-js');
        const manuInput = document.querySelectorAll('input.m-js');
        const shopElem = document.querySelectorAll('.s-js');
        const manuElem = document.querySelectorAll('.m-js');
        
        shopInput.forEach(input => {
            input.disabled = true;
        });

        shopElem.forEach(elem => {
            elem.classList.add('hidden');
        });

        manuInput.forEach(input => {
            input.disabled = true;
        });

        manuElem.forEach(elem => {
            elem.classList.add('hidden');
        });

        if(selectedOption === '1'){
            shopInput.forEach(input => {
                input.disabled = false;
            });
            shopElem.forEach(elem => {
                elem.classList.remove('hidden')
            });
        }

        if(selectedOption === '2'){
            manuInput.forEach(input => {
                input.disabled = false;
            });
            manuElem.forEach(elem => {
                elem.classList.remove('hidden')
            });
        }

    }

</script>

<?php $this->component('footer'); ?>
