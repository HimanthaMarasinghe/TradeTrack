let offset = 0;
let allProductsLoaded = false;
let isLoading = false;
const searchBar = document.getElementById('searchBar');
const productsList = document.getElementById('productsList');
let productsArray = [];
let product;

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
        const response = await fetch(`${LINKROOT}/ShopOwner/getProducts/${offset}/${search}/`);
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
                    <table>
                        <tr>
                            <td>Unit Price</td>
                            <td><h4>Rs.${product.unit_price.toFixed(2)}</h4></td>
                        </tr>
                        <tr>
                            <td>Bulk Price</td>
                            <td><h4>Rs.${product.bulk_price.toFixed(2)}</h4></td>
                        </tr>
                    </table>
                </div>
                <div class="product-img-container">
                    <img class="product-img" 
                        src="${ROOT}/images/Products/${product.barcode}.${product.pic_format}" 
                        alt="Product Image"
                        onerror="this.src='${ROOT}/images/Products/default.jpeg'">
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
    product = productsArray.find(p => p.barcode === card.id);
    if (product) {
        const productImage = document.getElementById('popUp-prdct-image');
        productImage.src = `${ROOT}/images/Products/${product.barcode}.${product.pic_format}`;
        productImage.onerror = function () {
            this.src = `${ROOT}/images/Products/default.jpeg`;
        };
        document.getElementById('popUp-prdct-name').innerText = product.product_name;
        document.getElementById('popUp-prdct-unit-price').innerText = `Rs.${product.unit_price.toFixed(2)}`;
        document.getElementById('popUp-prdct-bulk-price').innerText = `Rs.${product.bulk_price.toFixed(2)}`;
        viewPopUp('addStock');
    }
}

// popup

const quantityField = document.getElementById('quantity');
const costField = document.getElementById('cost');

quantityField.addEventListener('input', function () {
    const quantity = this.value;
    costField.value = (quantity * product.bulk_price).toFixed(2);
});

// Initial load
initialLoad();