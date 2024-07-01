@extends('layouts.main')
@section('content')
{{-- profile --}}
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-3">
            <nav class="navbar navbar-expand-lg mx-0">
              <div
                class="offcanvas offcanvas-start"
                tabindex="-1"
                id="offcanvasSideNavbar"
              >
                <div class="offcanvas-header">
                  <button
                    class="btn-close ms-auto text-reset"
                    type="button"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="offcanvas-body d-block px-2 px-lg-0"></div>
              </div>
            </nav>
            <div class="card overflow-hidden">
              <div
                class="h-50px"
                style="
                  background-image: url(img/night.jpg);
                  background-position: center;
                  background-size: cover;
                  background-repeat: no-repeat;
                "
              ></div>
              <div class="card-body pt-0">
                <div class="text-center">
                  <div class="avatar avatar-lg mt-n5 mb-3">
                    <a href="#">
                        @if($user->image === null)
                            <img
                            alt="profile"
                            class="avatar-img rounded-2"
                            src="../img/person-outline-filled.svg"
                            >
                        @else
                            <img
                          alt="Profile"
                          class="avatar-img rounded-2"
                          src="{{ asset('storage/profilepicture/'.$user->image) }}"
                            >
                        @endif
                    </a>
                  </div>
                  <h5 class="mb-0">{{ $user->username }}</h5>
                  <small>{{ $user->role }}</small>
                  <p class="mt-3">
                    {{ $user->status }}
                  </p>
                </div>
                <hr />
                <ul class="nav flex-column fw-bold nav-link-secondary gap-2">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('setting_profile',['id'=>$user->id]) }}"
                      ><img
                        alt=""
                        class="me-2 h-20px fa-fw"
                        src="../img/cog-outline-filled.svg"
                      /><span>Settings </span></a
                    >
                  </li>
                </ul>
              </div>
              <div class="card-footer text-center py-2">
                <a href="{{ route('profile')}}">View Profile </a>
              </div>
            </div>
          </div>



          <div class="col-md-8 col-lg-6 vstack gap-4">
            @if (session()->has('loginError'))
                <div class="alert alert-danger" role="alert">
                    {{session('loginError')  }}

                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')  }}

                </div>
            @endif

            @error('image')
            <div class="alert alert-danger" role="alert">
                <small>Tolong upload tipe gambar [ png, jpg, jpeg ]!!</small>
            </div>
            @enderror

            <div class="d-flex gap-2 mb-n3"></div>
            <div class="card card-body">
              <div class="d-flex mb-3">
                <div class="avatar avatar-xs me-2">
                  <a href="#">
                    @if($user->image === null)
                        <img
                        alt="profile"
                        class="avatar-img rounded-2"
                        src="../img/person-outline-filled.svg"
                        >
                    @else
                        <img
                        alt="Profile"
                        class="avatar-img rounded-2"
                        src="{{ asset('storage/profilepicture/'.$user->image) }}"
                        >
                    @endif
                  </a>
                </div>
                <div class="w-100">
                  <input
                    type="text"
                    class="border-0 form-control form-control form-control pe-4"
                    placeholder="Share your thoughts..."
                    data-bs-target="#feedActionPhoto"
                    data-bs-toggle="modal"
                    readonly
                    href="#"
                  />
                </div>
              </div>
              <ul class="nav nav-pills fw-normal nav-stack small">
                <li class="nav-item">
                  <a
                    class="nav-link bg-light py-1 px-2 mb-0"
                    data-bs-target="#feedActionPhoto"
                    data-bs-toggle="modal"
                    href="#"
                  >
                    <i style="width: 14px" class="mb-1" data-feather="camera">
                    </i
                    >&nbsp;Photo</a
                  >
                </li>
              </ul>

              <!-- create post start -->
              <div
                class="modal fade"
                role="dialog"
                tabindex="-1"
                id="feedActionPhoto"
                aria-labelledby="feedActionPhotoLabel"
                aria-hidden="true"
              >
                <form id="addForm" method="POST" action="
                {{ route('upload')}}"
                enctype="multipart/form-data" class="needs-validation" novalidate>
                  @csrf
                  <input
                  type="hidden"
                  name="user"
                  value="{{ $user->id }}"
                  >
                  <div
                    class="modal-dialog modal-dialog-centered"
                    role="document"
                  >
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          Buat Postingan
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">

                        <div class="form-group row mb-4">
                          <div class="col-sm-12">
                            <textarea
                              class="form-control"
                              rows="5"
                              name="isi"
                              id="contentTextarea"
                              placeholder="Share your thoughts..."
                            ></textarea>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                            for="anonimCheckbox"
                            >Post anonim</label
                          >
                          <div
                            class="col-sm-12 col-md-7 d-flex align-items-center"
                          >
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="checkbox"
                                value="1"
                                id="anonimCheckbox"
                                name="anonim"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                            >Upload Gambar </label
                          >
                          <div class="col-sm-12 col-md-7">
                            <input
                              type="file"
                              class="form-control"
                              name="image"
                              tabindex="4"
                              accept="image/*"
                            />
                            <small>File max 2Mb</small>
                          </div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="submit"
                          class="btn btn-secondary w-100"
                          id="uploadButton"
                          disabled=""
                        >
                          Upload
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- create post end-->
            </div>

            {{-- postingan --}}

    @foreach ($forum as $item)

            <div class="card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if ($item->is_anonim)
                            <div>
                                <div class="nav nav-divider">
                                  <div class="avatar avatar-xs me-2">
                                    <a href="#"
                                      ><img
                                        class="rounded-circle avatar-img"
                                        src="../img/person-outline-filled.svg"
                                        alt="profile"
                                    /></a>
                                  </div>
                                  <h6 class="nav-item card-title mb-0">Anonim</h6>
                                  <span class="nav-item small">{{ $item->created_at->diffForHumans() }} </span>
                                </div>
                                <p class="mb-0 small" style="margin-top: 5px">anonim</p>
                              </div>
                            @else
                            <div>
                                <div class="nav nav-divider">
                                    <div class="avatar avatar-xs me-2">
                                        <a href="#"
                                        >
                                    @if($item->user->image === null)
                                        <img
                                        alt="profile"
                                        class="avatar-img rounded-2"
                                        src="../img/person-outline-filled.svg"
                                        >
                                    @else
                                        <img
                                        alt="Profile"
                                        class="avatar-img rounded-2"
                                        src="{{ asset('storage/profilepicture/'.$item->user->image) }}"
                                        >
                                    @endif
                                    </a>
                                    </div>
                                    <div class="nav nav-divider">
                                        <h6 class="nav-item card-title mb-0">{{ $item->User->username }}</h6>
                                        <span class="nav-item small">{{ $item->created_at->diffForHumans() }} </span>
                                    </div>
                                </div>
                                <p class="mb-0 small" style="margin-top: 5px">
                                    {{ $item->User->role }}
                                </p>
                            </div>
                            @endif

                        </div>



                        <div class="dropdown">
                            <a
                            class="btn text-secondary btn-secondary-soft-hover py-1 px-2"
                            role="button"
                            href="#"
                            id="cardFeedAction-1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            <i style="width: 16px" data-feather="settings"></i>
                        </a>
                        <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="cardFeedAction"
                        >

                        @if ($user->username === $item->User->username||$user->role ==="admin")
                        <li>
                            <a class="dropdown-item" href="{{ route('forum.edit',['id'=>$item->id]) }}"
                            ><i class="bi bi-slash-circle fa-fw pe-2"></i>Edit</a
                            >
                        </li>

                        <li>
                            <form action="{{ route('forum.delete', ['id'=> $item->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                 class="dropdown-item ms-2" type="submit">Hapus</button>
                            </form>
                        </li>
                        <li><hr class="dropdown-divider" /></li>

                        @endif

                        <li>
                            <button
                            class="dropdown-item"
                            data-bs-toggle="modal"
                            data-bs-target="#report-{{ $item->id,$user->id }}"
                        >
                            <i class="bi bi-flag fa-fw  pe-2"></i>Report post
                        </button>
                        </li>

                    </ul>
                        <!-- report start -->
                        <div
                        class="modal fade"
                        id="report-{{ $item->id,$user->id }}"
                        tabindex="-1"
                        aria-labelledby="report"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header justify-content-center">
                              <h1 class="modal-title fs-5" id="fail-login">Report</h1>
                            </div>
                            <div class="modal-body">
                                <form id="reportForm-{{ $item->id,$user->id }}" action="{{ route('proses.report') }}" method="post">

                                @csrf
                                <input type="hidden" name="forum" value="{{ $item->id }}">
                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <input type="hidden" name="jenis" value="postingan">

                                {{-- <input type="hidden" name="user" value="{{ $user->id }}"> --}}
                                <div class="mb-3">
                                  <label class="form-label"
                                    >Please select the reporting category</label
                                  >
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="report[]"
                                      value="kekerasan"
                                      id="kekerasan"
                                    />
                                    <label class="form-check-label" for="kekerasan"
                                      >Berbau Kekerasan</label
                                    >
                                  </div>
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="report[]"
                                      value="sara"
                                      id="sara"
                                    />
                                    <label class="form-check-label" for="sara">Sara</label>
                                  </div>
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="report[]"
                                      value="bully"
                                      id="bully"
                                    />
                                    <label class="form-check-label" for="bully">Membully</label>
                                  </div>
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="report[]"
                                      value="tidak senonoh"
                                      id="tidak_senonoh"
                                    />
                                    <label class="form-check-label" for="tidak_senonoh"
                                      >Tidak Senonoh</label
                                    >
                                  </div>
                                  <div class="form-check">
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="report[]"
                                      value="spam"
                                      id="spam"
                                    />
                                    <label class="form-check-label" for="spam">Spam</label>
                                  </div>
                                </div>
                                <div class="mb-3">
                                  <label for="additionalComments" class="form-label"
                                    >Additional Comments (optional):</label
                                  >
                                  <textarea
                                    class="form-control"
                                    id="additionalComments"
                                    name="pesan"
                                    rows="3"
                                  ></textarea>
                                </div>
                                <div class="modal-footer">
                                  <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-dismiss="modal"
                                  >
                                    Close
                                  </button>
                                  <button type="submit" class="btn btn-primary">
                                    Submit Report
                                  </button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- report end -->
                </div>
            </div>
            </div>

              <div class="card-body">
                  <p>
                    {{ $item->isi }}
                </p>
                @if ($item->image)
                    <img
                    class="card-img"
                    src="{{ asset('storage/forumimg/'.$item->image) }}"
                    alt="Post"
                    />
                @endif

                <ul class="nav nav-stack py-3 small">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('komentar',['id'=>$item->id]) }}">
                            <i
                            style="width: 20px"
                            class="mb-1"
                            data-feather="message-circle"
                            ></i>
                            Comments</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
    @endforeach

    {{-- ruang aspirasi --}}
            <a
              class="btn btn-loader btn-primary-soft"
              role="button"
              href="#"
              data-bs-toggle="button"
              aria-pressed="true"
              ><span class="load-text"> Load more </span>
              <div class="load-icon">
                <div class="spinner-grow spinner-grow-sm" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div></a
            >
          </div>
          <div class="col-lg-3">
            <div class="row g-4">
              <div class="col-sm-6 col-lg-12">
                <div
                  class="card"
                  style="
                    margin-right: 10px;
                    margin-left: 9px;
                    padding-right: 0px;
                  "
                >
                  <div class="card-header text-center border-0 pb-0">
                    <a class="fs-3 fw-bold" href="{{ route('aspirasi') }}"
                      ><span style="color: var(--bs-card-title-color)"
                        >Ruang Aspirasi</span
                      ></a
                    >
                    <!-- <h5 class="card-title mb-0"></h5> -->
                  </div>
                  <div
                    class="text-center text-md-start d-flex flex-column align-items-center align-items-md-start mb-5"
                  >

                  @foreach ($posts as $post)

                  <div
                  class="text-center"
                  style="padding-left: 6px; padding-right: 6px"
                  >
                  <hr
                  style="
                          padding-left: 0px;
                          padding-right: 0px;
                          margin-left: 0px;
                          margin-right: 0px;
                          "
                      />
                      <h6>{{ $post->title }}</h6>
                      <p class="fw-light">
                        {{ $post->potongan_body."..." }}
                        </p>
                        <a href="{{ route('content.show', ['id'=>$post->id]) }}"
                        >Learn More
                        <i style="width: 16px" data-feather="arrow-right"></i>
                    </a>
                </div>
                @endforeach
        </div>
      </div>
@endsection
