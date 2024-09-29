<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
    #chat-container {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 500px;
        max-width: 90%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        overflow: hidden;
        display: none;
        flex-direction: column;
        background-color: white;
    }

    #header {
        background-color: #383e6c;
        color: white;
        text-align: center;
        padding: 10px;
        font-size: 18px;
    }

    #chatbox {
        width: 100%;
        border-top: 1px solid #ccc;
        height: 400px;
        overflow-y: scroll;
        padding: 10px;
    }

    #options {
        width: 100%;
        display: flex;
        justify-content: space-around;
        background: #f9f9f9;
        border-top: 1px solid #ccc;
        padding: 10px;
    }

    #options button {
        padding: 10px;
        background-color: #383e6c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #userInput {
        width: 100%;
        display: flex;
        background: #fff;
        border-top: 1px solid #ccc;
        padding: 10px;
    }

    #userInput input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }

    #userInput button {
        padding: 10px;
        background-color: #383e6c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .chatMessage {
        display: flex;
        align-items: flex-start;
        margin: 10px 0;
    }

    .chatMessage.user {
        justify-content: flex-end;
    }

    .chatMessage.bot {
        justify-content: flex-start;
    }

    .chatMessage .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .chatMessage.user .avatar {
        order: 2;
        margin-left: 10px;
        margin-right: 0;
    }

    .chatMessage .text {
        max-width: 80%;
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 10px;
    }

    .chatMessage.user .text {
        background-color: #383e6c;
        color: white;
    }

    .hide-btn {
        cursor: pointer;
        font-size: 12px;
        color: red;
        padding-left: 10px;
    }

    #toggleButton {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #383e6c;
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    #toggleButton:hover {
        background-color: #0056b3;
    }

    /* Style for the inquiry form */
    #inquiryForm {
        display: none;
        flex-direction: column;
        padding: 10px;
    }

    #inquiryForm input, #inquiryForm textarea {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #inquiryForm button {
        margin: 10px;
        padding: 10px;
        background-color: #383e6c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <div id="chat-container">
        <div id="header">Welcome to POWERTTO</div>
        <div id="chatbox">
            <div id="chatlog"></div>
        </div>
        <div id="options">
            <button onclick="sendOption('I need some assistance')">I need some assistance</button>
            <button onclick="sendOption('What is POWERTTO?')">What is POWERTTO?</button>
            <button onclick="showInquiryForm()">Inquire</button>
        </div>
        <div id="userInput">
            <input type="text" id="message" placeholder="Type your message here">
            <button onclick="sendMessage()">Send</button>
        </div>
        <div id="inquiryForm">
            <input type="text" id="name" placeholder="Your Name">
            <input type="email" id="email" placeholder="Your Email">
            <textarea id="inquiryMessage" placeholder="Your Inquiry"></textarea>
            <button onclick="submitInquiry()">Submit Inquiry</button>
        </div>
    </div>
    <button id="toggleButton" onclick="toggleChat()">💬</button>

    <script>
        function sendMessage() {
            var message = document.getElementById("message").value;
            if (message === '') return;

            var chatlog = document.getElementById("chatlog");

            if (message.toLowerCase() === "i need some assistance") {
                var userMessageHtml = `
                    <div class='chatMessage user'>
                        <div class='text'><strong>You:</strong> ${message}</div>
                        <img src='./asset/images/user.jpg' class='avatar'>
                        <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                    </div>`;
                var botMessageHtml = `
                    <div class='chatMessage bot'>
                        <img src='./asset/images/bot.jpeg' class='avatar'>
                        <div class='text'><strong>Bot:</strong> Please contact administrator at 09193758842</div>
                        <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                    </div>`;
                chatlog.innerHTML += userMessageHtml;
                chatlog.innerHTML += botMessageHtml;
                document.getElementById("message").value = '';
                chatlog.scrollTop = chatlog.scrollHeight;
            } else {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "chatbot.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        var response = this.responseText;
                        var userMessageHtml = `
                            <div class='chatMessage user'>
                                <div class='text'><strong>You:</strong> ${message}</div>
                                <img src='./asset/images/user.jpg' class='avatar'>
                                <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                            </div>`;
                        var botMessageHtml = `
                            <div class='chatMessage bot'>
                                <img src='./asset/images/bot.jpeg' class='avatar'>
                                <div class='text'><strong>Bot:</strong> ${response}</div>
                                <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                            </div>`;
                        chatlog.innerHTML += userMessageHtml;
                        chatlog.innerHTML += botMessageHtml;
                        document.getElementById("message").value = '';
                        chatlog.scrollTop = chatlog.scrollHeight;
                    }
                };
                xhr.send("message=" + message);
            }
        }

        function sendOption(option) {
            var chatlog = document.getElementById("chatlog");

            var userMessageHtml = `
                <div class='chatMessage user'>
                    <div class='text'><strong>You:</strong> ${option}</div>
                    <img src='./asset/images/user.jpg' class='avatar'>
                    <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                </div>`;

            var botMessageHtml;
            if (option === "I need some assistance") {
                botMessageHtml = `
                    <div class='chatMessage bot'>
                        <img src='./asset/images/bot.jpeg' class='avatar'>
                        <div class='text'><strong>Bot:</strong> Please contact administrator at 0919-XXX-XXXX</div>
                        <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                    </div>`;
            } else if (option === "What is POWERTTO?") {
                botMessageHtml = `
                    <div class='chatMessage bot'>
                        <img src='./asset/images/bot.jpeg' class='avatar'>
                        <div class='text'><strong>Bot:</strong>POWER TTO 웹페이지를 방문하는 회원 및 방문자의 개인정보를 중요하게 생각합니다. POWER TTO는 고객의 개인정보를 보안이 유지된 시스템내에 안전하게 보관하도록 항상 노력을 합니다. 나아가서 당사가 수집하는 고객의 개인정보가 어떻게 쓰이며 어디에 제공되는지를 알려드리고 신뢰를 주기 위하여 개인정보보호정책을 아래와 같이 수립합니다. POWER TTO는  개인정보보호관련 법규를 준수합니다.</div>
                        <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                    </div>`;
            }

            chatlog.innerHTML += userMessageHtml;
            chatlog.innerHTML += botMessageHtml;
            chatlog.scrollTop = chatlog.scrollHeight;
        }

        function hideMessage(element) {
            var messageDiv = element.parentNode;
            messageDiv.style.display = 'none';
        }

        function toggleChat() {
            var chatContainer = document.getElementById("chat-container");
            if (chatContainer.style.display === "none" || chatContainer.style.display === "") {
                chatContainer.style.display = "flex";
            } else {
                chatContainer.style.display = "none";
            }
        }

        function showInquiryForm() {
            var inquiryForm = document.getElementById("inquiryForm");
            var options = document.getElementById("options");
            var userInput = document.getElementById("userInput");

            if (inquiryForm.style.display === "none" || inquiryForm.style.display === "") {
                inquiryForm.style.display = "flex";
                options.style.display = "none";
                userInput.style.display = "none";
            } else {
                inquiryForm.style.display = "none";
                options.style.display = "flex";
                userInput.style.display = "flex";
            }
        }

        function submitInquiry() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("inquiryMessage").value;

            if (name === '' || email === '' || message === '') {
                alert("All fields are required.");
                return;
            }

            // Display the user's inquiry in the chat log
            var chatlog = document.getElementById("chatlog");
            var userInquiryHtml = `
                <div class='chatMessage user'>
                    <div class='text'><strong>You (Inquiry):</strong><br> Name: ${name}<br> Email: ${email}<br> Message: ${message}</div>
                    <img src='./asset/images/user.jpg' class='avatar'>
                    <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                </div>`;
            chatlog.innerHTML += userInquiryHtml;

            // Reset the form fields
            document.getElementById("name").value = '';
            document.getElementById("email").value = '';
            document.getElementById("inquiryMessage").value = '';

            var botReplyHtml = `
                <div class='chatMessage bot'>
                    <img src='./asset/images/bot.jpeg' class='avatar'>
                    <div class='text'><strong>Bot:</strong> Thank you for your inquiry. We will get back to you shortly.</div>
                    <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                </div>`;
            chatlog.innerHTML += botReplyHtml;
            chatlog.scrollTop = chatlog.scrollHeight;

            // Hide the inquiry form and show options and user input again
            var inquiryForm = document.getElementById("inquiryForm");
            var options = document.getElementById("options");
            var userInput = document.getElementById("userInput");
            inquiryForm.style.display = "none";
            options.style.display = "flex";
            userInput.style.display = "flex";
        }
    </script>

</body>

</html>
