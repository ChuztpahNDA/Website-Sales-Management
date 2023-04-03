<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-xl-block sidebar collapse bg-white">
    <div class="position-sticky">
        <ul class="list-group list-group-flush">
            <!-- Separator with title -->
            <li class="list-group-item d-flex align-items-center menu-collapsed"
                style="background-color: rgb(37, 253, 116)">
                <small>MAIN MENU</small>
            </li>
            <!-- /END Separator -->

            <!-- Menu with submenu -->
            <a class="list-group-item list-group-item-action list-group-item-success" href="{{ route('indexAdmin') }}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3" style="margin-right: 5px"></span>
                    <span class="menu-collapsed">Trang Chủ</span>
                </div>
            </a>
            <!-- Products -->
            <a href="#submenu_products" data-bs-toggle="collapse" aria-expanded="false"
                class="list-group-item list-group-item-action list-group-item-success">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-cubes" style="margin-right: 5px"></span>
                    <span class="menu-collapsed">Sản phẩm</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu Products -->
            <div id='submenu_products' class="collapse nav-item list-group" data-bs-parent="#body-row">
                <a href="{{ route('getProducts') }}" class="list-group-item text-black">
                    <span class="menu-collapsed">Danh sách sản phẩm</span>
                </a>
                <a href="{{ route('addProducts') }}" class="list-group-item text-black">
                    <span class="menu-collapsed">Tạo sản phẩm mới</span>
                </a>
            </div>

            <!-- Customers -->
            <a href="#submenu_customers" data-bs-toggle="collapse" aria-expanded="false"
                class="list-group-item list-group-item-action list-group-item-success">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3" style="margin-right: 5px"></span>
                    <span class="menu-collapsed">Khách hàng</span>
                </div>
            </a>
            <!-- Submenu Customers-->
            <div id='submenu_customers' class="collapse sidebar-submenu" data-bs-parent="#body-row">
                <a href="{{ route('getCustomers') }}" class="list-group-item text-black">
                    <span class="menu-collapsed">Danh sách khách hàng</span>
                </a>
                <a href="{{ route('addCustomers') }}" class="list-group-item text-black">
                    <span class="menu-collapsed">Tạo khách hàng mới</span>
                </a>
            </div>

            <!-- Orders -->
            <a href="#submenu_orders" data-bs-toggle="collapse" aria-expanded="false"
                class="list-group-item list-group-item-action list-group-item-success">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-shopping-basket fa-fw mr-3" style="margin-right: 5px"></span>
                    <span class="menu-collapsed">Đơn hàng</span>
                </div>
            </a>
            <!-- Submenu Orders -->
            <div id='submenu_orders' class="collapse sidebar-submenu" data-bs-parent="#body-row">
                <a href="{{ route('getOrders') }}" class="list-group-item text-black">
                    <span class="menu-collapsed">Danh sách đơn hàng</span>
                </a>
                <a href="{{ route('getAddOrders') }}" class="list-group-item text-black">
                    <span class="menu-collapsed">Tạo đơn hàng mới</span>
                </a>
            </div>

            <li class="list-group-item d-flex align-items-center menu-collapsed"
                style="background-color: rgb(37, 253, 116)">
                <small>BÁO CÁO</small>
            </li>
            <!-- /END Separator -->
            <a href="{{route('revenue')}}" class="list-group-item list-group-item-action list-group-item-success">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-newspaper-o fa-fw mr-3" style="margin-right: 5px"></span>
                    <span class="menu-collapsed">Doanh Thu - Lợi nhận</span>
                </div>
            </a>
            {{-- <a href="{{route('benefit')}}" class="list-group-item list-group-item-action list-group-item-success">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-usd fa-fw mr-3" style="margin-right: 5px"></span>
                    <span class="menu-collapsed">Lợi Nhuận</span>
                </div>
            </a> --}}
        </ul><!-- List Group END-->
    </div>
</nav>
<!-- Sidebar -->
