<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Arena das Flores') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">account_circle</i>
          <span class="sidebar-normal">{{ __('Perfil do usuário') }} </span>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
          <i class="material-icons" style="color:black;">folder_open</i>
          <p>{{ __('Alunos') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'funcionario-management' || $activePage == 'ingrediente-management' || $activePage == 'item-management' || $activePage == 'secao-management' || $activePage == 'profile' || $activePage == 'user-management' || $activePage == 'restaurante-management' || $activePage == 'mesa-management') ? ' show' : '' }}" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('table') }}">
                <i class=" material-icons">person</i>
                <span class="sidebar-normal">{{ __('Todos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('table') }}">
                <i class=" material-icons">person</i>
                <span class="sidebar-normal">{{ __('Funcional') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('table') }}">
                <i class=" material-icons">person</i>
                <span class="sidebar-normal">{{ __('Futvôlei') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <!-- <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
          <p>{{ __('Typography') }}</p>
        </a>
      </li> -->
    </ul>
  </div>
</div>