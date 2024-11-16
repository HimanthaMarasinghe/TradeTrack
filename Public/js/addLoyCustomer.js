function addLoyCustmer(cus_phone){
    fetch(LINKROOT+'/ShopOwner/addLoyCus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'cus_phone=' + encodeURIComponent(cus_phone)
    })
    .then(
        () => location.reload()
    )
    .catch(error => console.error('Error:', error));
}