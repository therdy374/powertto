<?php
// require "./config/function.php";
// require 'authentication.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Chat Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #chat-container {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
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

        .chatMessage.admin {
            justify-content: flex-end;
        }

        .chatMessage.user {
            justify-content: flex-start;
        }

        .chatMessage .text {
            max-width: 80%;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 10px;
        }

        .chatMessage.admin .text {
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
    </style>
</head>

<body>
    <div id="chat-container">
        <div id="header">Admin Chat Interface</div>
        <div id="chatbox">
            <div id="admin-chatlog"></div>
        </div>
        <form id="adminChatForm" onsubmit="sendAdminMessage(); return false;">
            <input type="hidden" id="adminSender" name="adminSender" value="admin">
            <input type="hidden" id="adminReceiver" name="adminReceiver" value="">
            <div id="userInput">
                <input type="text" id="adminMessage" name="adminMessage" placeholder="Type your reply here">
                <button type="submit">Send</button>
            </div>
        </form>
    </div>

    <button id="toggleButton" onclick="toggleChat()">&#x1F4AC;</button>

    <script>
        function fetchMessages() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_messages.php", true);
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        var messages = JSON.parse(this.responseText);
                        var chatlog = document.getElementById("admin-chatlog");
                        chatlog.innerHTML = '';

                        messages.forEach(function(message) {
                            var messageHtml = `
                            <div class='chatMessage ${message.sender === 'admin' ? 'admin' : 'user'}'>
                                <div class='text'><strong>${message.sender}:</strong> ${message.message}</div>
                                <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                            </div>`;
                            chatlog.innerHTML += messageHtml;
                        });

                        chatlog.scrollTop = chatlog.scrollHeight;
                    } else {
                        console.error("Failed to fetch messages: " + this.statusText);
                    }
                }
            };
            xhr.onerror = function() {
                console.error("Request failed");
            };
            xhr.send();
        }

        function sendAdminMessage() {
            var message = document.getElementById("adminMessage").value.trim();
            if (message === '') return;

            var chatlog = document.getElementById("admin-chatlog");

            var adminMessageHtml = `
            <div class='chatMessage admin'>
                <div class='text'><strong>Admin:</strong> ${message}</div>
                <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
            </div>`;
            chatlog.innerHTML += adminMessageHtml;
            document.getElementById("adminMessage").value = '';
            chatlog.scrollTop = chatlog.scrollHeight;

            var sender = document.getElementById("adminSender").value;
            var receiver = document.getElementById("adminReceiver").value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "chatbot.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 200) {
                        fetchMessages();
                    } else {
                        console.error("Failed to send message: " + this.statusText);
                    }
                }
            };
            xhr.onerror = function() {
                console.error("Request failed");
            };
            xhr.send("sender=" + encodeURIComponent(sender) + "&receiver=" + encodeURIComponent(receiver) + "&message=" + encodeURIComponent(message));
        }

        function hideMessage(element) {
            var messageDiv = element.parentNode;
            messageDiv.style.display = 'none';
        }

        function toggleChat() {
            var chatContainer = document.getElementById("chat-container");
            if (chatContainer.style.display === 'none' || chatContainer.style.display === '') {
                chatContainer.style.display = 'flex';
            } else {
                chatContainer.style.display = 'none';
            }
        }

        // Fetch messages every 2 seconds
        setInterval(fetchMessages, 2000);
    </script>
</body>

</html>
