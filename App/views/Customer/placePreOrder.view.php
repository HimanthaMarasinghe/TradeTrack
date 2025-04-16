<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content">
    <div class="row h-100 gap-10">
        <div class="colomn w-25">
            <h3>New Pre Order</h3>
            <h4><?=$shop_name?></h4>
            <input id="searchBar" type="text" class="search-bar" placeholder="Search">
            <div class="grid g-resp-300 scroll-box" id="elements-Scroll-Div">
            </div>
        </div>

        <div class="colomn w-75">
            <div class="billScroll">
                <table class="bill">
                    <thead>
                        <tr class="BillHeadings">
                            <th>No.</th>
                            <th class="w-50">Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="bill">
                        <!-- Rows will be added When we select item from the list -->
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="total">
                <h1 id="bill-Total">0</h1>
            </div>
            <hr>

            <div class="row col-max-1024">
                <div class="product-img-container">
                    <img id="product-pic" 
                         class="product-img" 
                         src="<?=ROOT?>/images/Default/Product.jpeg" 
                         alt="Selected Product Image"
                         onerror="this.src='<?=ROOT?>/images/Products/default.jpeg'">
                </div>

                <div class="colomn fg1">
                    <div class="row scan">
                        <input class="userInput fg1" type="text" id="product-name" placeholder="Product Name" readonly tabindex="-1">
                    </div>

                    <div class="row scan">
                        <div>
                            <label for="qty">Qty.</label>
                            <input class="userInput short" type="number" id="qty" name="qty">
                        </div>
                        <div>
                            <label for="unit-price">Unit Price</label>
                            <input class="userInput short" type="text" id="unit-price" readonly tabindex="-1">
                        </div>
                        <div>
                            <label for="total">Total Price</label>
                            <input class="userInput short" type="text" id="total" readonly tabindex="-1">
                        </div>
                        <button class="btn disabled-link" id="addBtn">+</button>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <button class="btn disabled-link" id="placeOrderBtn">Place Order</button>
            </div>
        </div>
    </div>
</div>
<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
    const shopPhone = "<?=$so_phone?>";
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
</script>
<script src="<?=ROOT?>/js/Customer/placePreOrder.js" type="module"></script>


<?php $this->component("footer") ?>