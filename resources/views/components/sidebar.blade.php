<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text-->  --}}
            <span class="brand-text fw-light">Praxxy Exam</span> <!--end::Brand Text--> </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item"> <a href="./generate/theme.html" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- <li class="nav-item"> <a href="./generate/theme.html" class="nav-link">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>Create Product</p>
                    </a>
                </li> --}}
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam"></i>
                        <p>
                            Products
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/product" class="nav-link">
                                <i class="nav-icon bi bi-card-list"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/product/create" class="nav-link">
                                <i class="nav-icon bi bi-pencil-square"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->
