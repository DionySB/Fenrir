<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('home') }}">
        <h1>Vida<span class="c-color-1">FIT </span>Academia</h1>
      </a>
      <span class="navbar-separator"></span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('gyms') }}">Academias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Contato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">Sobre Nós</a>
          </li>
        </ul>
        
        <ul class="navbar-nav ml-auto">
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
          @endguest
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" id="btn-outline-success-inline" type="submit">Search</button>
        </form>
      </div>
    </div>

    <div class="navbar-bottom-line"></div>

  </nav>