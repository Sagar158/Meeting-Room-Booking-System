<nav class="settings-sidebar">
    <div class="sidebar-body">
      <a href="#" class="settings-sidebar-toggler">
        <i data-feather="settings"></i>
      </a>
      <h6 class="text-muted">Sidebar:</h6>
      <div class="form-group border-bottom">
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
            Light
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
            Dark
          </label>
        </div>
      </div>
      <div class="theme-wrapper">
        <h6 class="text-muted mb-2">Light Theme:</h6>
        <a class="theme-item {{ (Session::has('theme') && (Session::get('theme') == 'light')) ? 'active' : '' }}" href="{{ route('theme.change', 'light') }}">
          <img src="{{ asset('assets/images/screenshots/light.jpg') }}" alt="light theme">
        </a>
        <h6 class="text-muted mb-2">Dark Theme:</h6>
        <a class="theme-item {{ (Session::has('theme') && (Session::get('theme') == 'dark')) ? 'active' : '' }}" href="{{ route('theme.change','dark') }}">
          <img src="{{ asset('assets/images/screenshots/dark.jpg') }}" alt="dark theme">
        </a>
      </div>
    </div>
  </nav>
