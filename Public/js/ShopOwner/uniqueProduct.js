import Notification from "../Notification.js";

new Notification();

document.getElementById('openPopUp').addEventListener('click', () => viewPopUp('addStock'));

document.getElementById('editPopUp').addEventListener('click', () => viewPopUp('editProduct'));
document.getElementById('recordWaste')?.addEventListener('click', () => viewPopUp('wastePopUp'));
document.getElementById('openPopUp')?.addEventListener('click', () => viewPopUp('addStock'));

const radios = document.getElementsByName('purchaseType');
const cost = document.getElementById('cost');

for (let i = 0; i < radios.length; i++) {
    radios[i].addEventListener('change', function() {
        console.log(this.value);
        if (this.value === 'fromDrawer') cost.setAttribute('max', cashDrawer);
        else cost.removeAttribute('max');
    });
}