<!-- <style>
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
</style>

<div id="chat-container">
    <div id="header">Welcome to POWERTTO</div>
    <div id="chatbox">
        <div id="chatlog"></div>
    </div>
    <div id="options">
        <button onclick="sendOption('I need some assistance')">I need some assistance</button>
        <button onclick="sendOption('What is POWERTTO?')">What is POWERTTO?</button>
    </div>

    <form id="chatForm" method="POST">
        <div id="userInput">
            <input type="hidden" id="sender" name="sender" value="<?= $_SESSION['loggedInUser']['userid']; ?>">
            <input type="hidden" id="receiver" name="receiver" value="admin">
            <input type="text" id="message" name="message" placeholder="Type your message here">
            <button type="button" onclick="sendMessage()">Send</button>
        </div>
    </form>
</div>
<button id="toggleButton" onclick="toggleChat()">💬</button>

<script>
    function fetchMessages() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_messages.php", true);
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    try {
                        var messages = JSON.parse(this.responseText);
                        console.log(messages); // Debugging output
                        var chatlog = document.getElementById("chatlog");
                        chatlog.innerHTML = '';

                        var currentUserId = document.getElementById("sender").value;

                        messages.forEach(function(message) {
                            var messageClass = message.sender === 'admin' ? 'admin' : (message.sender === currentUserId ? 'user' : 'other');
                            var messageHtml = `
                            <div class='chatMessage ${messageClass}'>
                                <div class='text'><strong>${message.sender}:</strong> ${message.message}</div>
                                <div class='hide-btn' onclick='hideMessage(this)'>Hide</div>
                            </div>`;
                            chatlog.innerHTML += messageHtml;
                        });

                        chatlog.scrollTop = chatlog.scrollHeight;
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                    }
                } else {
                    console.error('HTTP Error:', this.status);
                }
            }
        };
        xhr.send();
    }

    function sendMessage() {
        var message = document.getElementById("message").value;
        if (message === '') return;

        var sender = document.getElementById("sender").value;
        var receiver = document.getElementById("receiver").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "chatbot.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                fetchMessages(); // Refresh the messages after sending
            }
        };
        xhr.send("sender=" + encodeURIComponent(sender) + "&receiver=" + encodeURIComponent(receiver) + "&message=" + encodeURIComponent(message));

        document.getElementById("message").value = '';
    }

    function sendOption(option) {
        var sender = document.getElementById("sender").value;
        var receiver = document.getElementById("receiver").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "chatbot.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                fetchMessages(); // Refresh the messages after sending
            }
        };
        xhr.send("sender=" + encodeURIComponent(sender) + "&receiver=" + encodeURIComponent(receiver) + "&message=" + encodeURIComponent(option));
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

    // Fetch messages every 2 seconds
    setInterval(fetchMessages, 2000);

    // Fetch messages on page load
    fetchMessages();
</script> -->

<!-- Start of Tawk.to Script-->
<?php if (isset($_SESSION['loggedIn'])) :  ?>
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/669f474532dca6db2cb3ca95/1i3f2sqhe';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
<?php endif;  ?>
<!--End of Tawk.to Script -->



<footer>
    <div class="warning">

        <span>You must be 19 or over to play or claim a prize<br> 미성년자는 주문과 상금을 수령할 수 없으며, 허용되지 않는 주문은 취소될 수 있습니다.</span>
    </div>
    <div class="copy">

        Copyright(C) 파워또 <?php echo date("Y"); ?> all rights reserved.<br>


        The Power TTO's original logos, programs and images made on the this website have the original copyright & exclusive copyright.<br>
        Do not use it for commercial unauthorized use without permission.
    </div>
</footer>

</div>


</body>

</html>