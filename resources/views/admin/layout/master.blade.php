<!DOCTYPE html>

<html
  lang="en"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>My Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" /> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js')}}"></script>
    <script src="{{ asset('admin/assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="index.html" class="app-brand-link">
                <span class=" fs-1 text-black fw-bolder ms-2">MyAdmin</span>
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
              <!-- Dashboard -->
              <li class="menu-item @if (url()->current() === route('admin#dashboard'))
              active @endif">
                <a href="{{ route('admin#dashboard') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Dashboard</div>
                </a>
              </li>

              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Admin</span>
              </li>

               {{-- home slider --}}
               <li class="menu-item  @if (
                url()->current() === route('admin#homeSliders#createPage') ||
                url()->current() === route('admin#homeSliders#list') || Str::startsWith(url()->current(), route('admin#homeSliders#update'))
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='bx bx-home me-2'></i>
                  <div data-i18n="Account Settings">Home Slider</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if (url()->current() === route('admin#homeSliders#createPage'))
                    active @endif">
                    <a href="{{ route('admin#homeSliders#createPage') }}" class="menu-link">
                      <div data-i18n="Connections">Create</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#homeSliders#list'))
                    active @endif">
                    <a href="{{ route('admin#homeSliders#list') }}" class="menu-link">
                      <div data-i18n="Connections">Slider List</div>
                    </a>
                  </li>
                </ul>
              </li>

              {{-- admin account --}}
              <li class="menu-item
                @if (
                url()->current() === route('admin#account#profile') ||
                url()->current() === route('admin#account#edit') ||
                url()->current() === route('admin#account#changePasswordPage') ||
                url()->current() === route('admin#account#userList') ||
                Str::startsWith(url()->current(), route('admin#account#profileViaList'))
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-dock-top"></i>
                  <div data-i18n="Account Settings">Account Setting</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if (url()->current() === route('admin#account#profile'))
                    active @endif">
                    <a href="{{ route('admin#account#profile') }}" class="menu-link">
                      <div data-i18n="Account">Profile</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#account#edit')) active @endif">
                    <a href="{{ route('admin#account#edit') }}" class="menu-link">
                      <div data-i18n="Notifications">Edit</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#account#changePasswordPage'))
                    active @endif">
                    <a href="{{ route('admin#account#changePasswordPage') }}" class="menu-link ">
                      <div data-i18n="Connections">Change Password</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#account#userList'))
                    active @endif">
                    <a href="{{ route('admin#account#userList') }}" class="menu-link ">
                      <div data-i18n="Connections">Admin & User List</div>
                    </a>
                  </li>
                </ul>
              </li>

              {{-- admin category --}}
              <li class="menu-item  @if (
                url()->current() === route('admin#category#createPage') || url()->current() === route('admin#category#categoryList') || url()->current() === route('admin#category#subCategoryList') ||
                Str::startsWith(url()->current(), route('admin#category#update')) ||  Str::startsWith(url()->current(), route('admin#category#subCategoryUpdate'))
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-category-alt"></i>
                  <div data-i18n="Account Settings">Category & Sub-Category</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if (url()->current() === route('admin#category#createPage'))
                    active @endif">
                    <a href="{{ route('admin#category#createPage') }}" class="menu-link">
                      <div data-i18n="Connections">Create</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#category#categoryList'))
                    active @endif">
                    <a href="{{ route('admin#category#categoryList') }}" class="menu-link">
                      <div data-i18n="Connections">Category List</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#category#subCategoryList'))
                    active @endif">
                    <a href="{{ route('admin#category#subCategoryList') }}" class="menu-link">
                      <div data-i18n="Connections">Sub Category List</div>
                    </a>
                  </li>
                </ul>
              </li>

               {{-- product --}}
               <li class="menu-item  @if (
                url()->current() === route('admin#product#createPage') || url()->current() === route('admin#product#list') ||  Str::startsWith(url()->current(), route('admin#product#update'))
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='bx bxl-product-hunt me-2'></i>
                    <div data-i18n="Account Settings">Product</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if (url()->current() === route('admin#product#createPage'))
                    active @endif">
                    <a href="{{ route('admin#product#createPage') }}" class="menu-link">
                      <div data-i18n="Connections">Create</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#product#list'))
                    active @endif">
                    <a href="{{ route('admin#product#list') }}" class="menu-link">
                      <div data-i18n="Connections">Product List</div>
                    </a>
                  </li>
                </ul>
               </li>

               {{-- order --}}
               <li class="menu-item  @if (
                url()->current() === route('admin#order#orderList')
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='bx bxs-food-menu me-2'></i>
                    <div data-i18n="Account Settings">Order</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item @if (url()->current() === route('admin#order#orderList'))
                        active @endif">
                        <a href="{{ route('admin#order#orderList') }}" class="menu-link">
                          <div data-i18n="Connections">Order List</div>
                        </a>
                    </li>
                </ul>
               </li>

              {{-- offers --}}
              <li class="menu-item  @if (
                url()->current() === route('admin#offers#createPage') ||
                url()->current() === route('admin#offers#list') ||
                Str::startsWith(url()->current(), route('admin#offers#update'))
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='bx bxs-offer me-2'></i>
                  <div data-i18n="Account Settings">Offer & Coupon</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if (url()->current() === route('admin#offers#createPage'))
                    active @endif">
                    <a href="{{ route('admin#offers#createPage') }}" class="menu-link">
                      <div data-i18n="Connections">Create</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#offers#list'))
                    active @endif">
                    <a href="{{ route('admin#offers#list') }}" class="menu-link">
                        <div data-i18n="Connections">Offers List</div>
                    </a>
                  </li>
                </ul>
              </li>

              {{-- blog --}}
              <li class="menu-item  @if (
                url()->current() === route('admin#blog#createPage') || url()->current() === route('admin#blog#list') ||
                Str::startsWith(url()->current(), route('admin#blog#updatePage'))
                )
                active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='bx bxl-blogger me-2'></i>
                  <div data-i18n="Account Settings">Blog</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item @if (url()->current() === route('admin#blog#createPage'))
                    active @endif">
                    <a href="{{ route('admin#blog#createPage') }}" class="menu-link">
                      <div data-i18n="Connections">Create</div>
                    </a>
                  </li>
                  <li class="menu-item @if (url()->current() === route('admin#blog#list'))
                    active @endif">
                    <a href="{{ route('admin#blog#list') }}" class="menu-link">
                      <div data-i18n="Connections">Blog List</div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
            <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="bx bx-menu bx-sm"></i>
                </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">
                    <h2 class="fw-bold mb-0 fs-1 ">Dashboard</h2>
                    </div>
                </div>
                <!-- /Search -->

                 <!-- / Navbar -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                        <img
                        @if (Auth::user()->image === null)
                            @if (Auth::user()->gender === 'male')
                                src="{{ asset('user_male_default.png') }}"
                            @elseif (Auth::user()->gender === 'female')
                                src="{{ asset('default_user_female.svg') }}"
                            @endif
                        @else
                            src="{{ asset('storage/admin/account/'.Auth::user()->image)}}"
                        @endif
                        alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                <img
                                @if (Auth::user()->image === null)
                                    @if (Auth::user()->gender === 'male')
                                        src="{{ asset('user_male_default.png') }}"
                                    @elseif (Auth::user()->gender === 'female')
                                        src="{{ asset('default_user_female.svg') }}"
                                    @endif
                                @else
                                    src="{{ asset('storage/admin/account/'.Auth::user()->image)}}"
                                @endif
                                alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div >
                                <span class="fw-semibold d-block">{{ Str::ucfirst(Auth::user()->name) }}</span>
                            </div>
                            </div>
                        </a>
                        </li>
                        <li>
                        <div class="dropdown-divider"></div>
                        </li>
                        <li>
                        <a class="dropdown-item" href="{{ route('admin#account#profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('user#home') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">User Home</span>
                            </a>
                            </li>
                        <li>
                        <div class="dropdown-divider"></div>
                        </li>
                        <li>
                        <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                            @csrf
                        <button type="submit" class="btn btn-dark btn-sm ">
                                <i class="bx bx-power-off me-2"></i>
                                <span >Logout</span>
                        </button>
                        </form>
                        </li>
                    </ul>
                    </li>
                    <!--/ User -->
                </ul>


                </div>
            </nav>
            <!-- Content wrapper -->
            @yield('content')
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('admin/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @yield('script')
  </body>
</html>
