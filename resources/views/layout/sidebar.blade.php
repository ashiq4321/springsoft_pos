<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <img src="{{ asset('uploads/logo/') }}/{{ $setting->site_logo }}" class="rounded-circle"
                style="width: 60%">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- Admin Dashboard -->
    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item {{ active_class(['/']) }}">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                

                <li class="nav-item nav-category">Sale management</li>
                <!-- Admin Sale-->
                <li class="nav-item {{ active_class(['sales/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#sales" role="button"
                        aria-expanded="{{ is_active_route(['sales/*']) }}" aria-controls="sales">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Sale</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['sales/*']) }}" id="sales">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="/sales" class="nav-link {{ active_class(['sales']) }}">Sale List</a>
                            </li>
                            <li class="nav-item">
                                <a href="/pos" class="nav-link {{ active_class(['sales']) }}">POS</a>
                            </li>
                            <li class="nav-item">
                                <a href="/sales/add" class="nav-link {{ active_class(['sales']) }}">Add Sale</a>
                            </li>

                            <li class="nav-item">
                                <a href="/giftcard" class="nav-link {{ active_class(['sales']) }}">Gift Card List</a>
                            </li>
                            <li class="nav-item">
                                <a href="/coupon" class="nav-link {{ active_class(['sales']) }}">Coupon List</a>
                            </li>
                            <li class="nav-item">
                                <a href="/delivery" class="nav-link {{ active_class(['sales']) }}">Delivery List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Admin Product-->
                
                <li class="nav-item {{ active_class(['product/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#product" role="button"
                        aria-expanded="{{ is_active_route(['product/*']) }}" aria-controls="product">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Product</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['product/*']) }}" id="product">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('admin.productCategory') }}"
                                    class="nav-link {{ active_class(['product']) }}">Category</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.productBrand') }}"
                                    class="nav-link {{ active_class(['product']) }}">Brand</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addProduct') }}"
                                    class="nav-link {{ active_class(['product']) }}">Add Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.productList') }}"
                                    class="nav-link {{ active_class(['product']) }}">Product List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/add_Adjustment') }}" class="nav-link">Add Adjustment</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/Adjustment/list') }}" class="nav-link">Adjustment List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/stock_count') }}" class="nav-link">Stock Count</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Admin Purchase-->
                <li class="nav-item nav-category">Purchase management</li>
                <li class="nav-item {{ active_class(['purchase/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#purchase" role="button"
                        aria-expanded="{{ is_active_route(['purchase/*']) }}" aria-controls="purchase">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Purchase</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['purchase/*']) }}" id="purchase">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('purchase.add') }}"
                                    class="nav-link {{ active_class(['purchase']) }}">Add Purchase</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.purchaseList') }}"
                                    class="nav-link {{ active_class(['purchase']) }}">Purchase List</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- Admin Expense-->
                <li class="nav-item {{ active_class(['expense/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#expense" role="button"
                        aria-expanded="{{ is_active_route(['expense/*']) }}" aria-controls="expense">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Expense</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['expense/*']) }}" id="expense">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('admin.expenseCategory') }}"
                                    class="nav-link {{ active_class(['expense']) }}">Expense Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addExpense') }}"
                                    class="nav-link {{ active_class(['expense']) }}">Add Expense</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.expenseList') }}"
                                    class="nav-link {{ active_class(['expense']) }}">ExpenseList</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <!-- Admin Return-->
                <li class="nav-item nav-category">Purchase management</li>
                <li class="nav-item {{ active_class(['return/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#return" role="button"
                        aria-expanded="{{ is_active_route(['return/*']) }}" aria-controls="return">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Return</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['return/*']) }}" id="return">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Add Sale Return</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Sale Return List</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Add Purchase Return</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Purchase Return List</a>
                            </li>

                        </ul>
                    </div>
                </li> --}}




                <!-- Admin People-->
                <li class="nav-item nav-category">User management</li>
                <li class="nav-item {{ active_class(['people/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#people" role="button"
                        aria-expanded="{{ is_active_route(['people/*']) }}" aria-controls="people">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">People</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['people/*']) }}" id="people">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('/customer') }}" class="nav-link">Customers</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('warehouse') }}" class="nav-link">Warehouse</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addSupplier') }}" class="nav-link">Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.billers') }}" class="nav-link">Billers</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <!-- Admin Users-->
                
                <li class="nav-item {{ active_class(['users/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#users" role="button"
                        aria-expanded="{{ is_active_route(['users/*']) }}" aria-controls="users">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Users</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['users/*']) }}" id="users">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ url('/add_user') }}" class="nav-link">Add User</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/users') }}" class="nav-link">User List</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="nav-item {{ active_class(['/']) }}">
                    <a href="{{ url('/setting') }}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Setting</span>
                    </a>
                </li>

            </ul>
        </div>
    @elseif(Auth::user()->role == 3)
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item {{ active_class(['/']) }}">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>

                <!-- Admin Expense-->
                <li class="nav-item {{ active_class(['expense/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#expense" role="button"
                        aria-expanded="{{ is_active_route(['expense/*']) }}" aria-controls="expense">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Expense</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['expense/*']) }}" id="expense">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('admin.expenseCategory') }}"
                                    class="nav-link {{ active_class(['expense']) }}">Expense Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addExpense') }}"
                                    class="nav-link {{ active_class(['expense']) }}">Add Expense</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.expenseList') }}"
                                    class="nav-link {{ active_class(['expense']) }}">ExpenseList</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Admin Sale-->
                <li class="nav-item {{ active_class(['sales/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#sales" role="button"
                        aria-expanded="{{ is_active_route(['sales/*']) }}" aria-controls="sales">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Sale</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['sales/*']) }}" id="sales">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="/sales" class="nav-link {{ active_class(['sales']) }}">Sale List</a>
                            </li>
                            <li class="nav-item">
                                <a href="/pos" class="nav-link {{ active_class(['sales']) }}">POS</a>
                            </li>
                            <li class="nav-item">
                                <a href="/sales/add" class="nav-link {{ active_class(['sales']) }}">Add Sale</a>
                            </li>
                            <li class="nav-item">
                                <a href="/sales/import" class="nav-link {{ active_class(['sales']) }}">Import Sale By
                                    CSV</a>
                            </li>
                            <li class="nav-item">
                                <a href="/giftcard" class="nav-link {{ active_class(['sales']) }}">Gift Card List</a>
                            </li>
                            <li class="nav-item">
                                <a href="/coupon" class="nav-link {{ active_class(['sales']) }}">Coupon List</a>
                            </li>
                            <li class="nav-item">
                                <a href="/delivery" class="nav-link {{ active_class(['sales']) }}">Delivery List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Admin Product-->
                <li class="nav-item {{ active_class(['product/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#product" role="button"
                        aria-expanded="{{ is_active_route(['product/*']) }}" aria-controls="product">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Product</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['product/*']) }}" id="product">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('admin.productCategory') }}"
                                    class="nav-link {{ active_class(['product']) }}">Category</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.productBrand') }}"
                                    class="nav-link {{ active_class(['product']) }}">Brand</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addProduct') }}"
                                    class="nav-link {{ active_class(['product']) }}">Add Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.productList') }}"
                                    class="nav-link {{ active_class(['product']) }}">Product List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/add_Adjustment') }}" class="nav-link">Add Adjustment</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/Adjustment/list') }}" class="nav-link">Adjustment List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/stock_count') }}" class="nav-link">Stock Count</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Admin Purchase-->
                <li class="nav-item {{ active_class(['purchase/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#purchase" role="button"
                        aria-expanded="{{ is_active_route(['purchase/*']) }}" aria-controls="purchase">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">purchase</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['purchase/*']) }}" id="purchase">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('purchase.add') }}"
                                    class="nav-link {{ active_class(['purchase']) }}">Add Purchase</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.purchaseList') }}"
                                    class="nav-link {{ active_class(['purchase']) }}">Purchase List</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- Admin Purchase-->
                <li class="nav-item {{ active_class(['return/*']) }}">
                    <a class="nav-link" data-toggle="collapse" href="#return" role="button"
                        aria-expanded="{{ is_active_route(['return/*']) }}" aria-controls="return">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Return</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class(['return/*']) }}" id="return">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Add Sale Return</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Sale Return List</a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Add Purchase Return</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ active_class(['return']) }}">Purchase Return List</a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    @endif
</nav>
