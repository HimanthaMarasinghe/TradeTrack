document.getElementById('cancelOrderBtn').addEventListener('click', () =>{
    fetch( `${LINKROOT}/Distributor/cancelOrder/${order_id}`,
    {method: "post"}).then(location.reload())
});