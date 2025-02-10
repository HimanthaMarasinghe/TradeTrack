import Notification from "./Notification.js";
import ApiFetcherMod from "./ApiFetcherMod.js";

const fullAnnouncement = document.getElementById('fullAnnouncement');

function announcementPopUp(announcement){
    fullAnnouncement.querySelector('h5').textContent = announcement.date;
    fullAnnouncement.querySelector('h6').textContent = announcement.time;
    fullAnnouncement.querySelector('h3').textContent = announcement.title;
    fullAnnouncement.querySelector('p').textContent = announcement.message;
    viewPopUp('fullAnnouncement');
}

function announcementCard(announcement) {
    const { id, date, time, title, message } = announcement;

    return `
        <div class="announcement clickable" id="${id}">
            <div class="row">
                <div class="colomn">
                    <h5>${date}</h5>
                    <h6>${time}</h6>
                </div>
            </div>
            <h3>${title}</h3>                        
            <p>${message}</p>
        </div>
    `;
}

const apiConfig = {
    api: 'Customer/getAnnouncements',
    cardTemplate: announcementCard,
    clickEvent: announcementPopUp
}

const apiFetcherMod = new ApiFetcherMod(apiConfig);

const loadDataOnNotification = (type) => {
    if (type == 'ann') apiFetcherMod.loadDataWithSearchOrFilter();
}

new Notification(loadDataOnNotification);
