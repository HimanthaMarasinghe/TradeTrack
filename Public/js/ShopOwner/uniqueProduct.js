import Notification from "../Notification.js";

new Notification();

document.getElementById('openPopUp').addEventListener('click', () => viewPopUp('addStock'));

document.getElementById('editPopUp').addEventListener('click', () => viewPopUp('editProduct'));
document.getElementById('recordWaste')?.addEventListener('click', () => viewPopUp('wastePopUp'));
document.getElementById('openPopUp')?.addEventListener('click', () => viewPopUp('addStock'));