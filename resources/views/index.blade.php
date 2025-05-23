<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index</title>
</head>
<body>
  <a href="{{ route('manage_waste.addWaste') }}">Add waste</a>
  <a href="{{ route('manage_waste.viewWaste') }}">View waste</a>
  <br>
  <a href="{{ route('manage_waste.viewProduct') }}">View product</a>
  <a href="{{ route('manage_waste.createProduct') }}">Add product</a>
  <br>
  <br>
  <a href="{{ route('manage_grocery.addGrocery') }}">Add grocery</a>
  <a href="{{ route('manage_grocery.searchGrocery') }}">Search grocery</a>
  <br>
  <a href="{{ route('manage_grocery.viewGrocery') }}">View grocery</a>
  <a href="{{ route('manage_grocery.editGrocery', ['product' => 1]) }}">Edit grocery</a>
  <br><br>
  <a href="{{ route('manage_reg_login.login') }}">View Login Page</a><br>
  <a href="{{ route('manage_reg_login.register') }}">Create an account</a><br>
  <a href="{{ route('home') }}">View Home Page</a><br>
  <a href="{{ route('manage_reg_login.profile') }}">View Profile</a><br>
  <a href="{{ route('manage_reg_login.editProfile') }}">Edit Profile</a><br>
  <a href="{{ route('manage_reg_login.changePassword') }}">Change Password</a><br>
</body>
</html>