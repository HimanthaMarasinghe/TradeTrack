const chatInput = document.querySelector(".chat-input textarea");
const sendchatbtn = document.querySelector(".chat-input span");
const chatbox = document.querySelector(".chatbox");
const chatbottoggler = document.querySelector(".chatbot-toggler");
const chatbotclosebtn = document.querySelector(".close-btn");

let userMessage;
const API_KEY ="" 
const inputInitHeight = chatInput.scrollHeight;

const createchatLi = (message, className) => {
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", className);
    let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
    chatLi.innerHTML = chatContent;
    chatLi.querySelector("p").textContent = message;
     return chatLi;
}

const generateResponse = () => {
    const API_URL = "https://api.openai.com/v1/chat/completions";
    const messageElement = incomingchatLi.querySelector("p");

    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages: [{ role: "user", content: userMessage }],
        }) 
    }
    fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
        messageElement.textContent = data.choices[0].message.content;
    }).catch((error) => {
        messageElement.classList.add("error");
        messageElement.textContent ='Oops!';
        }).finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
        
    }



const handlechat = () => {
    userMessage = chatInput.value.trim();
    if(!userMessage) return;
    chatInput.value = "";
    chatInput.style.height = `${inputInitHeight}px`;
    // 
    chatbox.appendchild(createchatLi(userMessage, "outgoing"));
    chatbox.scrollTo(0, chatbox.scrollHeight);
    setTimeout(() => {

        const incomingchatLi = createchatLi("Thinking...", "incoming");
        chatbox.apppendchild(incomingchatLi);
        generateResponse(incomingchatLi);
    }, 600);
}

 chatInput.addEventListener ("input", () => {
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});

chatInput.addEventListener ("keydown", () => {
    if(e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
        e.preventDefault();
        handlechat();
    }
});
  
chatbottoggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
// chatbottoggler.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
sendchatbtn.addEventListener("click", handlechat);
