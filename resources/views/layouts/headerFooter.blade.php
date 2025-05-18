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
        <a href="">Home</a>
        
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
                <a href="" >Add Grocery <i class="fa fa-chevron-right"></i></a>
                <a href="" >View Grocery <i class="fa fa-chevron-right"></i></a>
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
        <i class="fa-regular fa-bell fa-3x" aria-hidden="true" style="padding-right: 5rem;"></i>
        <i class="fa-solid fa-circle-user fa-3x"></i>
    </div>
</header>

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