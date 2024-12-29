<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Gamunu Stores</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <p>Add stock that you receive outside of the system's order.</p>
            <p>Do you have a unique product that's not on this list? Add it to your <a href="">unique products</a>.</p>
            <div class="row">
                <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
                <!-- <button class="btn">Search</button> -->
            </div>
            <div class="scroll-box grid g-resp-300" id="productsList">
            </div>
        </div>
    </div>

</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addStock" class="popUpDiv hidden">
    <img id="popUp-prdct-image" class="profile-img big" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
    <div class="details h-50 center-al">
        <h4 id="popUp-prdct-name">product_name</h4>
        <h4 id="popUp-prdct-price">Rs.100.00</h4>
    </div>
    <form class="colomn mg-10 gap-10">
        <table>
            <tr>
                <td><label for="quanitity">Quanitity</label></td>
                <td><input type="number" class="userInput" id="quanitity" name="quanitity"></td>
            </tr>
            <tr>
                <td><label for="cost">Cost</label></td>
                <td><input type="number" class="userInput" id="cost" name="cost"></td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="onCash-radio" name="purchaseType" value="onCash" checked> 
                </td>
                <td>
                    <label for="onCash-radio">Purchased On Cash</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="onCredit-radio" name="purchaseType" value="onCredit"> 
                </td>
                <td>
                    <label for="onCredit-radio">Purchased On Credit</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="none-radio" name="purchaseType" value="none"> 
                </td>
                <td>
                    <label for="none-radio">Do not update accounts</label>
                </td>
            </tr>
        </table>
        <button class="btn">Add</button>
    </form>
</div>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script>
    let offset = 0;
    let allProductsLoaded = false;
    let isLoading = false;
    const searchBar = document.getElementById('searchBar');
    const productsList = document.getElementById('productsList');
    let productsArray = [];

    // Function to load products from the API
    async function loadProducts(offset, search = "") {
        console.log("Loading products", offset, search);

        if (isLoading) return;

        if (allProductsLoaded){
            productsList.removeEventListener('scroll', loadProductsOnScroll);
            return;
        } 

        isLoading = true;
        try {
            const response = await fetch(`<?=LINKROOT?>/ShopOwner/getProducts/${offset}/${search}/`);
            if (!response.ok) throw new Error("Failed to fetch products");

            const products = await response.json();
            if (products.length < 10) {
                allProductsLoaded = true; // No more products available
            }

            // Append products to the list and update the products array
            productsArray.push(...products);
            renderProducts(products);
        } catch (error) {
            console.error("Error loading products:", error);
        } finally {
            isLoading = false;
        }
    }

    // Function to render products as cards
    function renderProducts(products) {
        products.forEach(product => {
            const productCard = `
                <a href="#" class="card btn-card center-al" id="${product.barcode}" onclick="addStockPopUp(this)">
                    <div class="details h-100">
                        <h4>${product.product_name}</h4>
                        <h4>${product.barcode}</h4>
                        <h4>Rs.${product.unit_price.toFixed(2)}</h4>
                    </div>
                    <div class="product-img-container">
                        <img class="product-img" 
                            src="<?=ROOT?>/images/Products/${product.barcode}.${product.pic_format}" 
                            alt="Product Image">
                    </div>
                </a>
            `;
            productsList.innerHTML += productCard;
        });
    }

    // Function to ensure the initial load fills the viewport
    async function initialLoad(search = "") {
        while (productsList.scrollHeight <= productsList.clientHeight && !allProductsLoaded) {
            await loadProducts(offset, search);
            offset += 10;
        }
    }

    // Handle search input changes
    searchBar.addEventListener('input', () => {
        allProductsLoaded = false;
        offset = 0;
        productsList.innerHTML = ""; // Clear the product list
        productsArray = []; // Reset the products array
        initialLoad(searchBar.value); // Load products based on the search input
        productsList.addEventListener('scroll', loadProductsOnScroll); // Re-add the scroll listener
    });

    // Infinite scroll listener
    productsList.addEventListener('scroll', loadProductsOnScroll);

    function loadProductsOnScroll() {
        if (productsList.scrollTop + productsList.clientHeight >= productsList.scrollHeight - 1) {
            loadProducts(offset, searchBar.value); // Load more products
            offset += 10;
        }
    }

    // Function to handle product pop-up
    function addStockPopUp(card) {
        const product = productsArray.find(p => p.barcode === card.id);
        if (product) {
            document.getElementById('popUp-prdct-image').src = 
                `<?=ROOT?>/images/Products/${product.barcode}.${product.pic_format}` || 
                `<?=ROOT?>/images/Products/default.jpeg`;
            document.getElementById('popUp-prdct-name').innerText = product.product_name;
            document.getElementById('popUp-prdct-price').innerText = `Rs.${product.unit_price.toFixed(2)}`;
            viewPopUp('addStock');
        }
    }

    // Initial load
    initialLoad();
</script>

<?php $this->component("footer") ?>