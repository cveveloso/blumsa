<ul class="navbar-nav bg-gradient-orange sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Blumsa Admin</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>@lang('admin.dashboard')</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    @lang('admin.catalog')
  </div>

  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/catalog/products/list') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>@lang('admin.products')</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-orage py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ url('/admin/catalog/products/list') }}">@lang('admin.products')</a>
        <a class="collapse-item" href="{{ url('/admin/catalog/products/add') }}">@lang('admin.newproduct')</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/catalog/category/') }}">
      <i class="fas fa-fw fa-map"></i>
      <span>@lang('admin.categories')</span>
    </a>    
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttributes" aria-expanded="true" aria-controls="collapseAttributes">
      <i class="fas fa-fw fa-cog"></i>
      <span>@lang('admin.attributes')</span>
    </a>
    <div id="collapseAttributes" class="collapse" aria-labelledby="headingAttributes" data-parent="#accordionSidebar">
      <div class="bg-orage py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ url('/admin/catalog/attributegroup') }}">@lang('admin.attributegroups')</a>
        <a class="collapse-item" href="{{ url('/admin/catalog/attribute') }}">@lang('admin.attributes')</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Heading -->
  <div class="sidebar-heading">
    @lang('admin.users')
  </div>

  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/user') }}">
      <i class="fas fa-fw fa-user"></i>
      <span>@lang('admin.users')</span>
    </a>    
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin/customer') }}">
      <i class="fas fa-fw fa-user"></i>
      <span>@lang('admin.customers')</span>
    </a>    
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>