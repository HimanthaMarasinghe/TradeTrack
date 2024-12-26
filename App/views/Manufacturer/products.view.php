<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Business Name</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search">
                <button class="btn">Search</button>
                <button class="btn" onclick="addNewProduct()">Add new products</button>
            </div>
            <div class="scroll-box grid g-resp-300">
                <?php
                    foreach ($staticStocks as $stock) { 
                        $this->component('card/product', $stock, ['baseUrl' => 'Manufacturer/product']); 
                    }
                    foreach ($pendingProducts as $stock) { 
                        $this->component('card/product', $stock, ['special' => "Request Pending"]); 
                     } ?>
            </div>
        </div>
    </div>

</div>

<!-- add new product request popup -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addNewProducts" class="hidden popUpDiv">
    <h2>Make a request to add new product</h2>
    <br>
    <form action="<?=LINKROOT?>/Manufacturer/newProductRequest" method="POST" id="addNewProductForm">

    <div class="imageUploadBox" id="pop">
        <div id="imagePreview" class="imagePreviewBox">
            <div id="imageContainer"></div>
        </div>
        
        
        <input type="file" class="imageChooseInput" name="image" id="image" 
        accept="image/jpg, image/jpeg, image/png, image/webp" 
        onchange="previewImage(event)">
        
        
        <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
        <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>
    </div>

        <table>
            <tr>
                <td><label for="name">Product Name</label></td>
                <td><input class="userInput" type="text" name="product_name" id="name" required></td>
            </tr>
            <tr>
                <td><label for="barcode">Barcode</label></td>
                <td><input class="userInput" type="text" name="barcode" id="barcode"></td>
            </tr>
            <tr>
                <td colspan="2"><p>If your product do not have a barcode leave the above field empty. The system will generate a barcode for your product.</p></td>
            </tr>
            <tr>
                <td><label for="barcode">Barcode Registration Proof</label></td>
                <td><input type="file" id="barcodeProof" name="barcodeProof" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"></td>
            </tr>
            <tr>
                <td colspan="2"><p>If you add a barcode to the form, please upload the official barcode registration document, or a product wraper.</p></td>
            </tr>
            <tr>
                <td><label for="unit_price">Unit price</label></td>
                <td><input class="userInput" type="text" name="unit_price" id="unit_price" required></td>
            </tr>
            <tr>
                <td><label for="bulk_price">Bulk price</label></td>
                <td><input class="userInput" type="text" name="bulk_price" id="bulk_price" required></td>
            </tr>
        </table>
        <input type="submit" class="btn" id="formSubmitBtn" value="Make request">
    </form>
</div>

<div id="productDetails" class="hidden popUpDiv colomn">
    <h2>Product is sent to admin review</h2>
    <img src="<?=ROOT?>/images/Default/Product.jpeg" alt="" class="default big">
    <table>
        <h3 id="req-prd-name">Lorem ipsum dolor sit amet.</h3>
        <tr>
            <td>Barcode</td>
            <td id="req-prd-barcode"></td>
        </tr>
        <tr>
            <td>Unit Price</td>
            <td id="req-prd-price"></td>
        </tr>
        <tr>
            <td>Bulk Price</td>
            <td id="req-prd-bulk"></td>
        </tr>
    </table>
    <div class="row">
        <button class="btn fg1" id="update-btn">Update</button>
        <button class="btn fg1" id="delete-btn">Delete</button>
    </div>
</div>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script>
    const LINKROOT = '<?=LINKROOT?>';
    const form = document.getElementById('addNewProductForm');
    const formSubmitBtn = document.getElementById('formSubmitBtn');
    const productDetailsPopUp = document.getElementById('productDetails');
    const productDetailsPopUpHeader = document.getElementById('addNewProducts').querySelector('h2');

    function addNewProduct() {
        productDetailsPopUpHeader.textContent = 'Make a request to add new product';
        form.reset(); // Reset form fields
        form.action = LINKROOT+'/Manufacturer/newProductRequest'; // Reset form action URL to its default value
        formSubmitBtn.value = 'Make request'; // Reset any dynamic labels or changes (if needed)
        viewPopUp('addNewProducts');
    }


    document.querySelectorAll(".card-js").forEach((card) => {
        card.addEventListener("click", function(event) {
            console.log(encodeURIComponent(event.currentTarget.id));
            fetch(LINKROOT+'/Manufacturer/pendingProductRequestDetails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'barcodeIn=' + encodeURIComponent(event.currentTarget.id)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('req-prd-barcode').textContent = data.barcode;
                document.getElementById('req-prd-name').textContent = data.product_name;
                document.getElementById('req-prd-price').textContent = 'Rs.' + data.unit_price.toFixed(2);
                document.getElementById('req-prd-bulk').textContent = 'Rs.' + data.bulk_price.toFixed(2);
                document.getElementById('update-btn').onclick = () => updateRequest(data.barcode);
                document.getElementById('delete-btn').onclick = () => deleteRequest(data.barcode);

                // Redy the form to update the product
                document.getElementById('name').value = data.product_name;
                document.getElementById('barcode').value = data.barcode;
                document.getElementById('unit_price').value = data.unit_price;
                document.getElementById('bulk_price').value = data.bulk_price;
            })
            .catch(error => console.error('Error:', error));
            viewPopUp('productDetails');
        })
    })

    function updateRequest(barcode) {
        productDetailsPopUpHeader.textContent = 'Update product request';
        productDetailsPopUp.classList.add('hidden');
        form.action = LINKROOT+'/Manufacturer/updateProductRequest/'+barcode;
        formSubmitBtn.value = 'Update';
        viewPopUp('addNewProducts');
    }

    function deleteRequest(barcode) {
        fetch(LINKROOT+'/Manufacturer/deleteProductRequest', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'barcode=' + encodeURIComponent(barcode)
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

<?php $this->component("footer") ?>