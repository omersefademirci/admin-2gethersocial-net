<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="seller-list.html#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Anything Here..." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="/">
                    <img class="for-light" style="max-width: 80px"
                            src="{{ asset('assets/images/customs/logo.webp') }}" alt="">
                    <img class="for-dark" style="max-width: 80px"
                            src="{{ asset('assets/images/customs/logo.webp') }}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar">&raquo;<i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>

        </div>
        <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div class="notification-slider">
                <div class="d-flex h-100"> <img src="{{ asset('assets/images/giftools.gif') }}" alt="gif">
                    <h6 class="mb-0 f-w-400"><span class="font-primary">v4.2&nbsp;</span> <span
                            class="f-light">{{__('custom.version_note')}}</span></h6><i class="icon-arrow-top-right f-light"></i>
                </div>
            </div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li class="language-nav">
                    <div class="translate_wrapper">
                        @if (Session::get('locale') == 'tr')
                            <a href="{{ route('change-language', ['locale' => 'en']) }}" class="lang">
                                <i class="flag-icon flag-icon-us"></i>
                                <span class="lang-txt">EN</span>
                            </a>
                        @else
                            <a href="{{ route('change-language', ['locale' => 'tr']) }}" class="lang">
                                <i class="flag-icon flag-icon-tr"></i>
                                <span class="lang-txt">TR</span>
                            </a>
                        @endif
                    </div>
                </li>
                
                <li class="fullscreen-body"> <span>
                        <svg id="maximize-screen">
                            <use href="{{ asset('assets/svg/icon-sprite.svg#full-screen') }}"></use>
                        </svg></span></li>
                <li>
                <div class="mode">
                    <svg>
                        <use href="{{ asset('assets/svg/icon-sprite.svg#moon') }}"></use>
                    </svg>
                </div>
                </li>

                <li class="profile-nav onhover-dropdown pe-0 py-0">
                    <div class="d-flex profile-media">
                        <img class="b-r-10" src="{{ asset('assets/images/dashboard/profile.png') }}" alt="">
                        <div class="flex-grow-1">
                            <span>{{ Auth::user()->name }}</span> <!-- Kullanıcının adı burada görüntülenir -->
                            <p class="mb-0">{{ Auth::user()->role ?? __('custom.user') }} <i class="middle fa-solid fa-angle-down"></i></p> <!-- Rol bilgisi yoksa "User" olarak göster -->
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <!-- Logout link -->
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i>
                                <span>{{__('custom.logout')}}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout işlemi için form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends -->
