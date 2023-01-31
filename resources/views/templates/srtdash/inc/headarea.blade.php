            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>                      
                    <div class="col-sm-6 clearfix">
                        @auth
                        <div class="user-profile pull-right dropdown">
                            <h4 class="user-name dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <!-- <a class="dropdown-item" href="">Settings</a> -->
                                <a class="dropdown-item" href="{{route('users.editmyprofile')}}">Perfil</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}                 
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endauth
                        @guest
                        <div class="user-profile pull-right">
                            <a href="{{ route('login') }}"><h4 class="user-name">Entrar</h4></a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- header area end -->