<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Berkeley-Reagan University or BRU was founded on October 13 by a British teacher, named Henry Berkeley, and an American businessman, named William Reagan, who came to Taguig City, Philippines in 1951.">
    <meta name="author" content="BRUMULTIVERSE">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('top')
    <!-- Favicon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon" type="image/png">
    <style>
        :root {
            --blue:#322F46;
        }
        .bg-primary, .bg-default, .bg-gradient-primary,.btn-primary, .btn-outline-primary:hover, .dropdown-header{
            background:#322F46 !important;
            color: white !important;
        }
        .text-primary, .btn-link {
            color: var(--blue) !important;
        }
        .border-left-primary,.btn-outline-primary {
            border-color: var(--blue) !important;
            color: var(--blue) !important;
        }
        #sidenav {
            background: url('{{ asset('img/sidenav-bg.png') }}') !important;
            background-position:center !important;
            background-size:cover !important;
        }
        .card-bg-custom {
            background: url('{{ asset('img/card-bg-custom.png') }}') !important;
            background-position:center !important;
            background-size:cover !important;
        }
        .card-bg-custom  * {
            color: white !important;
            border-color:white !important;
        }
        .modal-bg-custom{
            background: url('{{ asset('img/modal-bg-custom.png') }}') !important;
            background-position:center !important;
            background-size:cover !important;
        }
        .modal-bg-custom  * {
            color: white !important;
            border-color:white !important;
        }
        .icon {
            max-width: 40px !important;
        }
        .icon-xl {
            max-width: 60px !important;
        }
        .alert-info, .bg-info{
            background:#F0D7F5 !important;
            color: #4A1574 !important;
        }
    </style>
    @livewireStyles
</head>
<body id="page-top">
@include('sweetalert::alert')

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="sidenav">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('img/logo.png') }}" alt="" style="max-width: 40px;border-radius:50%;box-shadow:0px 0px 5px 5px #5C07A2">
            </div>
            <div class="sidebar-brand-text mx-3">BRUMultiverse</div>
        </a>

        <!-- Divider -->
        @if (auth()->user()->allowed('dashboard'))
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('admin.home') }}">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <img src="{{ asset('img/icons/dashboard.png') }}" alt="" class="icon">
                    <span>{{ __('Dashboard') }}</span></a>
            </li>
        @endif
        <!-- Divider -->
       

        @if (auth()->user()->allowed('admin'))
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('admin.tickets.*') }}">
                <a class="nav-link" href="{{ route('admin.tickets.index') }}">
                    <i class="fa fa-sticky-note text-white" style="font-size:24px"></i>
                    <span>{{ __('tickets') }}</span></a>
            </li>
        @endif

        @if (auth()->user()->allowed('admin'))
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.images.menu') }}">
                    <i class="fas fa-fw fa-images" style="font-size:1.5em"></i>
                    <span>Images</span>
                </a>
            </li>
        @endif
        
        <!-- Heading -->
        @if (auth()->user()->allowed('aan'))
        
            <li class="nav-item {{ Nav::isRoute('admin.aan.index') }}">
                <a class="nav-link" href="{{ route('admin.aan.index') }}">
                    <img src="{{ asset('img/icons/aan.png') }}" alt="" class="icon">
                    <span>AAN</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('admin'))
        
            <li class="nav-item {{ Nav::isRoute('admin.admins.index') }}">
                <a class="nav-link" href="{{ route('admin.admins.index') }}">
                    <i class="fa fa-user-secret text-white"  style="font-size:1.5em"></i>
                    <span>Admins</span>
                </a>
            </li>
        @endif

        {{-- <li class="nav-item {{ Nav::isRoute('admin.tags.index') }}">
            <a class="nav-link" href="{{ route('admin.tags.index') }}">
                <i class="fas fa-fw fa-tag"></i>
                <span>Tags</span>
            </a>
        </li> --}}
        @if (auth()->user()->allowed('book'))
            <li class="nav-item {{ Nav::isRoute('admin.books.list') }}">
                <a class="nav-link" href="{{ route('admin.books.list') }}">
                    <img src="{{ asset('img/icons/books.png') }}" alt="" class="icon">
                    <span>Books</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('trailer'))
            <li class="nav-item {{ Nav::isRoute('admin.thrailers.index') }}">
                <a class="nav-link" href="{{ route('admin.thrailers.index') }}">
                    <img src="{{ asset('img/icons/trailer.png') }}" alt="" class="icon">
                    <span>Films</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('art'))
            <li class="nav-item {{ Nav::isRoute('admin.arts.index') }}">
                <a class="nav-link" href="{{ route('admin.arts.index') }}">
                    <img src="{{ asset('img/icons/art.png') }}" alt="" class="icon">
                    <span>Art Scene</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('event'))
            <li class="nav-item {{ Nav::isRoute('admin.events.*') }} active">
                <a class="nav-link" href="{{ route('admin.events.index') }}">
                    <img src="{{ asset('img/icons/event.png') }}" alt="" class="icon">
                    <span>Events</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('bin'))
            <li class="nav-item {{ Nav::isRoute('admin.bin.index') }} active">
                <a class="nav-link" href="{{ route('admin.bin.index') }}">
                    <i class="fas fa-fw fa-trash" style="font-size:1.5em"></i>
                    <span>Bin</span>
                </a>
            </li>
        @endif
        
        {{-- <hr class="sidebar-divider">
        <div class="sidebar-heading">
            {{ __('Genres') }}
        </div> --}}
        
        @if (auth()->user()->allowed('genre'))
            <li class="nav-item {{ Nav::isRoute('admin.songsgenre.*') }}">
                <a class="nav-link" href="{{ route('admin.songsgenre.index') }}">
                    <img src="{{ asset('img/icons/genre.png') }}" alt="" class="icon">
                    <span>Music</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('genre'))
            <li class="nav-item {{ Nav::isRoute('admin.genres.list') }}">
                <a class="nav-link" href="{{ route('admin.genres.list') }}">
                    <img src="{{ asset('img/icons/genre.png') }}" alt="" class="icon">
                    <span>Others</span>
                </a>
            </li>
        @endif

        {{-- <hr class="sidebar-divider">
        <div class="sidebar-heading">
            {{ __('MISC') }}
        </div>
         --}}
        
        @if (auth()->user()->allowed('character'))
            <li class="nav-item {{ Nav::isRoute('admin.characters.*') }}">
                <a class="nav-link" href="{{ route('admin.characters.index') }}">
                    <i class="fa fa-user text-white" style="font-size:20px;"></i>
                    <span>Characters</span>
                </a>
            </li>
        @endif
        @if (auth()->user()->allowed('character'))
            <li class="nav-item {{ Nav::isRoute('admin.group.*') }}">
                <a class="nav-link" href="{{ route('admin.group.index') }}">
                    <i class="fa fa-users text-white" style="font-size:20px;"></i>
                    <span>Groups</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->allowed('recommendation'))
            <li class="nav-item {{ Nav::isRoute('admin.recommendation.*') }}">
                <a class="nav-link" href="{{ route('admin.recommendation.index') }}">
                    <i class="fa fa-star text-white" style="font-size:20px;"></i>
                    <span>Rec. List</span>
                </a>
            </li>
        @endif

        

        {{-- <li class="nav-item {{ Nav::isRoute('admin.genres.list') }}">
            <a class="nav-link" href="{{ route('admin.genres.list') }}">
                <img src="#" alt="" class="icon">
                <span>Characters</span>
            </a>
        </li> --}}
        <!-- Divider -->
        @if (auth()->user()->allowed('message'))
            {{-- <hr class="sidebar-divider">
            <div class="sidebar-heading">
                {{ __('Marketing') }}
            </div> --}}

            <li class="nav-item {{ Nav::isRoute('admin.messages.*') }}">
                <a class="nav-link" href="{{ route('admin.messages.create') }}">
                    <i class="fa fa-envelope text-white" style="font-size:20px;"></i>
                    <span>Message</span>
                </a>
            </li>
        @endif
        

        @if (auth()->user()->allowed('profile'))
            {{-- <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div> --}}

            {{-- <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('admin.about.*') }}">
                <a class="nav-link" href="{{ route('admin.about.index') }}">
                    <i class="fa fa-info-circle text-white" style="font-size:20px;"></i>
                    <span>{{ __('About') }}</span>
                </a>
            </li> --}}
            <li class="nav-item {{ Nav::isRoute('admin.profile') }}">
                <a class="nav-link" href="{{ route('admin.profile') }}">
                    <img src="{{ asset('img/icons/profile.png') }}" alt="" class="icon">
                    <span>{{ __('Profile') }}</span>
                </a>
            </li>

        @endif
        

        <!-- Nav Item - About -->
        {{-- <li class="nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>{{ __('About') }}</span>
            </a>
        </li> --}}

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                {{--  --}}

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    {{-- <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li> --}}
                    <!-- Nav Item - Alerts -->
                     
                    <li class="nav-item">
                        <a href="{{ route('admin.product.index') }}" class="nav-link">
                            <i class="fa fa-store"></i>
                        </a>
                    </li>
                    {{-- <x-notification/> --}}
                    @livewire('admin.notification-message')
                    
                     {{-- <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li> --}}

                    <!-- Nav Item - Messages -->
                    {{-- <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>  --}}

                    {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admin')->user()->full_name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold bg-primary"  data-initial="{{ Auth::guard('admin')->user()->first_name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                        
                            {{-- <a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Activity Log') }}
                            </a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @include('partials.alert')
                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; BRUMULTIVERSE  2020 Tarlac City, Philippines</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
@include('partials.loader')

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script>
    window.onload = function(){
        $('.loader-container').fadeOut(1000);
    }
</script>
@livewireScripts()
@yield('bottom')


</body>
</html>
