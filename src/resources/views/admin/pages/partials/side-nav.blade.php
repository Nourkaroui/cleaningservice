<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li>
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ url('admin/categories') }}">Categories</a>
            </li>

            <li>
                <a href="{{ url('admin/products') }}">Products</a>
            </li>
            <li>
                <a href="{{ url(route('admin.order.show')) }}">Orders</a>
            </li>
            <!-- user drive part-->
            <li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    Users & Drivers
                    <ul class="dropdown-menu">
                        <li id="dropdown-category">
                            <a href="{{ url('admin/users') }}">
                                Users client
                            </a>
                        </li>
                        <li id="dropdown-category">
                            <a href="{{ url('admin/users/drivers') }}">
                                Driver
                            </a>
                        </li>
                        <li id="dropdown-category">
                            <a href="{{ url(route('admin.user.admin')) }}">
                                Administrator Users
                            </a>
                        </li>
                    </ul>
                </a>
            </li>
            </li>
        </ul>
    </div>
