<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand text-oswald" href="#"><img style="height:35px;" src="{{ asset('images/WAH.png') }}" alt=""> Wireless Access for Health </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ml-auto mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{route('faq')}}">Faq</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>
        </ul>
    </div>
</nav>
