function reqLoyalty() {
    fetch(LINKROOT + '/Customer/reqLoyalty', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'so_phone=' + encodeURIComponent(shopPhone)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        } else {
            alert('Request failed');
        }
    })
}