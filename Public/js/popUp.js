const backDrop = document.getElementById('popUpBackDrop');

function viewPopUp(popupId){
    backDrop.classList.remove('hidden')
    document.getElementById(popupId).classList.remove('hidden');
}

backDrop.addEventListener('click', () => {
    document.querySelectorAll('.popUpDiv').forEach((pop) => {
        pop.classList.add('hidden');
    })
    backDrop.classList.add('hidden');
});