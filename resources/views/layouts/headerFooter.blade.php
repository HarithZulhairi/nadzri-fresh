<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NadzriFresh - Grocery Inventory System</title>
  <link href="{{ asset('styleHeaderFooter.css') }}" rel="stylesheet">
  <!-- Font Awesome icon -->
  <script src="https://kit.fontawesome.com/449b7d4b66.js" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
  <header class="header">
    <img class="logo" src="{{ asset('uploads/Nadzri-fresh-logo.png') }}">
    <nav class="nav-links">
        <a href="{{ route('home') }}">Home</a>
        
        <div class="dropdown">
            <a href="">Stocks</a>
            <div class="dropdown-content">
                <a href="">Add Stocks <i class="fa fa-chevron-right"></i></a>
                <a href="">View Stocks <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        
        <div class="dropdown">
            <a href="">Grocery</a>
            <div class="dropdown-content">
                <a href="{{ route('manage_grocery.addGrocery') }}" >Add Grocery <i class="fa fa-chevron-right"></i></a>
                <a href="{{ route('manage_grocery.viewGroceryList') }}" >View Grocery List<i class="fa fa-chevron-right"></i></a>
                <a href="{{ route('manage_grocery.searchGrocery') }}" >Search Grocery<i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        
        <div class="dropdown">
            <a href="" class="active">Waste</a>
            <div class="dropdown-content">
                <a href="{{ route('manage_waste.addWaste') }}" >Add Waste Product <i class="fa fa-chevron-right"></i></a>
                <a href="{{ route('manage_waste.viewWaste') }}" >View Waste Product <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </nav>
    <div class="buttons">
        <div class="notification-container">
            <div class="notification-icon" onclick="toggleNotifications()">
                <i class="fa-regular fa-bell fa-3x"></i>
                @if($wasteCount > 0)
                    <span class="notification-badge">{{ $wasteCount }}</span>
                @endif
            </div>
            <div class="notification-dropdown">
                @if($wasteCount > 0)
                    <div class="notification-item">
                        <p>There are {{ $wasteCount }} product(s) that need to be concerned!</p>
                        <a href="{{ route('manage_waste.addWaste') }}" class="view-link">View Products</a>
                    </div>
                @else
                    <div class="notification-item">
                        <p>No products need attention</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="profile-container">
        <i class="fa-solid fa-circle-user fa-3x" onclick="toggleProfileMenu()"></i>
        <div class="profile-dropdown" id="profileDropdown">
            <a href="{{ route('manage_reg_login.profile') }}">My Profile</a>
            <a href="{{ route('manage_reg_login.changePassword') }}">Change Password</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
        </div>

    </div>
</header>

<script>
    // Check for new waste products periodically
    setInterval(function() {
        fetch('/api/waste-count')
            .then(response => response.json())
            .then(data => {
                if (data.count > 0) {
                    document.querySelector('.notification-badge').textContent = data.count;
                    document.querySelector('.notification-item p').textContent = 
                        `There are ${data.count} product(s) that need to be concerned!`;
                }
            });
    }, 30000); // Check every 30 seconds

    function toggleProfileMenu() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Optional: close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        const profileContainer = document.querySelector('.profile-container');
        const dropdown = document.getElementById('profileDropdown');
        if (!profileContainer.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>

  <main>
    @yield('content')
  </main>

  <footer>
    <div class="footer-content">
      <div class="contact-info">
        <div class="contact-us">Contact Us</div>
      </div>
      <div><i class="fa-solid fa-phone fa-1x"></i> +60 11 4048 3940</div>
      <div><i class="fa-solid fa-envelope"></i> nadzrigrocery@gmail.com</div>
      <div><i class="fa-solid fa-location-dot"></i> 251, Lorong Melur 10, Kampung Beruas, 26600 Pekan, Pahang</div>
      <div class="copyright">© 2025 - Nadzri Fresh</div>
    </div>
  </footer>

  <script src="{{ asset('function.js') }}"></script>
</body>
</html>