<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('profile.edit')}}">Profile</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method=" POST">
            @csrf
            <a class="nav-link" href="{{route('logout')}}">{{ __('Log Out') }}</a>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>