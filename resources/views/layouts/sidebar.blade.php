<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="/theme/images/icon/logo.png" alt="ERP" width="75%" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @if(Auth::user()->roleId == '1' || Auth::user()->roleId == '2')
                <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-home"></i>S & M
                        {{--<img class="mr-3" src="/theme/images/realestate-icon.png" width="30" >S & M--}}
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('home')}}">Actions</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->roleId != '4' && Auth::user()->roleId != '5')
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-user-secret"></i>Landlords
                        {{--<img class="mr-3" src="/theme/images/icon3.png" width="30" >LANDLORDS--}}
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/landlords/actions">Actions</a>
                        </li>
                        <li>
                            <a href="/landlords/reports">Reports</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-building"></i>Properties
                        {{--<img class="mr-3" src="/theme/images/architecture.png" width="30" >PROPERTIES--}}
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/properties/actions">Actions</a>
                        </li>
                        <li>
                            <a href="/properties/reports">Reports</a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->roleId == '1' || Auth::user()->roleId == '2' || Auth::user()->roleId == '3')
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-user-circle"></i>Tenants
                        {{--<img class="mr-3" src="/theme/images/Buddy.png" width="30" >TENANTS--}}
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/tenants/actions">Actions</a>
                        </li>
                        <li>
                            <a href="/tenants/reports">Reports</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->roleId == '1')
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-wrench"></i>Back Office
                        {{--<img class="mr-3" src="/theme/images/real-estate-crm-software-support.png" width="30" >BACK OFFICE--}}
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/office/entities">Entities</a>
                        </li>
                        <li>
                            <a href="/office/accounting">Accounting</a>
                        </li>
                        <li>
                            <a href="/office/mpesa">MPESA</a>
                        </li>
                        <li>
                            <a href="/office/financial-reports">Financial Reports</a>
                        </li>
                        <li>
                            <a href="/office/other-reports">Other Reports</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-cogs"></i>System
                        {{--<img class="mr-3" src="/theme/images/settings-5.png" width="30" >SYSTEM--}}
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="/system/setup">Setup</a>
                        </li>
                        <li>
                            <a href="/system/other-actions">Other Actions</a>
                        </li>
                        <li>
                            <a href="/system/communication">Communication</a>
                        </li>
                        <li>
                            <a href="/system/reports">Reports</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>