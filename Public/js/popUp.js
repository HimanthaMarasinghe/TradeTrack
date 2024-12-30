const backDrop = document.getElementById('popUpBackDrop');

function viewPopUp(popupId){
    backDrop.classList.remove('hidden')
    document.getElementById(popupId).classList.remove('hidden');
}

function closePopUp(){
    backDrop.classList.add('hidden');
    document.querySelectorAll('.popUpDiv').forEach((pop) => {
        pop.classList.add('hidden');
    });
}

backDrop.addEventListener('click', closePopUp);