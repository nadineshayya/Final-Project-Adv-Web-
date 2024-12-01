<div class="sidebar" style="background: linear-gradient(180deg, #000080, #1e90ff); padding: 20px; height: 100vh; color: white;">
    <div class="text-center mb-4">
        <h4 class="fw-bold text-light" style="letter-spacing: 1px; text-transform: uppercase; font-size: 1.2rem;">
            Admin Panel
        </h4>
        <hr style="border: 1px solid #fff; width: 80%; margin: 10px auto;">
    </div>
    <ul class="nav flex-column">
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-light" href="#" 
               style="font-size: 1rem; padding: 10px 15px; border-radius: 8px; transition: background 0.3s;">
                <i class="fas fa-tachometer-alt me-3" style="font-size: 1.2rem;"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-light" href="{{ route('categories.index') }}" 
               style="font-size: 1rem; padding: 10px 15px; border-radius: 8px; transition: background 0.3s;">
                <i class="fas fa-file-alt me-3" style="font-size: 1.2rem;"></i> Categories
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-light" href="{{ route('sub-categories.index') }}" 
               style="font-size: 1rem; padding: 10px 15px; border-radius: 8px; transition: background 0.3s;">
                <i class="fas fa-file-alt me-3" style="font-size: 1.2rem;"></i> Sub Categories
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-light" href="{{ route('products.index') }}" 
               style="font-size: 1rem; padding: 10px 15px; border-radius: 8px; transition: background 0.3s;">
                <i class="fas fa-tag me-3" style="font-size: 1.2rem;"></i> Products
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-light" href="{{route('orders.order')}}" 
               style="font-size: 1rem; padding: 10px 15px; border-radius: 8px; transition: background 0.3s;">
                <i class="fas fa-shopping-bag me-3" style="font-size: 1.2rem;"></i> Orders
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-light" href="{{route('users.index')}}" 
               style="font-size: 1rem; padding: 10px 15px; border-radius: 8px; transition: background 0.3s;">
                <i class="fas fa-users me-3" style="font-size: 1.2rem;"></i> Users
            </a>
        </li>
       
    </ul>
</div>
