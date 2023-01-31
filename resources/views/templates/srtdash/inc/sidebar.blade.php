        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <!-- <a href=""><img src="{{URL::asset('assets/images/icon/logo.png')}}" alt="logo"></a> -->
                    <a href="{{route('home')}}"><h3>app teste</h3></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                        @guest
                            <li>
                                <a href="{{route('login')}}"><i class="ti-user"></i><span>Entrar</span></a>
                            </li>
                        @endguest
                        @if ($active == 'dashbord')
                            <li class="active">
                        @else
                            <li>
                        @endif
                                <a href="{{route('home')}}"><i class="ti-home"></i><span>Home</span></a>
                            </li>
                        @if ($active == 'products')
                            <li class="active">
                        @else
                            <li>
                        @endif
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-package"></i><span>Produtos</span></a>
                                <ul class="collapse">
                                @if ($active == 'products' && $activeList == 'Listagem')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                        <a href="{{route('products.index')}}">Listagem</a></li>
                                @if ($active == 'products' && $activeList == 'Cadastro')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                        <a href="{{route('products.create')}}">Cadastro</a></li>
                        @auth
                            @if(!Auth::user()->admin)
                                @if ($active == 'products' && $activeList == 'Meus Produtos')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                        <a href="{{route('products.myproducts')}}">Meus Produtos</a></li>
                            @endif
                        @endauth
                                </ul>
                            </li>
                @auth
                    @if(Auth::user()->admin)
                        @if ($active == 'users')
                            <li class="active">
                        @else
                            <li>
                        @endif
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pulse"></i><span>Usuários</span></a>
                                <ul class="collapse">
                                @if ($active == 'users' && $activeList == 'Listagem')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                        <a href="{{route('users.index')}}">Listagem</a></li>
                                @if ($active == 'users' && $activeList == 'Cadastro')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                        <a href="{{route('users.create')}}">Cadastro</a></li>
                                </ul>
                            </li>
                    @endif
                @endauth
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->