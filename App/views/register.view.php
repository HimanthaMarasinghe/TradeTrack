<?php $this->component("header", $styleSheet); ?>

<div class="regBackground">
    <div class="regFormBackground">
        <h2>Register</h2>
        <form id="registerForm" method="POST" enctype="multipart/form-data" class="fg1 colomn">
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
                    <tbody>
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
                            <td><input class="userInput" type="text" name="phone" id="phoneNumber" placeholder="Enter your phone number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" pattern="\d{10}" title="Please enter a valid 10-digit phone number" required></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input class="userInput" type="text" name="address" id="address" placeholder="Enter your address" required></td>
                        </tr>
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
                                    <input type="radio" name="role" value="3" onchange="updateForm()">
                                    <span>Distributor</span>
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

                        <!-- For Distributor -->

                        <tr class="d-js hidden">
                            <td>Busines Name</td>
                            <td><input disabled class="userInput d-js hidden" type="text" name="dis_busines_name" placeholder="Enter your Busines name"></td>
                        </tr>
                        <tr class="d-js hidden">
                            <td>Busines Address</td>
                            <td><input disabled class="userInput d-js hidden" type="text" name="dis_busines_address" placeholder="Enter your Busines address"></td>
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
                    </tbody>
                </table>
            </div>
            <div class="fg1"></div>
            <input type="submit" id="submitButton" class="btn" value="Submit">
            <div class="login-link">
                <p>Already have an account? <a href="<?=LINKROOT?>/login">Sign In</a></p>
            </div>
        </form>
    </div>
</div>

<?php if (isset($data['error'])): ?>
    <div class="warning-message">
        <?= $data['error'] ?>
    </div>
<?php endif; ?>

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
        const disInput = document.querySelectorAll('input.d-js');
        const shopElem = document.querySelectorAll('.s-js');
        const manuElem = document.querySelectorAll('.m-js');
        const disElem = document.querySelectorAll('.d-js');
        
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

        disInput.forEach(input => {
            input.disabled = true;
        })

        disElem.forEach(elem => {
            elem.classList.add('hidden');
        })

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

        if(selectedOption === '3'){
            disInput.forEach(input => {
                input.disabled = false;
            });
            disElem.forEach(elem => {
                elem.classList.remove('hidden')
            })
        }

    }

</script>

<?php $this->component('footer'); ?>
