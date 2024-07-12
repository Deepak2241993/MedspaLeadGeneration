@extends('layouts.master')

@section('title')
    Leads
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
    </style>
@endsection

@section('page-title')
    Leads
@endsection

@section('body')
    <body data-sidebar="colored">
@endsection

@section('content')
    <div class="d-lg-flex mb-4">
        <div class="chat-leftsidebar me-4">
            <div class="card mb-0">
                <div class="chat-leftsidebar-nav">
                    <ul class="nav nav-pills nav-justified bg-light-subtle">
                        <li class="nav-item">
                            <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                <i class="ri-message-2-line font-size-20"></i>
                                <span class="mt-2 d-none d-sm-block">Chat</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content pt-4">
                <div class="tab-pane show active" id="chat">
                    <div>
                        <h5 class="font-size-14 mb-3">Recent</h5>
                        @forelse ($leaddata as $lead)
                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 500px;">
                                <li>
                                    <a href="#" class="mt-0 chat-user" data-id="{{ $lead['_id'] }}" data-name="{{ $lead['first_name'] }} {{ $lead['last_name'] }}" data-phone="{{ $lead['phone'] }}">
                                        <div class="d-flex">
                                            <div class="user-img online align-self-center me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-xs" alt="avatar-2">
                                                <span class="user-status"></span>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">{{ $lead['first_name'] }} {{ $lead['last_name'] }}</h5>
                                                <p class="text-truncate mb-0">{{ $lead['phone'] }}</p>
                                            </div>
                                            <div class="font-size-11">04 min</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        @empty
                            <p>No data found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 user-chat mt-4 mt-sm-0 card mb-0">
            <div class="card-body">
                <div class="pb-3 user-chat-border">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <h5 class="font-size-15 mb-1 text-truncate" id="chat-user-name">Select a user</h5>
                            {{-- <p class="text-muted text-truncate mb-0">
                                <i class="mdi mdi-circle text-primary font-size-10 align-middle me-1"></i> Active now
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="chat-conversation py-3">
                    <ul class="list-unstyled mb-0 pe-3" data-simplebar style="max-height: 630px;" id="chat-messages">
                        <!-- Messages will be dynamically loaded here -->
                    </ul>
                </div>
                <div class="px-lg-3">
                    <div class="pt-3">
                        <div class="row">
                            <div class="col">
                                <div class="position-relative">
                                    <input type="text" class="form-control chat-input" placeholder="Enter Message..." id="body">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light" id="send-message-btn">
                                    <span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatUsers = document.querySelectorAll('.chat-user');
            const chatUserName = document.getElementById('chat-user-name');
            const chatMessages = document.getElementById('chat-messages');
            let currentUserPhone = null;

            chatUsers.forEach(user => {
                user.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get user data
                    const userName = this.dataset.name;
                    currentUserPhone = this.dataset.phone;
                    const userId = this.dataset.id;

                    // alert(currentUserPhone);
                    // Update chat window
                    chatUserName.textContent = userName;

                    // Fetch and display messages for this user (using AJAX or Fetch API)
                    fetch(`/get-messages/${currentUserPhone}`)
                        .then(response => response.json())
                        .then(messages => {
                            chatMessages.innerHTML = '';
                            messages.forEach(message => {
                                const messageClass = message.direction === 'outgoing' ? 'right' : '';
                                const avatarSrc = message.direction === 'outgoing' ? '{{ URL::asset('build/images/users/avatar-2.jpg') }}' : '{{ URL::asset('build/images/users/avatar-4.jpg') }}';
                                const messageHtml = `
                                    <li class="${messageClass}">
                                        <div class="conversation-list">
                                            <div class="d-flex">
                                                ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar-2"></div>` : ''}
                                                <div class="flex-grow-1">
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0">${message.body}</p>
                                                            <span class="chat-time text-muted">${message.formatted_created_at}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar-2"></div>` : ''}
                                            </div>
                                        </div>
                                    </li>
                                `;
                                chatMessages.innerHTML += messageHtml;
                            });
                        })
                        .catch(error => console.error('Error fetching messages:', error));
                });
            });

            const sendMessageBtn = document.getElementById('send-message-btn');
            sendMessageBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const body = document.getElementById('body').value;

                if (!currentUserPhone || !body) {
                    return;
                }

                fetch('/messages/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        to: currentUserPhone,
                        body: body
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Append the sent message to the chat
                        const messageHtml = `
                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">${body}</p>
                                                    <span class="chat-time text-muted">${new Date().toLocaleString()}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar-2">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                        chatMessages.innerHTML += messageHtml;
                        document.getElementById('body').value = '';
                    } else {
                        // Show SweetAlert error message if sending failed
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to send message!'
                        });
                        console.error('Error sending message:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    // Show SweetAlert error message if an error occurred
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error sending message. Please try again later!'
                    });
                });
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatUsers = document.querySelectorAll('.chat-user');
            const chatUserName = document.getElementById('chat-user-name');
            const chatMessages = document.getElementById('chat-messages');
            let currentUserPhone = null;

            chatUsers.forEach(user => {
                user.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get user data
                    const userName = this.dataset.name;
                    currentUserPhone = this.dataset.phone;

                    // Update chat window
                    chatUserName.textContent = userName;

                    // Fetch and display messages for this user
                    fetch(`/get-messages/${currentUserPhone}`)
                        .then(response => response.json())
                        .then(messages => {
                            chatMessages.innerHTML = '';
                            messages.forEach(message => {
                                if (message.type === 'message') {
                                    const messageClass = message.direction === 'outgoing' ? 'right' : '';
                                    const avatarSrc = message.direction === 'outgoing' ? '{{ URL::asset('build/images/users/avatar-2.jpg') }}' : '{{ URL::asset('build/images/users/avatar-4.jpg') }}';
                                    const messageHtml = `
                                        <li class="${messageClass}">
                                            <div class="conversation-list">
                                                <div class="d-flex">
                                                    ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar-2"></div>` : ''}
                                                    <div class="flex-grow-1">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0">${message.body}</p>
                                                                <span class="chat-time text-muted">${message.formatted_created_at}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar-2"></div>` : ''}
                                                </div>
                                            </div>
                                        </li>
                                    `;
                                    chatMessages.innerHTML += messageHtml;
                                } else if (message.type === 'call') {
                                    const callHtml = `
                                        <li class="call-record">
                                            <div class="conversation-list">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0">Call from ${message.from} to ${message.to}</p>
                                                                <p class="mb-0">Duration: ${message.duration}</p>
                                                                <span class="chat-time text-muted">${message.formatted_created_at}</span>
                                                                ${message.recording_url ? `
                                                                    <audio controls>
                                                                        <source src="${message.recording_url}.mp3" type="audio/mpeg">
                                                                        Your browser does not support the audio element.
                                                                    </audio>
                                                                    <a href="${message.download_url}" class="btn btn-primary btn-sm" download>Download</a>
                                                                ` : '<p>No recording available</p>'}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    `;
                                    chatMessages.innerHTML += callHtml;
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching messages:', error));
                });
            });

            const sendMessageBtn = document.getElementById('send-message-btn');
            sendMessageBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const body = document.getElementById('body').value;

                if (!currentUserPhone || !body) {
                    return;
                }

                fetch('/messages/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        to: currentUserPhone,
                        body: body
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Append the sent message to the chat
                        const messageHtml = `
                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">${body}</p>
                                                    <span class="chat-time text-muted">${new Date().toLocaleString()}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-avatar">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar-2">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                        chatMessages.innerHTML += messageHtml;
                        document.getElementById('body').value = '';
                    } else {
                        // Show SweetAlert error message if sending failed
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to send message!'
                        });
                        console.error('Error sending message:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    // Show SweetAlert error message if an error occurred
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error sending message. Please try again later!'
                    });
                });
            });
        });
        </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('0feef8e7d718d1f20b1f', {
                cluster: 'ap2',
                encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                // Append received message to the chat
                const messageHtml = `
                    <li>
                        <div class="conversation-list">
                            <div class="d-flex">
                                <div class="chat-avatar"><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="avatar-2"></div>
                                <div class="flex-grow-1">
                                    <div class="ctext-wrap">
                                        <div class="ctext-wrap-content">
                                            <p class="mb-0">${data.message}</p>
                                            <span class="chat-time text-muted">${new Date().toLocaleString()}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
                document.getElementById('chat-messages').innerHTML += messageHtml;
            });
        });
    </script>
    {{-- <script>
         function scrollChatToBottom() {
        var chatConversation = document.getElementById('chat-conversation');
        chatConversation.scrollTop = chatConversation.scrollHeight;
    }

    // Call scroll function after the page loads or new messages are added
    document.addEventListener('DOMContentLoaded', function() {
        scrollChatToBottom();
    });
    </script> --}}
@endsection
