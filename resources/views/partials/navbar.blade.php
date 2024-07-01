<header class="navbar-light fixed-top header-static bg-mode">
    <nav class="navbar navbar-expand-lg">
      <div class="container">

        <!-- Logo START -->
        <a class="navbar-brand" href="/">
          <img
          class="light-mode-item navbar-brand-item"
          src="../img/logo.svg"
          alt="logo" /><img
          class="dark-mode-item navbar-brand-item"
          src="assets/img/logo.svg"
          alt="logo" />
        </a>
        <!-- Logo END -->

        <!-- Responsive navbar toggler -->
        <button class="navbar-toggler ms-auto icon-md btn btn-light p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-animation">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>

        <!-- Main navbar START -->
        <div class="collapse navbar-collapse" id="navbarCollapse">

          <!-- Nav Search START -->
          <div class="nav mt-3 mt-lg-0 flex-nowrap align-items-center px-4 px-lg-0">
            <div class="nav-item w-100">
              <form class="rounded position-relative">
                <input class="form-control ps-5 bg-light" type="search" placeholder="Search..." aria-label="Search">
                <button
                class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y"
                type="submit"
               ><svg
                  class="bi bi-search"
                  fill="currentColor"
                  height="1em"
                  style="font-size: 26px"
                  viewbox="0 0 16 16"
                  width="1em"
                  xmlns="http://www.w3.org/2000/svg"
                 ><path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"
                 ></path>
                </svg>
              </button>
              </form>
            </div>
          </div>
          <!-- Nav Search END -->

          <ul class="navbar-nav navbar-nav-scroll ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('forum') }}">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('aspirasi') }}">Aspirasi</a>
            </li>
            @if ($user->role == 'admin')

            <li class="nav-item">
                <a class="nav-link" href="{{ route('report') }}">Data Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">Admin Page</a>
            </li>
            @endif
          </ul>
        </div>
        <!-- Main navbar END -->

        <!-- Nav Profile START -->
        <ul class="nav flex-nowrap align-items-center ms-sm-3 list-unstyled">
          <li class="nav-item dropdown ms-2">
            <div
              class="border-0 shadow-lg dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0"
              aria-labelledby="notifDropdown"
            ></div>
          </li>
          <li class="nav-item ms-2 dropdown">
            <a
            class="nav-link btn icon-md p-0"
            href="#"
            id="profileDropdown"
            role="button"
            data-bs-auto-close="outside"
            data-bs-display="static"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            >
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
            {{-- <img
              alt=""
              class="avatar-img rounded-2"
              src="{{ asset('storage/profilepicture/'.$user->image) }}"
          /> --}}
        </a>
            <ul
            class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3"
            aria-labelledby="profileDropdown"
            >
              <li>
                <a class="dropdown-item" href="{{ route('setting_profile',['id'=>$user->id]) }}"
                  >Profile &amp; Settings</a
                >
              </li>
              <li class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item bg-danger-soft-hover" href="{{ route('logout') }}"
                  >Keluar</a
                >
              </li>
            </ul>
          </li>
        </ul>
        <!-- Nav Profile END -->
      </div>
    </nav>
</header>
