export default class Notification {

    constructor(reload_data_func, hideNotification, notClickable, del_notification, sync) {
        this.reload_data_func = reload_data_func || null;
        this.hideNotification = hideNotification || false;
        this.notClickable = notClickable || false;
        this.syncWithDb = sync || false;
        this.loadedFromDbFlag = false;

        this.chatBox = document.querySelector(".chatbox");
        this.handleChat = null;

        if (typeof ws_token !== 'undefined' && ws_token) {
            this.ws_token = ws_token;
            sessionStorage.setItem('ws_token'+ws_id, ws_token);
        }
        else this.ws_token = sessionStorage.getItem('ws_token'+ws_id) || null;
        console.log(this.ws_token);

        this.notificationIcon = document.getElementById("notificationIcon") || null;

        if (ws_id && this.ws_token) this.initPushNotifications();
        else this.syncWithDb = true;

        if (this.notificationIcon) this.innitNotificationDropDown();
        if (del_notification) this.deleteNotification(del_notification);
    }

    initPushNotifications() {
        console.log("Initializing Push Notifications...");
        const customeWebSocket = new WebSocket("ws://localhost:8080");

        customeWebSocket.onopen = () => customeWebSocket.send(JSON.stringify({ id: ws_id, token: this.ws_token }));

        customeWebSocket.onerror = async (error) => {
            await this.loadNotificationsFromDB();
            this.notificationCount.innerHTML = this.notifications.length;
            console.error("WebSocket error:", error);
        };

        customeWebSocket.onmessage = async (event) => {
            console.log("Message from server:", event.data);
            const message = JSON.parse(event.data);
            if (message.error) {
                await this.loadNotificationsFromDB();
                this.notificationCount.innerHTML = this.notifications.length;
                console.error("Error from server:", message.error);
                return;
            }
            if(!this.hideNotification) this.showNotification(message);
        };
    }

    async innitNotificationDropDown() {
        
        this.dropdown = document.getElementById("notificationDropdown");
        this.notificationCount = document.getElementById("notificationCount");
        this.notificationList = document.getElementById("notificationList");
        this.notificationBackDrop = document.getElementById("notification-backDrop");
        this.notifications = JSON.parse(sessionStorage.getItem("notifications" + ws_id)) || [];

        if (this.syncWithDb) await this.loadNotificationsFromDB();

        this.notificationCount.innerHTML = this.notifications.length;

        notificationIcon.addEventListener("click", async () => {
            this.notificationList.innerHTML = ""; // Clear the list before fetching
    
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

    async loadNotificationsFromDB() {
        if(this.loadedFromDbFlag) return;
        this.loadedFromDbFlag = true;
        console.log("Fetching Notifications from db...")
        try {
            const response = await fetch(`${LINKROOT}/LogedInUserCommon/getNotifications`);
            const data = await response.json();
            this.notifications = data;
            sessionStorage.setItem("notifications" + ws_id, JSON.stringify(this.notifications));
        } catch (error) {
            console.error("Error fetching notifications:", error);
            return; // Stop execution if fetching fails
        }
    }

    createChatLi(message, className) {
        const chatLi = document.createElement("li");
        chatLi.classList.add("chat", className);
        chatLi.innerHTML = `<p>${message}</p>`;
        return chatLi;
    }

    showNotification(message) {
        const {type, ref_id, link, image, title, body} = message;
        
        if (this.chatBox && type === "chat") {
            this.chatBox.appendChild(this.createChatLi(body, "incoming"));
            this.chatBox.scrollTo(0, this.chatBox.scrollHeight);
            if (this.handleChat) return;
        }
        
        const container = document.getElementById('notification-container');
        const notification = document.createElement('a');
        notification.classList.add('notification');
        if(!this.notClickable) notification.href = `${LINKROOT}/${link}`;
    
        notification.innerHTML = `
                                    <div class="profile-photo asp-rtio">
                                        <img 
                                            src="${ROOT}/images/${image}" 
                                            alt="Customer Image" 
                                            onerror="this.src='${ROOT}/images/Default/Notification.png'">
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

        if(this.reload_data_func) this.reload_data_func(type, ref_id);

        if (this.notificationIcon) {
            const messageToSave = {
                type: type,
                ref_id: ref_id,
                link: link,
                title: title,
                body: body
            }

            let notificationsTemp = JSON.parse(sessionStorage.getItem("notifications" + ws_id)) || [];

            notificationsTemp = notificationsTemp.filter(element => !(element.type === type && element.ref_id === ref_id));
            
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
        console.log(notification);
        if (!this.notifications.some(element => element.type === notification.type && element.ref_id === notification.ref_id)) return;
        console.log('deleting notification');
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
