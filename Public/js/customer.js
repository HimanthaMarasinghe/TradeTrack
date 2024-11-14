function revokeLoyalty(loy_phone, wallet_amount){
    if(wallet_amount != 0) {
        alert("The customer's wallet balance is not zero. Please settle the balance with the customer before revoking their loyalty privileges.");
        return;
    }
    fetch(LINKROOT+'/ShopOwner/revokeLoyalty', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'loy_phone=' + encodeURIComponent(loy_phone)
    })
    .then(
        location.reload()
    )
    .catch(error => console.error('Error:', error));
}