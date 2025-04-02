@extends('layouts.master')

@section('title', 'Instagram Dashboard')

@section('css')
    <style>
        .chat-conversation {
            max-height: 630px;
            overflow-y: auto;
        }

        .chat-input-container {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: white;
            padding: 10px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999; 
        }

        .active-user {
            background-color: #0C768A;
            border: 0.2px solid #0C768A;
        }

        .chat-message {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 70%;
        }

        .message-sent {
            background-color: #dcf8c6;
            align-self: flex-end;
            text-align: right;
        }

        .message-received {
            background-color: #ffffff;
            align-self: flex-start;
            text-align: left;
        }

        .chat-message img {
            border-radius: 50%;
        }

        .custom-audio-container {
            background-color: #4E9DEF;
            padding: 10px;
            border-radius: 5px;
            width: fit-content;
            display: inline-block;
        }
        #chat-messages {
            padding: 0;
            margin: 0;
        }

        #chat-messages .message {
            max-width: 100%;
            padding: 10px;
            border-radius: 8px;
            position: relative;
        }

        #chat-messages .incoming {
            background-color: #f1f0f0;
            color: #000;
            border-top-left-radius: 0;
        }

        #chat-messages .outgoing {
            background-color: #007bff;
            color: #fff;
            border-top-right-radius: 0;
        }
        #chat-messages .incoming {
            background-color: #f1f0f0;
            color: #000;
            text-align: left;
            border-top-left-radius: 0;
        }

        #chat-messages .outgoing {
            background-color: #007bff;
            color: #fff;
            text-align: right;
            border-top-right-radius: 0;
        }


    </style>
@endsection

@section('page-title', 'Instagram Dashboard')

@section('body')
    <body data-sidebar="colored">
@endsection

@section('content')
    <div class="d-lg-flex mb-4">
        <!-- Left Sidebar -->
        <div class="chat-leftsidebar me-4">
            <div class="card mb-0">
                <div class="chat-leftsidebar-nav">
                    <ul class="nav nav-pills nav-justified bg-light-subtle">
                        <li class="nav-item">
                            <a href="{{ route('unique-chat-dashboard') }}" class="nav-link {{ request()->routeIs('unique-chat-dashboard') ? 'active' : '' }}">
                                <i class="fab fa-facebook"></i>
                                <span class="mt-2 d-none d-sm-block">Facebook</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('instagram-unique-chat-dashboard') }}" class="nav-link {{ request()->routeIs('instagram-unique-chat-dashboard') ? 'active' : '' }}">
                                <i class="fab fa-instagram"></i>
                                <span class="mt-2 d-none d-sm-block">Instagram</span>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </div>

            <div class="tab-content pt-4">
                <div class="tab-pane show active" id="chat">
                    <div>
                        <h5 class="font-size-14 mb-3">Users</h5>
                        <ul class="list-unstyled chat-list" data-simplebar id="chat-list" style="max-height: 500px;">
                            @foreach ($users as $lead)
                                
                                
                                <li id="chat-user-{{ $lead->id }}">
                                    <a href="#" class="mt-0 chat-user" 
                                        data-id="{{ $lead->id }}"
                                        data-name="{{ $lead->name }}" 
                                        data-conversation-id="{{ $lead->id }}" data-image="{{ asset('uploads/profile_pics/' . ($lead->profile_pic ?? asset('build/images/users/avatar-2.jpg'))) }}" >
                                        <div class="d-flex">
                                            <div class="user-img online align-self-center me-3">
                                                <img src="{{ asset('uploads/profile_pics/' . ($lead->profile_pic ?? asset('build/images/users/avatar-2.jpg'))) }}" 
                                                     class="img-fluid header-profile-user rounded-circle" 
                                                     alt="{{ $lead->name }} Profile Picture">
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">
                                                    {{ $lead->name }} 
                                                </h5>
                                                <p class="text-truncate mb-0">{{ $lead->email }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                            @if($users->isEmpty())
                                <p>No data found.</p>
                            @endif
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Container -->
        <div class="w-100 user-chat mt-4 mt-sm-0 card mb-0">
            <div class="card-body d-flex flex-column">
                <div class="pb-3 user-chat-border">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <h5 class="font-size-15 mb-1 text-truncate" id="chat-user-name">Select a user</h5>
                        </div>
                    </div>
                </div>

                <!-- Chat Conversation -->
                <div class="chat-conversation flex-grow-1 d-flex flex-column" id="chat-container" style="display: none;">
                    <ul class="list-unstyled mb-0 pe-3" data-simplebar
                        style="flex-grow: 1; max-height: calc(100vh - 260px);" id="chat-messages">
                    </ul>
                </div>

                <div id="loader" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!-- Message Input -->
                <div id="message-input-container" style="display: none; position: sticky; bottom: 0; background-color: white;">
                    <div class="px-lg-3">
                        <div class="pt-3">
                            <div class="row">
                                <div class="col">
                                    <div class="position-relative">
                                        <input type="text" class="form-control chat-input" placeholder="Enter Message..." id="body">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"
                                        id="send-message-btn">
                                        <span class="d-none d-sm-inline-block me-2">Send</span> 
                                        <i class="mdi mdi-send"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Initialize Pusher
    const pusher = new Pusher('ca3024112cfb52d49d71', {
        cluster: 'mt1',
        encrypted: true,  // Ensure the connection is secure
    });

    // Initialize current variables
    let currentUserId = null; // This will store the ID of the selected user
    let currentConversationId = null; // This will store the current conversation ID
    let currentConversationChannel = null; // To store the current conversation channel subscription

    // Listen for the "message.sent" event for all conversations
    const globalChannel = pusher.subscribe('chat-channel');
    globalChannel.bind('message.sent', function (data) {
        console.log('Global message received:', data);  // Log the message data received on the global channel
        if (data && data.message) {
            appendMessage(data.message);
        }
    });

    // Listen for conversation-specific messages
    function subscribeToConversation(conversationId) {
        // Unsubscribe from the previous conversation channel if it exists
        if (currentConversationChannel) {
            console.log(`Unsubscribing from previous channel: ${currentConversationChannel}`);
            pusher.unsubscribe(currentConversationChannel);
        }

        // Subscribe to the new conversation channel
        currentConversationChannel = 'conversation-' + conversationId;
        console.log(`Subscribing to new channel: ${currentConversationChannel}`);
        const conversationChannel = pusher.subscribe(currentConversationChannel);

        // Bind the "message.sent" event for the specific conversation
        conversationChannel.bind('message.sent', function (data) {
            console.log('Message in conversation received:', data);  // Log the message data for specific conversation
            if (data && data.message) {
                appendMessage(data.message);
            }
        });
    }

    // Function to append messages to the chat container
    // function appendMessage(message) {
    //     const messageList = document.getElementById('chat-messages');
    //     const messageItem = document.createElement('li');
    //     messageItem.classList.add('message');

    //     // Check if it's an outgoing or incoming message
    //     if (message.sender_id == {{ auth()->id() }}) { // Outgoing message
    //         messageItem.classList.add('outgoing');
    //     } else { // Incoming message
    //         messageItem.classList.add('incoming');
    //     }

    //     messageItem.textContent = message.message;
    //     messageList.appendChild(messageItem);

    //     // Scroll to the latest message
    //     messageItem.scrollIntoView({ behavior: 'smooth', block: 'end' });
    //     console.log(`Message appended: ${message.message}`);
    // }
//     function appendMessage(message, isConversationMessage) {
//     const messageList = document.getElementById('chat-messages');
//     const messageItem = document.createElement('li');

//     // Create the conversation list container
//     const conversationList = document.createElement('div');
//     conversationList.classList.add('conversation-list');

//     // Create the flex container for the message layout
//     const dFlex = document.createElement('div');
//     dFlex.classList.add('d-flex');
    
//     // Check if it's an outgoing or incoming message and set the alignment
//     if (message.sender_id == currentUserId) {
//         // For outgoing messages (right side)
//         dFlex.classList.add('justify-content-end');  // Align to the right
//         messageItem.classList.add('left');  // For outgoing messages (right side)
//     } else {
//         // For incoming messages (left side)
//         dFlex.classList.add('justify-content-start');  // Align to the left
//         messageItem.classList.add('right');  // For incoming messages (left side)
//     }

//     // Create the content section for the message text and timestamp
//     const flexGrow = document.createElement('div');
//     flexGrow.classList.add('flex-grow-1');

//     const ctextWrap = document.createElement('div');
//     ctextWrap.classList.add('ctext-wrap');

//     const ctextWrapContent = document.createElement('div');
//     ctextWrapContent.classList.add('ctext-wrap-content');

//     // Add the message text
//     const messageText = document.createElement('p');
//     messageText.classList.add('mb-0');
//     messageText.textContent = message.message;

//     // Add the timestamp
//     const chatTime = document.createElement('span');
//     chatTime.classList.add('chat-time', 'text-muted');
//     chatTime.textContent = message.timestamp;  // Assuming `timestamp` is in the message data

//     // Append message text and timestamp to content section
//     ctextWrapContent.appendChild(messageText);
//     ctextWrapContent.appendChild(chatTime);
//     ctextWrap.appendChild(ctextWrapContent);
//     flexGrow.appendChild(ctextWrap);
//     dFlex.appendChild(flexGrow);

//     // Create the avatar section
//     const chatAvatar = document.createElement('div');
//     chatAvatar.classList.add('chat-avatar');

//     // Set the avatar for sender (outgoing) or receiver (incoming)
//     const avatar = document.createElement('img');
//     if (message.sender_id == currentUserId) {
//         // Avatar for outgoing (current user)
//         avatar.src = message.sender_avatar || '/path/to/default/avatar.jpg';  // Fallback avatar
//         avatar.alt = message.sender_name || 'Sender Avatar';
//     } else {
//         // Avatar for incoming (other user)
//         avatar.src = message.receiver_avatar || '/path/to/default/avatar.jpg';  // Fallback avatar
//         avatar.alt = message.receiver_name || 'Receiver Avatar';
//     }

//     chatAvatar.appendChild(avatar);

//     // For outgoing messages, place avatar on the right, for incoming, left
//     if (message.sender_id == currentUserId) {
//         dFlex.appendChild(chatAvatar); // Avatar on the right for outgoing
//     } else {
//         dFlex.insertBefore(chatAvatar, flexGrow); // Avatar on the left for incoming
//     }

//     // Append all to the conversation list
//     conversationList.appendChild(dFlex);
//     messageItem.appendChild(conversationList);

//     // Append the message item to the message list
//     messageList.appendChild(messageItem);

//     // Scroll to the latest message
//     messageItem.scrollIntoView({ behavior: 'smooth', block: 'end' });
//     console.log(`Message appended: ${message.message}`);

//     // Scroll to the bottom for new messages, only if the user is not manually scrolling up
//     if (isConversationMessage) {
//         // If the user hasn't manually scrolled up, automatically scroll to the bottom
//         if (messageList.scrollHeight - messageList.clientHeight === messageList.scrollTop) {
//             // If we are already at the bottom, scroll down
//             messageList.scrollTop = messageList.scrollHeight;
//         }
//     }
// }

function appendMessage(message, isConversationMessage) {
    const messageList = document.getElementById('chat-messages');
    const messageItem = document.createElement('li');

    // Create the conversation list container
    const conversationList = document.createElement('div');
    conversationList.classList.add('conversation-list');

    // Create the flex container for the message layout
    const dFlex = document.createElement('div');
    dFlex.classList.add('d-flex');
    
    // Check if it's an outgoing or incoming message and set the alignment
    if (message.sender_id == currentUserId) {
        // For outgoing messages (right side)
        dFlex.classList.add('justify-content-end');  // Align to the right
        messageItem.classList.add('left');  // For outgoing messages (right side)
    } else {
        // For incoming messages (left side)
        dFlex.classList.add('justify-content-start');  // Align to the left
        messageItem.classList.add('right');  // For incoming messages (left side)
    }

    // Create the content section for the message text and timestamp
    const flexGrow = document.createElement('div');
    flexGrow.classList.add('flex-grow-1');

    const ctextWrap = document.createElement('div');
    ctextWrap.classList.add('ctext-wrap');

    const ctextWrapContent = document.createElement('div');
    ctextWrapContent.classList.add('ctext-wrap-content');

    // Add the message text
    const messageText = document.createElement('p');
    messageText.classList.add('mb-0');
    messageText.textContent = message.message;

    // Add the timestamp
    const chatTime = document.createElement('span');
    chatTime.classList.add('chat-time', 'text-muted');
    chatTime.textContent = message.timestamp;  // Assuming `timestamp` is in the message data

    // Append message text and timestamp to content section
    ctextWrapContent.appendChild(messageText);
    ctextWrapContent.appendChild(chatTime);
    ctextWrap.appendChild(ctextWrapContent);
    flexGrow.appendChild(ctextWrap);
    dFlex.appendChild(flexGrow);

    // Remove the avatar part
    // const chatAvatar = document.createElement('div');
    // chatAvatar.classList.add('chat-avatar');

    // const avatar = document.createElement('img');
    // if (message.sender_id == currentUserId) {
    //     avatar.src = message.sender_avatar || '/path/to/default/avatar.jpg';  // Fallback avatar
    //     avatar.alt = message.sender_name || 'Sender Avatar';
    // } else {
    //     avatar.src = message.receiver_avatar || '/path/to/default/avatar.jpg';  // Fallback avatar
    //     avatar.alt = message.receiver_name || 'Receiver Avatar';
    // }

    // chatAvatar.appendChild(avatar);

    // For outgoing messages, place avatar on the right, for incoming, left
    // if (message.sender_id == currentUserId) {
    //     dFlex.appendChild(chatAvatar); // Avatar on the right for outgoing
    // } else {
    //     dFlex.insertBefore(chatAvatar, flexGrow); // Avatar on the left for incoming
    // }

    // Append all to the conversation list
    conversationList.appendChild(dFlex);
    messageItem.appendChild(conversationList);

    // Append the message item to the message list
    messageList.appendChild(messageItem);

    // Scroll to the latest message
    messageItem.scrollIntoView({ behavior: 'smooth', block: 'end' });
    console.log(`Message appended: ${message.message}`);

    // Scroll to the bottom for new messages, only if the user is not manually scrolling up
    if (isConversationMessage) {
        // If the user hasn't manually scrolled up, automatically scroll to the bottom
        if (messageList.scrollHeight - messageList.clientHeight === messageList.scrollTop) {
            // If we are already at the bottom, scroll down
            messageList.scrollTop = messageList.scrollHeight;
        }
    }
}


    // Handle chat user selection and message fetching
    document.querySelectorAll('.chat-user').forEach(user => {
        user.addEventListener('click', function () {
            currentUserId = this.dataset.id; // Store selected user ID
            currentConversationId = this.dataset.conversationId; // Store selected conversation ID
            const currentUserName = this.dataset.name;

            document.getElementById('chat-user-name').textContent = currentUserName;

            // Show chat container and input field
            document.getElementById('chat-container').style.display = 'block';
            document.getElementById('message-input-container').style.display = 'block';

            // Clear previous messages and show loader
            document.getElementById('chat-messages').innerHTML = '';
            document.getElementById('loader').style.display = 'block';

            // Fetch previous conversation messages
            console.log(`Fetching messages for conversation ID: ${currentConversationId}`);
            fetch(`/unique-messages/${currentConversationId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loader').style.display = 'none';
                    console.log('Fetched previous messages:', data);  // Log the fetched messages
                    if (data.messages && data.messages.length > 0) {
                        data.messages.forEach(message => {
                            appendMessage(message);
                        });
                    } else {
                        const messageList = document.getElementById('chat-messages');
                        const noMessagesItem = document.createElement('li');
                        noMessagesItem.classList.add('chat-message');
                        noMessagesItem.textContent = 'No messages yet.';
                        messageList.appendChild(noMessagesItem);
                        console.log('No messages found.');
                    }
                })
                .catch(err => {
                    document.getElementById('loader').style.display = 'none';
                    console.error('Error fetching messages:', err);  // Log any error during message fetching
                });

            // Subscribe to the conversation channel for live updates
            subscribeToConversation(currentConversationId);
        });
    });

    // Send message to the selected user and conversation
    document.getElementById('send-message-btn').addEventListener('click', () => {
        const messageInput = document.getElementById('body');
        const message = messageInput.value.trim();

        if (!message || !currentUserId) {
            alert('Please select a user and enter a message!');
            return;
        }

        // Send the message to the server
        console.log('Sending message:', message);  // Log the message being sent
        fetch('/unique-send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                recipient_id: currentUserId,
                message: message,
                conversation_id: currentConversationId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Message send response:', data);  // Log the response after sending the message
            if (data.message === "Message sent successfully!") {
                appendMessage({
                    message: data.data.message,
                    sender_id: data.data.sender_id,
                });
                messageInput.value = ''; // Clear input
            } else {
                alert('Error sending message.');
            }
        })
        .catch(err => {
            console.error('Error sending message:', err);  // Log any error during message sending
            alert('Error sending message.');
        });
    });
</script>
@endsection


