<div id="BillDetails" class="popUpDiv hidden">
    <h1>Bill details</h1>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <p>Bill Id</p>
            <p>Date</p>
            <p>Time</p>
            <?php if($role == 'Customer'){ ?>
                <p>Shop Name</p>
                <p>Shop Phone</p>
            <?php }else{ ?>
                <p>Customer Name</p>
                <p>Customer Phone</p>
            <?php } ?>
        </div>
        <div class="colomn fg1">
            <p id="More-details-bill-id"></p>
            <p id="More-details-bill-date"></p>
            <p id="More-details-bill-time"></p>
            <p id="More-details-bill-name"></p>
            <p id="More-details-bill-phone"></p>
        </div>
        <img id="More-details-bill-img" class="profile-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    </div>
    <div class="billScroll">
        <table class="bill min-w-1200">
            <thead>
                <tr class="BillHeadings">
                    <th class='center-al'>Barcode</th>
                    <th class='left-al'>Product Name</th>
                    <th class='left-al'>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="billDetailsItems">
            </tbody>
        </table>
        <h1 class="right-al" id="More-details-bill-total"></h1>
    </div>
</div>