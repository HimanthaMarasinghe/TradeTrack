<div id="BillDetails" class="popUpDiv hidden">
    <?php if($role == 'Distributor'){ ?>
        <h1>Order details</h1>
    <?php }else{ ?>
        <h1>Bill details</h1>
    <?php } ?>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <?php if($role == 'Distributor'){ ?>
                <p>Order Id</p>
            <?php }else{ ?>
                <p>Bill Id</p>
            <?php } ?>
            <p>Date</p>
            <p>Time</p>
            <?php if($role == 'Customer'){ ?>
                <p>Shop Name</p>
                <p>Shop Phone</p>
            <?php } elseif($role == 'Distributor'){ ?>
                <p>Distributor Name</p>
                <p>Distributor Phone</p>
                <p>Status</p>
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
            <?php if($role == 'Distributor'){ ?>
                <p id="More-details-bill-status"></p>
            <?php } ?>
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
                    <?php if($role == 'Distributor'){ ?>
                        <th class='left-al'>Bulk Price</th>
                    <?php }else{ ?>
                        <th class='left-al'>Unit Price</th>
                    <?php } ?>
                    <th class="left-al">Total</th>
                </tr>
            </thead>
            <tbody id="billDetailsItems">
            </tbody>
        </table>
        <h1 class="right-al" id="More-details-bill-total"></h1>
    </div>
</div>