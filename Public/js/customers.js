function swap(e){
    if(e.target.classList.contains('closed-grid') || e.target.parentElement.classList.contains('closed-grid') || e.target.parentElement.parentElement.classList.contains('closed-grid')){
        document.getElementById('pre-orders').classList.toggle('closed-grid');
        document.getElementById('new-lc-req').classList.toggle('closed-grid');
    }
}

document.getElementById('pre-orders').addEventListener('click', swap);
document.getElementById('new-lc-req').addEventListener('click', swap);