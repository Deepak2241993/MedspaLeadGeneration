@extends('admin.layouts.app')

@php
    $pageTitle = 'Message Dashboard';
@endphp

@section('content')
    {{-- <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#" role="button" tabindex="0">Leads</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chat</li>
                                </ol>
                            </nav>
                        </div>
                        <h4 class="page-title">Chat</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-3 col-xl-3 order-xl-1">
                    <div class="card">
                        <div class="p-0 card-body">
                            <ul class="nav nav-tabs nav-bordered">
                                <li class="nav-item"><a class="nav-link py-2 active" href="">All Clints</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active card-body pb-0">
                                    <div class="app-search">
                                        <form>
                                            <div class="mb-2 w-100 position-relative form-group">
                                                <input type="text" class="form-control"
                                                    placeholder="People, groups & messages...">
                                                <span class="mdi mdi-magnify search-icon"></span>
                                            </div>
                                        </form>
                                    </div>
                                    <div data-simplebar="init" class="simplebar-scrollable-y"
                                        style="max-height: 550px; width: 100%;">
                                        <div class="simplebar-wrapper" style="margin: 0px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                        aria-label="scrollable content"
                                                        style="height: auto; overflow: hidden scroll;">
                                                        <div class="simplebar-content" style="padding: 0px;">
                                                            @forelse ($leaddata as $item)
                                                                <div class="d-flex align-items-start mt-1 p-2">
                                                                    <img src="/hyper_react/assets/avatar-2-a764e0aa.jpg"
                                                                        class="me-2 rounded-circle" height="48"
                                                                        alt="">
                                                                    <div class="w-100 overflow-hidden">
                                                                        <h5 class="mt-0 mb-0 font-14">
                                                                            <span
                                                                                class="float-end text-muted font-12">{{ $item->created_at->format('H:i:s') }}</span>
                                                                            {{ $item->first_name }}
                                                                        </h5>
                                                                        <p class="mt-1 mb-0 text-muted font-14">
                                                                            <span class="w-25 float-end text-end">
                                                                                <span
                                                                                    class="badge badge-danger-lighten"></span>
                                                                            </span>
                                                                            <span class="w-75">{{ $item->message }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>No leads found.</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder" style="width: 546px; height: 994px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-3 order-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: center; align-items: center; height: 80px;">
                                <img src="\img\worksuite-logo.png" class="rounded-circle" alt=""
                                    style="height: 100px;">
                            </div>

                            <div class="mt-3 text-center">
                                <h4>{{ $item->first_name }}</h4>
                            </div>
                            <div class="mt-3">
                                <hr class="">
                                <p class="mt-4 mb-1"><strong><i class="uil uil-at"></i> Email:</strong></p>
                                <p>{{ $item->email }}</p>
                                <p class="mt-3 mb-1"><strong><i class="uil uil-phone"></i> Phone Number:</strong></p>
                                <p>{{ $item->phone }}</p>
                            </div>
                            <div class="conversation-actions dropdown"><button type="button" id="react-aria400187678-:rk:"
                                    aria-expanded="false"
                                    class="btn btn-sm btn-link arrow-none shadow-none dropdown-toggle btn btn-link"><i
                                        class="uil uil-ellipsis-v"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 order-xxl-2 order-xl-1">
                    <div class="position-relative px-0 pb-0 card-body">
                        <div data-simplebar="init" class="simplebar-scrollable-y" style="height: 538px; width: 100%;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <ul class="conversation-list px-3">
                                                    <li class="clearfix">
                                                        <div class="chat-avatar"><img
                                                                src="/hyper_react/assets/avatar-5-6576d198.jpg"
                                                                class="rounded" alt=""><i></i></div>
                                                        <div class="conversation-text">
                                                            <div class="ctext-wrap"><i>Vishal kumar</i>
                                                                <p>Hello</p>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-actions dropdown"><button type="button"
                                                                id="react-aria976615393-:r1f:" aria-expanded="false"
                                                                class="btn btn-sm btn-link arrow-none shadow-none dropdown-toggle btn btn-link"><i
                                                                    class="uil uil-ellipsis-v"></i></button></div>
                                                    </li>
                                                    <li class="clearfix odd">
                                                        <div class="chat-avatar"><img src="" class="rounded"
                                                                alt=""><i></i></div>
                                                        <div class="conversation-text">
                                                            <div class="ctext-wrap"><i>Scachin N</i>
                                                                <p>Hii</p>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-actions dropdown"><button type="button"
                                                                id="react-aria976615393-:r1g:" aria-expanded="false"
                                                                class="btn btn-sm btn-link arrow-none shadow-none dropdown-toggle btn btn-link"><i
                                                                    class="uil uil-ellipsis-v"></i></button></div>
                                                    </li>
                                                    <div></div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 546px; height: 1332px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 217px; display: block; transform: translate3d(0px, 321px, 0px);"></div>
                            </div>
                        </div>
                        <div class="px-3 pb-3 row">
                            <div class="col">
                                <div class="mt-2 bg-light p-3 rounded">
                                    <form name="chat-form" id="chat-form" class="">
                                        <div class="row">
                                            <div class="col mb-2 mb-sm-0">
                                                <div class=""><input name="newMessage"
                                                        placeholder="Enter your text" type="text"
                                                        class="border-0 form-control" value="Send The Message"></div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="btn-group"><button type="submit"
                                                        class="btn btn-success chat-send btn-block"><i
                                                            class="uil uil-message"></i>Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <section style="background-color: #eee;">
        <div class="container py-5">
      
          <div class="row">
      
            <div class="col-md-3 col-lg-3 col-xl-3 mb-4 mb-md-0">
      
              <h5 class="font-weight-bold mb-3 text-center text-lg-start">Member</h5>
      
              <div class="card">
                <div class="card-body">
      
                  <ul class="list-unstyled mb-0">
                    <li class="p-2 border-bottom" style="background-color: #eee;">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">John Doe</p>
                            <p class="small text-muted">Hello, Are you there?</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">Just now</p>
                          <span class="badge bg-danger float-end">1</span>
                        </div>
                      </a>
                    </li>
                    <li class="p-2 border-bottom">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Danny Smith</p>
                            <p class="small text-muted">Lorem ipsum dolor sit.</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">5 mins ago</p>
                        </div>
                      </a>
                    </li>
                    <li class="p-2 border-bottom">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-2.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Alex Steward</p>
                            <p class="small text-muted">Lorem ipsum dolor sit.</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">Yesterday</p>
                        </div>
                      </a>
                    </li>
                    <li class="p-2 border-bottom">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-3.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Ashley Olsen</p>
                            <p class="small text-muted">Lorem ipsum dolor sit.</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">Yesterday</p>
                        </div>
                      </a>
                    </li>
                    <li class="p-2 border-bottom">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-4.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Kate Moss</p>
                            <p class="small text-muted">Lorem ipsum dolor sit.</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">Yesterday</p>
                        </div>
                      </a>
                    </li>
                    <li class="p-2 border-bottom">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Lara Croft</p>
                            <p class="small text-muted">Lorem ipsum dolor sit.</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">Yesterday</p>
                        </div>
                      </a>
                    </li>
                    <li class="p-2">
                      <a href="#!" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">Brad Pitt</p>
                            <p class="small text-muted">Lorem ipsum dolor sit.</p>
                          </div>
                        </div>
                        <div class="pt-1">
                          <p class="small text-muted mb-1">5 mins ago</p>
                          <span class="text-muted float-end"><i class="fas fa-check" aria-hidden="true"></i></span>
                        </div>
                      </a>
                    </li>
                  </ul>
      
                </div>
              </div>
      
            </div>
      
            <div class="col-md-4 col-lg-6 col-xl-6">
      
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-4">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                    class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                      <p class="fw-bold mb-0">Brad Pitt</p>
                      <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                    </div>
                    <div class="card-body">
                      <p class="mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                      </p>
                    </div>
                  </div>
                </li>
                <li class="d-flex justify-content-between mb-4">
                  <div class="card w-100">
                    <div class="card-header d-flex justify-content-between p-3">
                      <p class="fw-bold mb-0">Lara Croft</p>
                      <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                    </div>
                    <div class="card-body">
                      <p class="mb-0">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium.
                      </p>
                    </div>
                  </div>
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                    class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                </li>
                <li class="d-flex justify-content-between mb-4">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                    class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                      <p class="fw-bold mb-0">Brad Pitt</p>
                      <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                    </div>
                    <div class="card-body">
                      <p class="mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                      </p>
                    </div>
                  </div>
                </li>
                <li class="bg-white mb-3">
                  <div data-mdb-input-init class="form-outline">
                    <textarea class="form-control" id="textAreaExample2" rows="4"></textarea>
                    <label class="form-label" for="textAreaExample2">Message</label>
                  </div>
                </li>
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-rounded float-end">Send</button>
              </ul>
      
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Cras justo odio</li>
                      <li class="list-group-item">Dapibus ac facilisis in</li>
                      <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                  </div>
            </div>
      
          </div>
      
        </div>
      </section>
@endsection
