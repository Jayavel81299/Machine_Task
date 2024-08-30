  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Route::is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @if(auth()->user()->role == 'admin')
      <li class="nav-item">
        <a class="nav-link {{ Route::is('users.*') ? '' : 'collapsed' }}" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Team Members</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users-nav" class="nav-content {{ Route::is('users.*') ? 'show' : 'collapse' }}" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('users.create') }}" class="{{ Route::is('users.create') || Route::is('users.edit') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Add</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="{{ Route::is('users.index') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>List</span>
                </a>
            </li>
        </ul>
      </li>
      @endif

      @if(auth()->user()->role == 'admin' || auth()->user()->role == 'project_manager')
      <li class="nav-item">
        <a class="nav-link {{ Route::is('projects.*') ? '' : 'collapsed' }}" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Project Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="projects-nav" class="nav-content {{ Route::is('projects.*') ? 'show' : 'collapse' }}" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('projects.create') }}" class="{{ Route::is('projects.create') || Route::is('projects.edit') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Add</span>
                </a>
            </li>
            <li>
                <a href="{{ route('projects.index') }}" class="{{ Route::is('projects.index') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>List</span>
                </a>
            </li>
        </ul>
      </li>
      @endif

      <li class="nav-item">
        <a class="nav-link {{ Route::is('tasks.*') ? '' : 'collapsed' }}" data-bs-target="#tasks-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Task Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tasks-nav" class="nav-content {{ Route::is('tasks.*') ? 'show' : 'collapse' }}" data-bs-parent="#tasks-nav">
            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'project_manager')
            <li>
                <a href="{{ route('tasks.create') }}" class="{{ Route::is('tasks.create') || Route::is('tasks.edit') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>Add</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('tasks.index') }}" class="{{ Route::is('tasks.index') ? 'active' : '' }}">
                    <i class="bi bi-circle"></i><span>List</span>
                </a>
            </li>
        </ul>
      </li>
    </ul>
  </aside>