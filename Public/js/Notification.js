export default class Notification {

    constructor(reload_data_func, hideNotification, notClickable, del_notification) {
        this.reload_data_func = reload_data_func || null;
        this.hideNotification = hideNotification || false;
        this.notClickable = notClickable || false;

        this.notificationIcon = document.getElementById("notificationIcon") || null;

        if (ws_id && ws_token) this.initPushNotifications();
        if (this.notificationIcon) this.innitNotificationDropDown();
        if (del_notification) this.deleteNotification(del_notification);
    }

    initPushNotifications() {
        const customeWebSocket = new WebSocket("ws://localhost:8080");

        customeWebSocket.onopen = () => customeWebSocket.send(JSON.stringify({ id: ws_id, token: ws_token }));

        customeWebSocket.onmessage = (event) => {
            console.log("Message from server:", event.data);
            const message = JSON.parse(event.data);
            if(!this.hideNotification) this.showNotification(message);
        };
    }

    async innitNotificationDropDown() {
        
        this.dropdown = document.getElementById("notificationDropdown");
        this.notificationCount = document.getElementById("notificationCount");
        this.notificationList = document.getElementById("notificationList");
        this.notificationBackDrop = document.getElementById("notification-backDrop");
        this.notifications = JSON.parse(sessionStorage.getItem("notifications" + ws_id)) || [];

        if (this.notifications.length === 0) {
            try {
                const response = await fetch(`${LINKROOT}/LogedInUserCommon/getNotifications`);
                const data = await response.json();
                if (data) {
                    this.notifications = data;
                    sessionStorage.setItem("notifications" + ws_id, JSON.stringify(this.notifications));
                }
            } catch (error) {
                console.error("Error fetching notifications:", error);
                return; // Stop execution if fetching fails
            }
        }

        this.notificationCount.innerHTML = this.notifications.length;

        // if (!sessionStorage.getItem("notifi-count" + ws_id)) {
        //     try {
        //         const response = await fetch(`${LINKROOT}/LogedInUserCommon/getNotificationsCount`);
        //         const count = await response.json();
        //         sessionStorage.setItem("notifi-count" + ws_id, count);
        //     } catch (error) {
        //         console.error("Error fetching notifications count:", error);
        //         return; // Stop execution if fetching fails
        //     }
        // }
        // this.notificationCount.innerHTML = sessionStorage.getItem("notifi-count" + ws_id);

        // Toggle dropdown visibility
        notificationIcon.addEventListener("click", async () => {
            this.notificationList.innerHTML = ""; // Clear the list before fetching
    
            // if (this.notifications.length === 0) {
            //     try {
            //         const response = await fetch(`${LINKROOT}/LogedInUserCommon/getNotifications`);
            //         this.notifications = await response.json();
            //         sessionStorage.setItem("notifications" + ws_id, JSON.stringify(this.notifications));
            //         this.notificationCount.innerHTML = this.notifications.length;
            //     } catch (error) {
            //         console.error("Error fetching notifications:", error);
            //         return; // Stop execution if fetching fails
            //     }
            // }
    
            console.log(this.notifications);
    
            // Ensure notifications are loaded before updating the UI
            this.notificationList.innerHTML = this.notifications
                .map(notification => this.notificationDropDownCard(notification))
                .join("");
    
            this.dropdown.style.display = "block";
            this.notificationBackDrop.classList.remove("hidden");
        });

        this.notificationBackDrop.addEventListener("click", () => {
            this.notificationBackDrop.classList.add("hidden");
            this.dropdown.style.display = "none";
        });
    }

    showNotification(message) {
        const {type, ref_id, link, image, title, body} = message;
        const container = document.getElementById('notification-container');
        const notification = document.createElement('a');
        notification.classList.add('notification');
        if(!this.notClickable) notification.href = `${LINKROOT}/${link}`;
    
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
            setTimeout(() => notification.remove(), 3000);
        }, 5000);

        if(this.reload_data_func) this.reload_data_func(type);

        if (this.notificationIcon) {
            const messageToSave = {
                type: type,
                ref_id: ref_id,
                link: link,
                title: title,
                body: body
            }

            let notificationsTemp = JSON.parse(sessionStorage.getItem("notifications" + ws_id)) || [];

            notificationsTemp = notificationsTemp.filter(element => !(element.type === type && element.ref_id === ref_id && element.link === link && element.title === title && element.body === body));
            
            let notificationCount = notificationsTemp.unshift(messageToSave);
            
            sessionStorage.setItem("notifications" + ws_id, JSON.stringify(notificationsTemp));

            this.notifications = notificationsTemp;
            this.notificationCount.innerHTML = notificationCount;

            if (this.dropdown.style.display === "block") {
                this.notificationList.innerHTML = this.notifications
                    .map(notification => this.notificationDropDownCard(notification))
                    .join("");
            }
        }
    }

    notificationDropDownCard(notification) {
        const {link, title, body} = notification;

        return `
            <a href="${LINKROOT}/${link}" class="notifi-card">
                <h2>${title}</h2>
                <p>${body}</p>
              </a>
            `
    }

    deleteNotification(notification) {
        this.notifications = this.notifications.filter(element => !(element.type === notification.type && element.ref_id === notification.ref_id));
        sessionStorage.setItem("notifications" + ws_id, JSON.stringify(this.notifications));
        this.notificationCount.innerHTML = this.notifications.length;
        fetch(`${LINKROOT}/LogedInUserCommon/deleteNotification`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(notification)
        });
    }
}
