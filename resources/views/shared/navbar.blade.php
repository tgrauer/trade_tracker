
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color fixed-top pt-0">
        <div class="container">
            {{-- <a class="navbar-brand" href="#"><img src="./images/logo.png" alt=""></a> --}}
            <a class="navbar-brand" href="#"><img src="images/logo.png" width="250" height="55" class="d-inline-block align-center" alt=""></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav ml-auto">
                    
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{ url('/home') }}">Home</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!--/.Navbar -->
