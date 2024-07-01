@extends('layouts.main')
@section('content')
<div class="container">
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
                            class="avatar-img rounded-2"
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
                            src="{{ asset('storage/profilepicture/'.$item->User->image) }}"
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

                        @if ($user->role === $item->User->role)
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
          <div class="card card-body mt-5">
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
                <form class="w-100" method="POST" action="{{ route('komentar-proses') }}">
                    @csrf
                    <input type="hidden"
                    name="user"
                    value="{{ $user->id }}"
                    >
                    <input type="hidden"
                    name="forum"
                    value="{{ $item->id }}"
                    >
                    <input type="text"
                    class="border-0 form-control pe-4"
                    name="isi"
                    placeholder="Share your thoughts..."
                    {{-- style="padding-top: 0px;padding-bottom: 0px;" --}}
                    >
                    <nav class="navbar navbar-expand-md py-3">
                        <div class="container">
                            <div class="collapse navbar-collapse" id="navcol-2">
                                {{-- <ul class="navbar-nav ms-auto"></ul> --}}
                            </div>
                            <button class="btn btn-light btn-sm text-end" type="submit">
                                <i style="width: 14px" data-feather="send"></i>
                            </button>
                        </div>
                    </nav>
                </form>
            </div>
        </div>
        @foreach ($coment as $komen)

        <div class="card border-white border rounded mt-5">
            <div class="card-body border-dark-subtle border rounded" data-bs-theme="light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="nav nav-divider">
                                <div class="avatar avatar-xs me-2">
                                    <a href="#">
                                        @if($komen->user->image === null)
                                        <img
                                        alt="profile"
                                        class="avatar-img rounded-2"
                                        src="../img/person-outline-filled.svg"
                                        >
                                    @else
                                        <img
                                        alt="Profile"
                                        class="avatar-img rounded-2"
                                        src="{{ asset('storage/profilepicture/'.$item->User->image) }}"
                                        >
                                    @endif
                                    </a>
                                </div>
                                <h6 class="nav-item card-title mb-0">{{ $komen->User->username }}</h6>
                                <span class="nav-item small">{{ $komen->created_at->diffForHumans() }} </span>
                            </div>
                            <p class="mb-0 small" style="margin-top:5px;">{{ $komen->User->role }}</p>
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
                    @if ($user->role === $komen->User->role)
                    <li>
                        <form action="{{ route('comment.delete', ['id'=> $komen->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="forum_id" value="{{ $komen->id }}">
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
                        data-bs-target="#report-{{ $komen->id,$user->id }}"
                    >
                        <i class="bi bi-flag fa-fw  pe-2"></i>Report post
                    </button>
                    </li>

                </ul>

                 <!-- report start -->
                 <div
                 class="modal fade"
                 id="report-{{ $komen->id,$user->id }}"
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
                         <form id="reportForm-{{ $komen->id,$user->id }}" action="{{ route('proses.report') }}" method="post">

                         @csrf
                         <input type="hidden" name="forum" value="{{ $item->id }}">
                         <input type="hidden" name="komen" value="{{ $komen->id }}">
                         <input type="hidden" name="user" value="{{ $user->id }}">
                         <input type="hidden" name="jenis" value="komentar">

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
                <p class="card-text">
                    {{ $komen->isi }}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
