function revokeLoyalty(loy_phone){
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