export default class Chat {
    constructor(firstPerson ,secondPerson, notification, link) {
        this.chatInput = document.querySelector(".chat-input textarea");
        this.sendChatBtn = document.getElementById("send-btn");
        this.chatBox = document.querySelector(".chatbox");
        this.chatBotToggler = document.querySelector(".chatbot-toggler");
        this.chatBotCloseBtn = document.querySelector(".close-btn");
        this.chatBackDrop = document.getElementById('chatBackDrop');
        this.inputInitHeight = this.chatInput.scrollHeight;
        this.userMessage = "";

        this.secondPerson = secondPerson;
        this.firstPerson = firstPerson;
        this.notification = notification;
        this.link = link;

        this.addEventListeners();
        this.chatBox.scrollTo(0, this.chatBox.scrollHeight);
    }

    createChatLi(message, className) {
        const chatLi = document.createElement("li");
        chatLi.classList.add("chat", className);
        chatLi.innerHTML = `<p>${message}</p>`;
        return chatLi;
    }

    handleChat = () => {
        this.userMessage = this.chatInput.value.trim();
        if (!this.userMessage) return;

        fetch(`${ROOT}/LogedInUserCommon/sendChat/${this.secondPerson}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ 
                message: this.userMessage,
                link: `${this.link}/${this.firstPerson}`,
            })
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                this.chatInput.value = "";
                this.chatInput.style.height = `${this.inputInitHeight}px`;
                this.chatBox.appendChild(this.createChatLi(this.userMessage, "outgoing"));
                this.chatBox.scrollTo(0, this.chatBox.scrollHeight);
            } else {
                console.error("Error sending message:", data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
    }

    addEventListeners() {
        this.chatInput.addEventListener("input", () => {
            this.chatInput.style.height = `${this.inputInitHeight}px`;
            this.chatInput.style.height = `${this.chatInput.scrollHeight}px`;
        });

        this.chatInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
                e.preventDefault();
                this.handleChat();
            }
        });

        this.chatBackDrop.addEventListener("click", () => {
            this.notification.handleChat = false;
            this.chatBackDrop.classList.add("hidden");
            document.body.classList.remove("show-chatbot");
        });

        this.chatBotToggler.addEventListener("click", () => {
            this.notification.handleChat = true;
            this.chatBackDrop.classList.remove("hidden");
            document.body.classList.add("show-chatbot");
            this.chatInput.focus();
        });

        this.sendChatBtn.addEventListener("click", this.handleChat);
    }
}
