@extends('layouts.master')

@section('title')
    Message Dashboad
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
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
            /* Ensures the loader is on top of other elements */
        }
    </style>
@endsection

@section('page-title')
    Message Dashboad
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
                            <ul class="list-unstyled chat-list" data-simplebar id="chat-list" style="max-height: 500px;">
                                @forelse ($leaddata as $lead)
                                    <li>
                                        <a href="#" class="mt-0 chat-user" data-id="{{ $lead['_id'] }}"
                                            data-name="{{ $lead['first_name'] }} {{ $lead['last_name'] }}"
                                            data-phone="{{ $lead['phone'] }}">
                                            <div class="d-flex">
                                                <div class="user-img online align-self-center me-3">
                                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                        class="rounded-circle avatar-xs" alt="avatar-2">
                                                    <span class="user-status"></span>
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">{{ $lead['first_name'] }}
                                                        {{ $lead['last_name'] }}</h5>
                                                    <p class="text-truncate mb-0">{{ $lead['phone'] }}</p>
                                                </div>
                                                <div class="font-size-11">04 min</div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <p>No data found.</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
                    <div class="chat-conversation flex-grow-1 d-flex flex-column" id="chat-container"
                        style="display: none; overflow-y: auto;">
                        <ul class="list-unstyled mb-0 pe-3" data-simplebar
                            style="flex-grow: 1; max-height: calc(100vh - 260px);" id="chat-messages">
                            <!-- Messages will be dynamically loaded here -->
                        </ul>
                    </div>

                    <!-- No Conversation Placeholder -->
                    {{-- <div id="no-conversation" class="d-flex justify-content-center align-items-center flex-grow-1 text-muted" style="min-height: 630px;">
                    No conversation
                </div> --}}
                    <div id="loader" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>


                    <!-- Message Input and Send Button -->
                    <div class="mt-auto" id="message-input-container"
                        style="display: none; position: sticky; bottom: 0; background-color: white;">
                        <div class="px-lg-3">
                            <div class="pt-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="position-relative">
                                            <input type="text" class="form-control chat-input"
                                                placeholder="Enter Message..." id="body">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit"
                                            class="btn btn-primary chat-send w-md waves-effect waves-light"
                                            id="send-message-btn">
                                            <span class="d-none d-sm-inline-block me-2">Send</span> <i
                                                class="mdi mdi-send"></i>
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
       

        <script>
            let page = 1; // Track current page or offset
            const chatList = document.getElementById('chat-list');

            chatList.addEventListener('scroll', function() {
                if (chatList.scrollTop + chatList.clientHeight >= chatList.scrollHeight) {
                    loadMoreData(); // Load more data when user reaches the bottom
                }
            });

            function loadMoreData() {
                page++;
                fetch(`/load-more-leads?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        data.leads.forEach(lead => {
                            const li = document.createElement('li');
                            li.innerHTML = `
                        <a href="#" class="mt-0 chat-user" data-id="${lead._id}" data-name="${lead.first_name} ${lead.last_name}" data-phone="${lead.phone}">
                            <div class="d-flex">
                                <div class="user-img online align-self-center me-3">
                                    <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-xs" alt="avatar-2">
                                    <span class="user-status"></span>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-14 mb-1">${lead.first_name} ${lead.last_name}</h5>
                                    <p class="text-truncate mb-0">${lead.phone}</p>
                                </div>
                                <div class="font-size-11">04 min</div>
                            </div>
                        </a>
                    `;
                            chatList.appendChild(li);
                        });
                    })
                    .catch(error => console.log('Error loading more leads:', error));
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>

        <script>
        //     document.addEventListener('DOMContentLoaded', function() {
        //     const chatUsers = document.querySelectorAll('.chat-user');
        //     const chatUserName = document.getElementById('chat-user-name');
        //     const chatMessages = document.getElementById('chat-messages');
        //     const messageInputContainer = document.getElementById('message-input-container');
        //     const loader = document.getElementById('loader');
        //     let currentUserPhone = null;

        //     chatUsers.forEach(user => {
        //         user.addEventListener('click', function(e) {
        //             e.preventDefault();

        //             // Get user data
        //             const userName = this.dataset.name;
        //             currentUserPhone = this.dataset.phone;

        //             // Update chat window
        //             chatUserName.textContent = userName;

        //             // Show chat container and input area, hide "No conversation" message
        //             chatMessages.innerHTML = ''; // Clear previous messages
        //             chatMessages.parentElement.style.display = 'block';
        //             messageInputContainer.style.display = 'block';

        //             // Show loader
        //             loader.style.display = 'block';

        //             // Fetch and display messages and calls for this user
        //             fetch(`/get-messages/${currentUserPhone}`)
        //                 .then(response => response.json())
        //                 .then(items => {
        //                     console.log('Fetched items:', items); // Log fetched items

        //                     chatMessages.innerHTML = '';

        //                     // Sort items by time
        //                     items.sort((a, b) => new Date(a.formatted_created_at) - new Date(b.formatted_created_at));

        //                     // Display sorted items
        //                     items.forEach(item => {
        //                         if (item.type === 'message') {
        //                             const createdAt = item.formatted_created_at || item.created_at;
        //                             const formattedDate = new Date(createdAt).toLocaleString();
        //                             const messageClass = item.direction === 'incoming' ? 'right' : '';
        //                             const avatarSrc = item.direction === 'incoming' ?
        //                                 '{{ URL::asset('build/images/users/avatar-2.jpg') }}' :
        //                                 '{{ URL::asset('build/images/users/avatar-4.jpg') }}';
        //                             const messageHtml = `
        //                                 <li class="${messageClass}">
        //                                     <div class="conversation-list">
        //                                         <div class="d-flex">
        //                                             ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
        //                                             <div class="flex-grow-1">
        //                                                 <div class="ctext-wrap">
        //                                                     <div class="ctext-wrap-content">
        //                                                         <p class="mb-0">${item.body}</p>
        //                                                         <span class="chat-time text-muted">${formattedDate}</span>
        //                                                     </div>
        //                                                 </div>
        //                                             </div>
        //                                             ${messageClass === 'right' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
        //                                         </div>
        //                                     </div>
        //                                 </li>
        //                             `;
        //                             chatMessages.insertAdjacentHTML('afterbegin', messageHtml);
        //                         } else if (item.type === 'call') {
        //                             const callHtml = `
        //                                 <li class="call-record">
        //                                     <div class="conversation-list">
        //                                         <div class="d-flex">
        //                                             <div class="flex-grow-1">
        //                                                 <div class="ctext-wrap">
        //                                                     <div class="ctext-wrap-content">
        //                                                         <p class="mb-0">Call from ${item.from} to ${item.to}</p>
        //                                                         <p class="mb-0">Duration: ${item.duration}</p>
        //                                                         <span class="chat-time text-muted">${item.formatted_created_at}</span>
        //                                                         ${item.recording_url ? `
        //                                                             <audio controls>
        //                                                                 <source src="${item.recording_url}.mp3" type="audio/mpeg">
        //                                                                 Your browser does not support the audio element.
        //                                                             </audio>
        //                                                             <a href="${item.download_url}" class="btn btn-primary btn-sm" download>Download</a>
        //                                                         ` : '<p>No recording available</p>'}
        //                                                     </div>
        //                                                 </div>
        //                                             </div>
        //                                         </div>
        //                                     </div>
        //                                 </li>
        //                             `;
        //                             chatMessages.insertAdjacentHTML('afterbegin', callHtml);
        //                         }
        //                     });

        //                     // Scroll to the bottom of the chat
        //                     const chatContainer = chatMessages.parentElement;
        //                     chatContainer.scrollTop = chatContainer.scrollHeight;

        //                     // Hide loader after data is loaded
        //                     loader.style.display = 'none';
        //                 })
        //                 .catch(error => {
        //                     console.error('Error fetching messages and calls:', error);

        //                     // Hide loader even if there's an error
        //                     loader.style.display = 'none';
        //                 });
        //         });
        //     });

        //     const sendMessageBtn = document.getElementById('send-message-btn');
        //     sendMessageBtn.addEventListener('click', function(e) {
        //         e.preventDefault();

        //         const body = document.getElementById('body').value;

        //         if (!currentUserPhone || !body) {
        //             return;
        //         }

        //         fetch('/messages/send', {
        //                 method: 'POST',
        //                 headers: {
        //                     'Content-Type': 'application/json',
        //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //                 },
        //                 body: JSON.stringify({
        //                     to: currentUserPhone,
        //                     body: body
        //                 })
        //             })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.success) {
        //                     // Append the sent message to the chat
        //                     const messageHtml = `
        //                         <li class="right">
        //                             <div class="conversation-list">
        //                                 <div class="d-flex">
        //                                     <div class="flex-grow-1">
        //                                         <div class="ctext-wrap">
        //                                             <div class="ctext-wrap-content">
        //                                                 <p class="mb-0">${body}</p>
        //                                                 <span class="chat-time text-muted">${new Date().toLocaleString()}</span>
        //                                             </div>
        //                                         </div>
        //                                     </div>
        //                                     <div class="chat-avatar">
        //                                         <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar">
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         </li>
        //                     `;
        //                     chatMessages.insertAdjacentHTML('beforeend', messageHtml);
        //                     document.getElementById('body').value = '';

        //                     // Scroll to the bottom of the chat
        //                     const chatContainer = chatMessages.parentElement;
        //                     chatContainer.scrollTop = chatContainer.scrollHeight;
        //                 } else {
        //                     // Show SweetAlert error message if sending failed
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Oops...',
        //                         text: 'Failed to send message!'
        //                     });
        //                     console.error('Error sending message:', data.error);
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Error sending message:', error);
        //                 // Show SweetAlert error message if an error occurred
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Oops...',
        //                     text: 'Error sending message. Please try again later!'
        //                 });
        //             });
        //     });
        // });
//         document.addEventListener('DOMContentLoaded', function() {
//     let currentUserPhone = null;
//     let currentPage = 1;
//     let hasMore = true;
//     let isLoading = false;

//     const chatUsers = document.querySelectorAll('.chat-user');
//     const chatUserName = document.getElementById('chat-user-name');
//     const chatMessages = document.getElementById('chat-messages');
//     const messageInputContainer = document.getElementById('message-input-container');
//     const loader = document.getElementById('loader');
//     const chatContainer = chatMessages.parentElement;

//     // Fetch messages function
//     function fetchMessages(page = 1, append = false) {
//         if (isLoading) return;
//         isLoading = true;
//         loader.style.display = 'block';

//         fetch(`/get-messages/${currentUserPhone}?page=${page}`)
//             .then(response => response.json())
//             .then(result => {
//                 console.log('Fetched items:', result);

//                 const items = result.data;
//                 hasMore = result.has_more;

//                 if (!append) {
//                     chatMessages.innerHTML = ''; // Clear previous messages if not appending
//                 }

//                 // Sort items by time (ascending order)
//                 items.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));

//                 // Display sorted items
//                 items.forEach(item => {
//                     const formattedDate = new Date(item.created_at).toLocaleString();
//                     let messageHtml = '';

//                     if (item.type === 'message') {
//                         const messageClass = item.direction === 'incoming' ? 'right' : '';
//                         const avatarSrc = item.direction === 'incoming' ?
//                             '{{ URL::asset('build/images/users/avatar-2.jpg') }}' :
//                             '{{ URL::asset('build/images/users/avatar-4.jpg') }}';

//                         messageHtml = `
//                             <li class="${messageClass}">
//                                 <div class="conversation-list">
//                                     <div class="d-flex">
//                                         ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
//                                         <div class="flex-grow-1">
//                                             <div class="ctext-wrap">
//                                                 <div class="ctext-wrap-content">
//                                                     <p class="mb-0">${item.body}</p>
//                                                     <span class="chat-time text-muted">${formattedDate}</span>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                         ${messageClass === 'right' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
//                                     </div>
//                                 </div>
//                             </li>
//                         `;
//                     } else if (item.type === 'call') {
//                         messageHtml = `
//                             <li class="call-record">
//                                 <div class="conversation-list">
//                                     <div class="d-flex">
//                                         <div class="flex-grow-1">
//                                             <div class="ctext-wrap">
//                                                 <div class="ctext-wrap-content">
//                                                     <p class="mb-0">Call from ${item.from} to ${item.to}</p>
//                                                     <p class="mb-0">Duration: ${item.duration}</p>
//                                                     <span class="chat-time text-muted">${formattedDate}</span>
//                                                     ${item.recording_url ? `
//                                                         <audio controls>
//                                                             <source src="${item.recording_url}" type="audio/mpeg">
//                                                             Your browser does not support the audio element.
//                                                         </audio>
//                                                         <a href="${item.recording_url}" class="btn btn-primary btn-sm" download>Download</a>
//                                                     ` : '<p>No recording available</p>'}
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </li>
//                         `;
//                     }

//                     chatMessages.insertAdjacentHTML('beforeend', messageHtml);
//                 });

//                 // Scroll to the bottom of the chat only if this is the first page
//                 if (page === 1) {
//                     chatContainer.scrollTop = chatContainer.scrollHeight;
//                 }

//                 isLoading = false;
//                 loader.style.display = 'none';
//             })
//             .catch(error => {
//                 console.error('Error fetching messages and calls:', error);
//                 isLoading = false;
//                 loader.style.display = 'none';
//             });
//     }

//     // Add event listeners for chat users
//     chatUsers.forEach(user => {
//         user.addEventListener('click', function(e) {
//             e.preventDefault();

//             // Get user data
//             const userName = this.dataset.name;
//             currentUserPhone = this.dataset.phone;

//             // Update chat window
//             chatUserName.textContent = userName;
//             messageInputContainer.style.display = 'block';
//             currentPage = 1;
//             hasMore = true;

//             // Fetch the first page of messages
//             fetchMessages(currentPage);
//         });
//     });

//     // Infinite scroll handling
//     chatContainer.addEventListener('scroll', function() {
//         if (chatContainer.scrollTop === 0 && hasMore && !isLoading) {
//             currentPage++;
//             fetchMessages(currentPage, true);
//         }
//     });

//     // Send message logic remains unchanged
//     const sendMessageBtn = document.getElementById('send-message-btn');
//     sendMessageBtn.addEventListener('click', function(e) {
//         e.preventDefault();

//         const body = document.getElementById('body').value;

//         if (!currentUserPhone || !body) {
//             return;
//         }

//         fetch('/messages/send', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             },
//             body: JSON.stringify({
//                 to: currentUserPhone,
//                 body: body
//             })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 const messageHtml = `
//                     <li class="right">
//                         <div class="conversation-list">
//                             <div class="d-flex">
//                                 <div class="flex-grow-1">
//                                     <div class="ctext-wrap">
//                                         <div class="ctext-wrap-content">
//                                             <p class="mb-0">${body}</p>
//                                             <span class="chat-time text-muted">${new Date().toLocaleString()}</span>
//                                         </div>
//                                     </div>
//                                 </div>
//                                 <div class="chat-avatar">
//                                     <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar">
//                                 </div>
//                             </div>
//                         </div>
//                     </li>
//                 `;
//                 chatMessages.insertAdjacentHTML('beforeend', messageHtml);
//                 document.getElementById('body').value = '';

//                 chatContainer.scrollTop = chatContainer.scrollHeight;
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Failed to send message!'
//                 });
//                 console.error('Error sending message:', data.error);
//             }
//         })
//         .catch(error => {
//             console.error('Error sending message:', error);
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Error sending message. Please try again later!'
//             });
//         });
//     });
// });
// correct code 
// document.addEventListener('DOMContentLoaded', function() {
//     let currentUserPhone = null;
//     let currentPage = 1;
//     let hasMore = true;
//     let isLoading = false;

//     const chatUsers = document.querySelectorAll('.chat-user');
//     const chatUserName = document.getElementById('chat-user-name');
//     const chatMessages = document.getElementById('chat-messages');
//     const messageInputContainer = document.getElementById('message-input-container');
//     const loader = document.getElementById('loader');
//     const chatContainer = chatMessages.parentElement;

//     // Fetch messages function
//     function fetchMessages(page = 1, append = false) {
//         if (isLoading) return;
//         isLoading = true;
//         loader.style.display = 'block';

//         fetch(`/get-messages/${currentUserPhone}?page=${page}`)
//             .then(response => response.json())
//             .then(result => {
//                 console.log('Fetched items:', result);

//                 const items = result.data;
//                 hasMore = result.has_more;

//                 // Sort all items (messages and calls) by created_at timestamp
//                 items.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));

//                 // Display sorted items
//                 const itemsHtml = items.map(item => {
//                     const formattedDate = new Date(item.created_at).toLocaleString();
//                     let messageHtml = '';

//                     if (item.type === 'message') {
//                         const messageClass = item.direction === 'incoming' ? 'right' : '';
//                         const avatarSrc = item.direction === 'incoming' ?
//                             '{{ URL::asset('build/images/users/avatar-2.jpg') }}' :
//                             '{{ URL::asset('build/images/users/avatar-4.jpg') }}';

//                         messageHtml = `
//                             <li class="${messageClass}">
//                                 <div class="conversation-list">
//                                     <div class="d-flex">
//                                         ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
//                                         <div class="flex-grow-1">
//                                             <div class="ctext-wrap">
//                                                 <div class="ctext-wrap-content">
//                                                     <p class="mb-0">${item.body}</p>
//                                                     <span class="chat-time text-muted">${formattedDate}</span>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                         ${messageClass === 'right' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
//                                     </div>
//                                 </div>
//                             </li>
//                         `;
//                     } else if (item.type === 'call') {
//                         messageHtml = `
//                             <li class="call-record">
//                                 <div class="conversation-list">
//                                     <div class="d-flex">
//                                         <div class="flex-grow-1">
//                                             <div class="ctext-wrap">
//                                                 <div class="ctext-wrap-content">
//                                                     <p class="mb-0">Call from ${item.from} to ${item.to}</p>
//                                                     <p class="mb-0">Duration: ${item.duration}</p>
//                                                     <span class="chat-time text-muted">${formattedDate}</span>
//                                                     ${item.recording_url ? `
//                                                         <audio controls>
//                                                             <source src="${item.recording_url}" type="audio/mpeg">
//                                                             Your browser does not support the audio element.
//                                                         </audio>
//                                                         <a href="${item.recording_url}" class="btn btn-primary btn-sm" download>Download</a>
//                                                     ` : '<p>No recording available</p>'}
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </li>
//                         `;
//                     }

//                     return messageHtml;
//                 }).join('');

//                 if (!append) {
//                     chatMessages.innerHTML = ''; // Clear previous messages if not appending
//                 }

//                 if (append) {
//                     // Prepend new messages
//                     chatMessages.insertAdjacentHTML('afterbegin', itemsHtml);
//                 } else {
//                     // Display messages for the first page or reset
//                     chatMessages.innerHTML = itemsHtml;
//                 }

//                 // Scroll to the bottom of the chat only if this is the first page
//                 if (page === 1) {
//                     chatContainer.scrollTop = chatContainer.scrollHeight;
//                 }

//                 isLoading = false;
//                 loader.style.display = 'none';
//             })
//             .catch(error => {
//                 console.error('Error fetching messages and calls:', error);
//                 isLoading = false;
//                 loader.style.display = 'none';
//             });
//     }

//     // Add event listeners for chat users
//     chatUsers.forEach(user => {
//         user.addEventListener('click', function(e) {
//             e.preventDefault();

//             // Get user data
//             const userName = this.dataset.name;
//             currentUserPhone = this.dataset.phone;

//             // Update chat window
//             chatUserName.textContent = userName;
//             messageInputContainer.style.display = 'block';
//             currentPage = 1;
//             hasMore = true;

//             // Fetch the first page of messages
//             fetchMessages(currentPage);
//         });
//     });

//     // Infinite scroll handling
//     chatContainer.addEventListener('scroll', function() {
//         if (chatContainer.scrollTop === 0 && hasMore && !isLoading) {
//             currentPage++;
//             fetchMessages(currentPage, true);
//         }
//     });

//     // Send message logic remains unchanged
//     const sendMessageBtn = document.getElementById('send-message-btn');
//     sendMessageBtn.addEventListener('click', function(e) {
//         e.preventDefault();

//         const body = document.getElementById('body').value;

//         if (!currentUserPhone || !body) {
//             return;
//         }

//         fetch('/messages/send', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             },
//             body: JSON.stringify({
//                 to: currentUserPhone,
//                 body: body
//             })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 const messageHtml = `
//                     <li class="right">
//                         <div class="conversation-list">
//                             <div class="d-flex">
//                                 <div class="flex-grow-1">
//                                     <div class="ctext-wrap">
//                                         <div class="ctext-wrap-content">
//                                             <p class="mb-0">${body}</p>
//                                             <span class="chat-time text-muted">${new Date().toLocaleString()}</span>
//                                         </div>
//                                     </div>
//                                 </div>
//                                 <div class="chat-avatar">
//                                     <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar">
//                                 </div>
//                             </div>
//                         </div>
//                     </li>
//                 `;
//                 chatMessages.insertAdjacentHTML('beforeend', messageHtml);
//                 document.getElementById('body').value = '';

//                 chatContainer.scrollTop = chatContainer.scrollHeight;
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Failed to send message!'
//                 });
//                 console.error('Error sending message:', data.error);
//             }
//         })
//         .catch(error => {
//             console.error('Error sending message:', error);
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Error sending message. Please try again later!'
//             });
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    let currentUserPhone = null;
    let currentPage = 1;
    let hasMore = true;
    let isLoading = false;

    const chatUsers = document.querySelectorAll('.chat-user');
    const chatUserName = document.getElementById('chat-user-name');
    const chatMessages = document.getElementById('chat-messages');
    const messageInputContainer = document.getElementById('message-input-container');
    const loader = document.getElementById('loader');
    const chatContainer = chatMessages.parentElement;

    // Fetch messages function
    function fetchMessages(page = 1, append = false) {
        if (isLoading) return;
        isLoading = true;
        loader.style.display = 'block';

        // Save current scroll position
        const scrollTop = chatContainer.scrollTop;
        const scrollHeight = chatContainer.scrollHeight;

        fetch(`/get-messages/${currentUserPhone}?page=${page}`)
            .then(response => response.json())
            .then(result => {
                console.log('Fetched items:', result);

                const items = result.data;
                hasMore = result.has_more;

                // Sort all items (messages and calls) by created_at timestamp
                items.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));

                // Display sorted items
                const itemsHtml = items.map(item => {
                    const formattedDate = new Date(item.created_at).toLocaleString();
                    let messageHtml = '';

                    if (item.type === 'message') {
                        const messageClass = item.direction === 'incoming' ? 'right' : '';
                        const avatarSrc = item.direction === 'incoming' ?
                            '{{ URL::asset('build/images/users/avatar-2.jpg') }}' :
                            '{{ URL::asset('build/images/users/avatar-4.jpg') }}';

                        messageHtml = `
                            <li class="${messageClass}">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        ${messageClass === '' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">${item.body}</p>
                                                    <span class="chat-time text-muted">${formattedDate}</span>
                                                </div>
                                            </div>
                                        </div>
                                        ${messageClass === 'right' ? `<div class="chat-avatar"><img src="${avatarSrc}" alt="avatar"></div>` : ''}
                                    </div>
                                </div>
                            </li>
                        `;
                    } else if (item.type === 'call') {
                        messageHtml = `
                            <li class="call-record">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">Call from ${item.from} to ${item.to}</p>
                                                    <p class="mb-0">Duration: ${item.duration}</p>
                                                    <span class="chat-time text-muted">${formattedDate}</span>
                                                    ${item.recording_url ? `
                                                        <audio controls>
                                                            <source src="${item.recording_url}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                        <a href="${item.recording_url}" class="btn btn-primary btn-sm" download>Download</a>
                                                    ` : '<p>No recording available</p>'}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                    }

                    return messageHtml;
                }).join('');

                if (!append) {
                    chatMessages.innerHTML = ''; // Clear previous messages if not appending
                }

                if (append) {
                    // Prepend new messages
                    chatMessages.insertAdjacentHTML('afterbegin', itemsHtml);
                } else {
                    // Display messages for the first page or reset
                    chatMessages.innerHTML = itemsHtml;
                }

                // Adjust scroll position to maintain view
                chatContainer.scrollTop = chatContainer.scrollHeight - scrollHeight + scrollTop;

                isLoading = false;
                loader.style.display = 'none';
            })
            .catch(error => {
                console.error('Error fetching messages and calls:', error);
                isLoading = false;
                loader.style.display = 'none';
            });
    }

    // Add event listeners for chat users
    chatUsers.forEach(user => {
        user.addEventListener('click', function(e) {
            e.preventDefault();

            // Get user data
            const userName = this.dataset.name;
            currentUserPhone = this.dataset.phone;

            // Update chat window
            chatUserName.textContent = userName;
            messageInputContainer.style.display = 'block';
            currentPage = 1;
            hasMore = true;

            // Fetch the first page of messages
            fetchMessages(currentPage);
        });
    });

    // Infinite scroll handling
    chatContainer.addEventListener('scroll', function() {
        if (chatContainer.scrollTop === 0 && hasMore && !isLoading) {
            currentPage++;
            fetchMessages(currentPage, true);
        }
    });

    // Send message logic remains unchanged
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
                                    <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="avatar">
                                </div>
                            </div>
                        </div>
                    </li>
                `;
                chatMessages.insertAdjacentHTML('beforeend', messageHtml);
                document.getElementById('body').value = '';

                chatContainer.scrollTop = chatContainer.scrollHeight;
            } else {
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
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error sending message. Please try again later!'
            });
        });
    });
});




        </script>




        {{-- <script>
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
        </script> --}}
    @endsection
