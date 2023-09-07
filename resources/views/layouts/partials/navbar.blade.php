<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/home">Expense Tracker App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tracker App
          </a>
          <ul class="dropdown-menu">
          @auth
            <li><a class="dropdown-item" href="/budget">Insert Montly Budget</a></li>
            <li><a class="dropdown-item" href="/expenses/create">Register Expense</a></li>
            <li><a class="dropdown-item" href="/expenses/view">View my expenses</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Reports</a></li>
            <li><a class="dropdown-item" href="/analytics">Analytics</a></li>
            @endauth
          </ul>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>-->
      </ul>
      <form class="d-flex" role="search">
      @auth
        <a href="/expenses/create" class="btn btn-outline-primary" type="submit">+Add</a>
        @endauth
        <ul class="navbar-nav me-5 mb-2 mb-lg-0">
    @auth
    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{auth()->user()->name ?? auth()->user()->username }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </li>
    @endauth
        
      
      </form>
    </div>
  </div>
</nav>