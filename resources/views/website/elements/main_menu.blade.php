<div class="app-menu navbar-menu">
                <div class="navbar-brand-box">
                    <a href="{{url('/')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="@if(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{env('SETTING_IMAGE')}}{{$site_settings->white_logo}}@else{{env('NO_IMAGE')}}@endif" alt="" height="40" />
                        </span>
                        <span class="logo-lg">
                            <img src="@if(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{env('SETTING_IMAGE')}}{{$site_settings->white_logo}}@else{{env('NO_IMAGE')}}@endif" alt="" height="40" />
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{url('/')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="@if(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{env('SETTING_IMAGE')}}{{$site_settings->white_logo}}@else{{env('NO_IMAGE')}}@endif" alt="" height="40" />
                        </span>
                        <span class="logo-lg">
                            <img src="@if(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{env('SETTING_IMAGE')}}{{$site_settings->white_logo}}@else{{env('NO_IMAGE')}}@endif" alt="" height="40" />
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>
                <div id="scrollbar">
                    <div class="container-fluid">
                        <div id="two-column-menu"></div>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link @if (isset($title) && $title == 'Dashboard') {{ 'active' }}@else{{ '' }} @endif" href="{{route('website.dashboard.index')}}">
                                    <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link @if (isset($title) && $title == 'Client List') {{ 'active' }}@else{{ '' }} @endif" href="{{route('website.clients.index')}}">
                                    <i class="ri-team-line"></i> <span>Clients</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link @if (isset($title) && $title == 'Invite Client') {{ 'active' }}@else{{ '' }} @endif" href="{{route('website.clients.invite')}}">
                                    <i class="ri-mail-send-line"></i> <span>Invite Client</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link @if (isset($title) && $title == 'URL List') {{ 'active' }}@else{{ '' }} @endif" href="{{route('website.urls.index')}}">
                                    <i class="ri-link-m"></i> <span>URLs</span>
                                </a>
                            </li>
                            @if($canGenerateShortUrl)
                            <li class="nav-item">
                                <a class="nav-link menu-link @if (isset($title) && $title == 'Generate URL') {{ 'active' }}@else{{ '' }} @endif" href="{{route('website.urls.generate')}}">
                                    <i class="ri-link-m"></i> <span>Generate URL</span>
                                </a>
                            </li>
                            @endif
                            @if($canSeeSettings)
                            <li class="nav-item">
                                <a class="nav-link menu-link @if (isset($title) && $title == 'Settings') {{ 'active' }}@else{{ '' }} @endif" href="{{route('website.settings.edit')}}">
                                    <i class="ri-settings-3-line"></i> <span>Settings</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>

                <div class="sidebar-background"></div>
            </div>
