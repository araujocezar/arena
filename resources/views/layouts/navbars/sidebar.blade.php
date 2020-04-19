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
      <li class="nav-item{{ $activePage == 'inicio' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('inicio') }}">
          <i class=" material-icons">home</i>
          <span class="sidebar-normal">{{ __('Inicio') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">account_circle</i>
          <span class="sidebar-normal">{{ __('Perfil do usuário') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'cadastro-aluno' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cadastro-aluno') }}">
          <i class=" material-icons">person</i>
          <span class="sidebar-normal">{{ __('Cadastrar novo aluno') }} </span>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="false">
          <i class="material-icons" style="color:black;">folder_open</i>
          <p>{{ __('Alunos') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'listagem-alunos' || $activePage == 'listagem-funcional' ||  $activePage == 'listagem-futvolei' ) ? ' show' : '' }}" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'listagem-alunos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('listagem-alunos', 'todos') }}">
                <i class=" material-icons">person</i>
                <span class="sidebar-normal">{{ __('Todos') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'listagem-funcional' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('listagem-alunos', 'funcional') }}">
                <i class=" material-icons">person</i>
                <span class="sidebar-normal">{{ __('Funcional') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'listagem-futvolei' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('listagem-alunos', 'futvolei') }}">
                <i class=" material-icons">person</i>
                <span class="sidebar-normal">{{ __('Futvôlei') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'listagem-plano' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('listagem-plano') }}">
          <i class=" material-icons">folder_open</i>
          <span class="sidebar-normal">{{ __('Planos') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'listagem-aluguel' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('listagem-aluguel') }}">
          <i class=" material-icons">folder_open</i>
          <span class="sidebar-normal">{{ __('Aluguel de quadra') }} </span>
        </a>
      </li>
    </ul>
  </div>
</div>