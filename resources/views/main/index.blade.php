@extends('layouts.main')
@section('content')
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
                  background-image: url(assets/images/bg/01.jpg);
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
                    <a class="nav-link" href="#"
                      ><img
                        alt=""
                        class="me-2 h-20px fa-fw"
                        src="../img/notification-outlined-filled.svg"
                      /><span>Notifications </span></a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"
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
                <a href="viewProfile.html">View Profile </a>
              </div>
            </div>
          </div>
          <div class="col-md-8 col-lg-6 vstack gap-4">
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
                <!-- <li class="nav-item"></li>
                <li class="nav-item ms-lg-auto dropdown">
                  <a
                    class="nav-link bg-light py-1 px-2 mb-0"
                    aria-expanded="false"
                    data-bs-toggle="dropdown"
                    href="#"
                    id="feedActionShare"
                  >
                    <i style="width: 14px" data-feather="send"></i>
                  </a>
                </li> -->
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
                <form method="post">
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
                        <!-- Your existing form fields go here -->
                        <div class="form-group row mb-4">
                          <div class="col-sm-12">
                            <textarea
                              class="form-control"
                              rows="5"
                              name="content"
                              id="contentTextarea"
                              placeholder="Apa yang Anda pikirkan?"
                            ></textarea>
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                            >Tags</label
                          >
                          <div class="col-sm-12 col-md-7">
                            <input
                              type="text"
                              class="form-control"
                              name="tags"
                            />
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
                                value="Anonim"
                                id="anonimCheckbox"
                                name="anonimCheckbox"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label
                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                            >Upload Gambar</label
                          >
                          <div class="col-sm-12 col-md-7">
                            <input
                              type="file"
                              class="form-control"
                              name="profile-picture"
                              tabindex="4"
                              accept="image/*"
                            />
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


            <div class="card">
              <div class="card-header border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="nav nav-divider">
                        <div class="avatar avatar-xs me-2">
                          <a href="#"
                            ><img
                              class="rounded-circle avatar-img"
                              src="assets/img/person-outline-filled.svg"
                              alt=""
                          /></a>
                        </div>
                        <div class="nav nav-divider">
                          <h6 class="nav-item card-title mb-0">Entah Siapa</h6>
                          <span class="nav-item small">12 menit </span>
                        </div>
                      </div>
                      <p class="mb-0 small" style="margin-top: 5px">
                        Psikiater
                      </p>
                    </div>
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
                      <li>
                        <a class="dropdown-item" href="#"
                          ><i class="bi bi-slash-circle fa-fw pe-2"></i>Hapus</a
                        >
                      </li>
                      <li><hr class="dropdown-divider" /></li>
                      <li>
                        <a class="dropdown-item" href="#"
                          ><i class="bi bi-flag fa-fw pe-2"></i>Report post</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Laboriosam magnam qui animi nisi accusantium quia modi quo
                  eaque est et.Lorem ipsum dolor sit amet consectetur
                  adipisicing elit. Laboriosam magnam qui animi nisi accusantium
                  quia modi quo eaque est et.
                </p>
                <img
                  class="card-img"
                  src="assets/img/Screenshot%202023-11-12%20203751.png"
                  alt="Post"
                />
                <ul class="nav nav-stack py-3 small">
                  <li class="nav-item">
                    <a class="nav-link" href="komentar.html">
                      <i
                        style="width: 20px"
                        class="mb-1"
                        data-feather="message-circle"
                      ></i>
                      Comments (12)</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="card">
              <div class="card-header border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <div class="nav nav-divider">
                        <div class="avatar avatar-xs me-2">
                          <a href="#"
                            ><img
                              class="rounded-circle avatar-img"
                              src="assets/img/person-outline-filled.svg"
                              alt=""
                          /></a>
                        </div>
                        <h6 class="nav-item card-title mb-0">Entah Gatau</h6>
                      </div>
                      <p class="mb-0 small" style="margin-top: 5px">User</p>
                    </div>
                  </div>
                  <div class="dropdown">
                    <a
                      class="btn text-secondary btn-secondary-soft-hover py-1 px-2"
                      role="button"
                      href="#"
                      id="cardFeedAction"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <i style="width: 16px" data-feather="settings"></i>
                    </a>
                    <ul
                      class="dropdown-menu dropdown-menu-end"
                      aria-labelledby="cardFeedAction"
                    >
                      <li>
                        <a class="dropdown-item" href="#"
                          ><i class="bi bi-slash-circle fa-fw pe-2"></i>Hapus</a
                        >
                      </li>
                      <li><hr class="dropdown-divider" /></li>
                      <li>
                        <a class="dropdown-item" href="#"
                          ><i class="bi bi-flag fa-fw pe-2"></i>Report post</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <p>
                  I'm thrilled to share that I've completed a graduate
                  certificate course in project management with the president's
                  honor roll.
                </p>
                <ul class="nav nav-stack py-3 small">
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      href="komentar.html"
                      style="padding-left: 0px"
                    >
                      <i
                        style="width: 20px"
                        class="mb-1"
                        data-feather="message-circle"
                      ></i>
                      Comments (12)</a
                    >
                  </li>
                </ul>
              </div>
            </div>
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
                    <a class="fs-3 fw-bold" href="ruangAspirasi.html"
                      ><span style="color: var(--bs-card-title-color)"
                        >Ruang Aspirasi</span
                      ></a
                    >
                    <!-- <h5 class="card-title mb-0"></h5> -->
                  </div>
                  <div
                    class="text-center text-md-start d-flex flex-column align-items-center align-items-md-start mb-5"
                  >
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
                      <h6>Title</h6>
                      <p class="fw-light">
                        Erat netus est hendrerit, nullam et quis ad cras
                        porttitor iaculis. Bibendum vulputate cras aenean.
                      </p>
                      <a href="ruangAspirasi.html"
                        >Learn More
                        <i style="width: 16px" data-feather="arrow-right"></i>
                      </a>
                    </div>
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
                      <h6>Title</h6>
                      <p class="fw-light">
                        Erat netus est hendrerit, nullam et quis ad cras
                        porttitor iaculis. Bibendum vulputate cras aenean.
                      </p>
                      <a href="ruangAspirasi.html"
                        >Learn More
                        <i style="width: 16px" data-feather="arrow-right"></i>
                      </a>
                    </div>
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
                      <h6>Title</h6>
                      <p class="fw-light">
                        Erat netus est hendrerit, nullam et quis ad cras
                        porttitor iaculis. Bibendum vulputate cras aenean.
                      </p>
                      <a href="ruangAspirasi.html"
                        >Learn More
                        <i style="width: 16px" data-feather="arrow-right"></i>
                      </a>
                    </div>
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
                      <h6>Title</h6>
                      <p class="fw-light">
                        Erat netus est hendrerit, nullam et quis ad cras
                        porttitor iaculis. Bibendum vulputate cras aenean.
                      </p>
                      <a href="ruangAspirasi.html"
                        >Learn More
                        <i style="width: 16px" data-feather="arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
