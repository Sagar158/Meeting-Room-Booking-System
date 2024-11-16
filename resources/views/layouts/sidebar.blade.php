<nav class="sidebar">
    <div class="sidebar-header">
      <a href="{{ route('employees.index') }}" class="sidebar-brand">
        <img src="{{asset('assets/images/laravel-2.svg')}}" class="height-40">
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item {{ request()->is('employees/*') ? 'active' : '' }}">
          <a href="{{ route('employees.index') }}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Employees</span>
          </a>
        </li>
    </ul>
    </div>
</nav>
