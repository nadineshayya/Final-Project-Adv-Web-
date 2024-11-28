<div class="custom-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu-list">
            <li>
                <a href="#" class="menu-item active">
                    <i class="fas fa-user-alt"></i> My Profile
                </a>
            </li>
            <li>
                <a href="my-orders.php" class="menu-item">
                    <i class="fas fa-shopping-bag"></i> My Orders
                </a>
            </li>
            <li>
                <a href="wishlist.php" class="menu-item">
                    <i class="fas fa-heart"></i> Wishlist
                </a>
            </li>
            <li>
                <a href="change-password.php" class="menu-item">
                    <i class="fas fa-lock"></i> Change Password
                </a>
            </li>
            <li>
                <a href="{{ route('account.logout') }}" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Styles -->
<style>
    .custom-sidebar {
        width: 250px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 1rem;
    }

    .sidebar-header {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .sidebar-logo {
        font-size: 2.5rem;
        color: #000080;
    }

    .sidebar-menu {
        margin-top: 1rem;
    }

    .menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 0.8rem;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        font-size: 1rem;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .menu-item i {
        margin-right: 0.8rem;
        font-size: 1.2rem;
    }

    .menu-item:hover {
        background-color: #f0f0f0;
    }

    .menu-item.active {
        background-color: #000080; /* Blue background */
        color: #ffffff;
        font-weight: bold;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .custom-sidebar {
            width: 100%;
            padding: 0.8rem;
        }

        .menu-item {
            justify-content: center;
            text-align: center;
        }

        .menu-item i {
            margin: 0;
            margin-bottom: 0.5rem;
        }
    }
</style>
