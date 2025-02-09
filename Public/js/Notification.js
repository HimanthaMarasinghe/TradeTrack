export default class Notification {

    constructor(reload_data_func) {
        this.reload_data_func = reload_data_func || null;

        if (ws_id && ws_token) this.init();
    }

    init() {
        const customeWebSocket = new WebSocket("ws://localhost:8080");

        customeWebSocket.onopen = () => customeWebSocket.send(JSON.stringify({ id: ws_id, token: ws_token }));

        customeWebSocket.onmessage = (event) => {
            console.log("Message from server:", event.data);
            const message = JSON.parse(event.data);
            this.showNotification(message);
        };
    }

    showNotification(message) {
        const {type, link, image, title, body} = message;
        const container = document.getElementById('notification-container');
        const notification = document.createElement('a');
        notification.classList.add('notification');
        notification.href = `${LINKROOT}/${link}`;
    
        notification.innerHTML = `
                                    <div class="profile-photo asp-rtio">
                                        <img 
                                            src="${ROOT}/images/Profile/${image}" 
                                            alt="Customer Image" 
                                            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
                                    </div>
                                    <div class="colomn">
                                        <h3>${title}</h3>
                                        <p>${body}</p>
                                    </div>
                                `
    
        container.appendChild(notification);
    
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 5000);

        this.reload_data_func(type);
    }
}
