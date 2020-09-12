<div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="/" style="line-height: 25px;">
            <div class="d-table m-auto">
                <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="/img/shards-dashboards-logo.svg" alt="Gamelelo">
                <span class="d-none d-md-inline ml-1">Gamelelo</span>
            </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
            <i class="material-icons">arrow_back</i>
        </a>
    </nav>
</div>
<div class="nav-wrapper">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link " href="#">
                <i class="material-icons">store</i>
                <span>Orders</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="#">
                <i class="material-icons">local_shipping</i>
                <span>Shipments</span>
            </a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >
                <i class="material-icons">view_list</i>
                <span class="d-md-inline-block">Products</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small">
                <a class="dropdown-item bg-light" href="{{ route('admin.products') }}">
                    <i class="material-icons">&#xE879;</i>
                    View Products
                </a>
                <a class="dropdown-item bg-light" href="{{ route('admin.products.add') }}">
                    <i class="material-icons">&#xE7FD;</i>
                    Add Product
                </a>
            </div>
        </li>


        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >
                <i class="material-icons">view_array</i>
                <span class="d-md-inline-block">Categories</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small">
                <a class="dropdown-item bg-light" href="{{ route('admin.categories') }}">
                    <i class="material-icons">&#xE879;</i>
                    View Categories
                </a>
                <a class="dropdown-item bg-light" href="{{ route('admin.categories.add') }}">
                    <i class="material-icons">&#xE7FD;</i>
                    Add Category
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.users') }}">
                <i class="material-icons">people</i>
                <span>Customers</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link " href="#">
                <i class="material-icons">card_giftcard</i>
                <span>Offers</span>
            </a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" >
                <i class="material-icons">view_carousel</i>
                <span class="d-md-inline-block">Pages</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small">
                <a class="dropdown-item bg-light" href="{{ route('admin.pages.sections') }}">
                    <i class="material-icons">view_module</i>
                    Page Sections
                </a>
                <a class="dropdown-item bg-light" href="{{ route('admin.pages.sections.add') }}">
                    <i class="material-icons">note_add</i>
                    Add Page Section
                </a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="#">
                <i class="material-icons">settings_applications</i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>