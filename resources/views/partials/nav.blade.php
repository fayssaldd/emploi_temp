<nav class="navbar z-3 position-fixed w-100 navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Gestion emploi</a>
      <ul class="navbar-nav mr-auto w-100 d-flex justify-content-end">
        @auth
        <li class="nav-item dropleft">
          <a class="nav-link  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars"></i>
          </a>
        
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a href="{{route('filier.index')}}" class="dropdown-item">filiers</a>
          <a href="{{route('formateurs.index')}}" class="dropdown-item">formateur</a>
          <a href="{{route('groups.index')}}" class="dropdown-item">Groupes</a>
          <a href="{{route('salles.index')}}" class="dropdown-item">Salles</a>
          <a href="{{route('seances.index')}}"class="dropdown-item">Emploi</a>
          <div class="dropdown-divider"></div>
          <a href="{{route('admins.show',Auth::id())}}"class="dropdown-item">
            <i class="fa fa-user "></i><span class=" ml-2">  Mon Compte</span>
          </a>
            
          <a href="{{route('login.logout')}}" class="dropdown-item">
            <i class="fa fa-sign-out "></i><span class=" ml-2">Déconnexion</span>
          </a>
          
          </div>
        </li>
        @endauth
      </ul>
  </nav>