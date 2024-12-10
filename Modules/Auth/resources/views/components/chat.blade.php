@props([
    'user_id',
    'author_id'
])

<div>
    <!-- component -->
    <div class="fixed bottom-0 right-0 mb-4 mr-4">
        <button id="open-chat"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Начать чат с оператором
        </button>
    </div>
    <div id="chat-container" class="hidden fixed bottom-16 right-4 w-96">
        <div class="bg-white shadow-md rounded-lg max-w-lg w-full">
            <div class="p-4 border-b bg-blue-500 text-white rounded-t-lg flex justify-between items-center">
                <p class="text-lg font-semibold">Продавец</p>
                <button id="close-chat"
                        class="text-gray-300 hover:text-gray-400 focus:outline-none focus:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="chatbox" class="p-4 h-80 overflow-y-auto">

            </div>
            <div class="p-4 border-t flex">
                <input id="user-input" type="text" placeholder="Введите сообщение"
                       class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="send-button"
                        class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">
                    Отправить
                </button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatbox = document.getElementById("chatbox");
            const chatContainer = document.getElementById("chat-container");
            const userInput = document.getElementById("user-input");
            const sendButton = document.getElementById("send-button");
            const openChatButton = document.getElementById("open-chat");
            const closeChatButton = document.getElementById("close-chat");

            const user_id = "{{ $user_id }}";
            const author_id = "{{ $author_id }}";

            const addUserMessage = (message) => {
                const messageElement = document.createElement("div");
                messageElement.classList.add("mb-2", "text-right");
                messageElement.innerHTML = `<p class="bg-blue-500 text-white rounded-lg py-2 px-4 inline-block">${message}</p>`;
                chatbox.appendChild(messageElement);
                chatbox.scrollTop = chatbox.scrollHeight;
            }

            sendButton.addEventListener("click", function () {
                const userMessage = userInput.value;
                if (userMessage.trim() !== "") {
                    fetch(`/chat/messages/${author_id}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        body: JSON.stringify({ message: userMessage }),
                    })
                        .then(response => response.json())
                        .then(message => {
                            addUserMessage(message.message);
                            userInput.value = "";
                        });
                    userInput.value = "";
                }
            });

            const addBotMessage = (message) => {
                const messageElement = document.createElement("div");
                messageElement.classList.add("mb-2");
                messageElement.innerHTML = `<p class="bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block">${message}</p>`;
                chatbox.appendChild(messageElement);
                chatbox.scrollTop = chatbox.scrollHeight;
            }

            const scrollToBottom = () => {
                chatContainer.scrollTo({
                    top: chatContainer.scrollHeight,
                    behavior: "smooth",
                });
            }

            const loadMessages = () => {
                fetch(`/chat/messages/${author_id}`)
                    .then(response => response.json())
                    .then(messages => {
                        messages.forEach((message) => {
                            if(message.sender_id == user_id) {
                                addUserMessage(message.message)
                            } else {
                                addBotMessage(message.message);
                            }
                            scrollToBottom();
                        })
                    });
            }

            window.Echo.private(`chat.${user_id}`)
                .listen("MessageSent", (response) => {
                    addBotMessage(response.message);
                });

            loadMessages();

            let isChatboxOpen = true;

            const toggleChatbox = () => {
                chatContainer.classList.toggle("hidden");
                isChatboxOpen = !isChatboxOpen;
            }

            openChatButton.addEventListener("click", toggleChatbox);

            closeChatButton.addEventListener("click", toggleChatbox);

            userInput.addEventListener("keyup", function (event) {
                if (event.key === "Enter") {
                    const userMessage = userInput.value;
                    addUserMessage(userMessage);
                    userInput.value = "";
                    sendButton.click();
                }
            });

            toggleChatbox();
        })
    </script>
</div>
