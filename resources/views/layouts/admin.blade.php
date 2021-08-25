<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="brumultiverse">
    <meta name="author" content="william">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BRUMUTLIVERSE') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    @livewireStyles
    @yield('top')
    <!-- Favicon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon" type="image/png">
    <link rel="stylesheet" href="{{ asset('/css/custom-bs.css') }}"/>
    <link href="/css/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <style>
        /* .swal2-popup,.swal2-content, .swal2-footer,.swal2-actions, .swal2-actions>div {
            padding: 0px !important;
            margin:0px !important;
        } */
        /* .swal2-header{
            padding-top: 10px !important;
        } */
        .swal2-icon{
            width: 50px;
            height: 50px;
        },
        .swal2-styled, .swal2-confirm, .swal2-cancel{
            padding:0px 0px !important;
        }
    </style>
    
</head>

<body id="page-top" class="sidebar-toggled">
    @include('sweetalert::alert')
    <div id="pp">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 p-4 " style="background:url('/img/card-bg-custom.png');
            background-size: cover;">
                <div>
                    Please read our <a href="/privacy-policy" target="_blank">Privacy Policy</a> first. By continuing to browse this site and/or clicking I AGREE, you guarantee that you have read and understood our Privacy Policy and that you consent to its terms.
                </div>
                <button class="btn btn-primary mt-5" onclick="ppAgree()">I AGREE</button>
            </div>
        </div>
    </div>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul id="sidenav" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <x-logo style="max-width: 40px;border-radius:50%;box-shadow:0px 0px 5px 5px #5C07A2" />
            </div>
            <div class="sidebar-brand-text mx-3">BRUMultiverse</div>
        </a>


        <!-- Nav Item - Dashboard -->
        <x-sidebar.navitem link="{{ route('home') }}" label="Dashboard">
            <img src="{{ asset('img/icons/dashboard.png') }}" alt="" class="icon">
        </x-sidebar.navitem>


        <x-sidebar.navitem link="{{ route('events.index') }}" label="Events">
            <img src="{{ asset('img/icons/event.png') }}" alt="" class="icon">
        </x-sidebar.navitem>


        <x-sidebar.navitem link="{{ route('marketing.index') }}" label="Marketing">
           <i class="fa fa-bullhorn" style="font-size:24px;color:white"></i>
        </x-sidebar.navitem>


        <x-sidebar.navitem link="{{ route('profile') }}" label="Profile">
            <img src="{{ asset('img/icons/profile.png') }}" alt="" class="icon">
        </x-sidebar.navitem>

        <x-sidebar.navitem label="Logout">
            <i class="fas fa-sign-out-alt"  style="font-size:24px;color:white" onclick="document.getElementById('logout-form').submit()"></i>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </x-sidebar.navitem>


        <!-- Sidebar Toggler (Sidebar) -->
        {{-- <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div> --}}

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" style="background: #ddd;">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-dark bg-primary topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-1">
                        <a href="/" class="nav-link ">Home</a>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                        
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Notifications
                            </h6>
                            
                            @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notif)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $notif->created_at->format('M d, Y') }}</div>
                                        {!! $notif->data['message'] !!}
                                    </div>
                                </a>
                            @empty
                                <div class="text-center mt-2">
                                    No Notification found
                                </div>
                            @endforelse
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>
                    @livewire('notification-message')
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
                    </li> --}}


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            @if(!auth()->user()->picture)
                                <figure class="rounded-circle avatar avatar font-weight-bold"  data-initial="{{ Auth::user()->first_name[0] }}"></figure>
                            @else
                            {{ auth()->user()->picture }}
                                <x-avatar image="{{ auth()->user()->picture }}"/>
                            @endif
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('main-content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-primary text-white">
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

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script>

    $('#pp, #pp > *').hide(100)

    if(Cookies.get('pp') == undefined){
       setTimeout(function(){
           $('#pp, #pp> *').show();
       }, 5000);
    }
    function ppAgree(){
       $('#pp').hide(500);
       Cookies.set('pp', '1', { expires: 365 });
    }
    let click = 0;
    $('#admin').click(function(){
        click++;
        if(click == 3){
            window.location.href = "/admin/login";
        }
    })

</script>

<script>
    window.onload = function(){
        $('.loader-container').fadeOut(1000);
    }
</script>
<script>
    const swal = Swal.mixin({
        position: 'top',
        padding:'0.5em',
        background:"url('{{ asset('/img/modal-bg-custom.png') }}')"
    })
</script>
@livewireScripts
@yield('bottom')
</body>
</html>
