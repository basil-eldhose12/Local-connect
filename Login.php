<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - LocalConnect</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Loginstyle.css">
</head>
<body>
  <div class="login-container">
    <h2>Welcome Back</h2>
    <p>Please log in to your account</p>

    <!-- Role Tabs -->
    <div class="role-tabs">
      <button type="button" id="customerTab" onclick="setRole('customer')">Customer</button>
      <button type="button" id="providerTab" onclick="setRole('provider')">Service Provider</button>
      <button type="button" id="adminTab" onclick="setRole('admin')">Admin</button>
    </div>

    <!-- Login Form -->
    <form action="Login_action.php" method="POST">
      <input type="hidden" name="role" id="role" value="">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required />
      </div>
      <p><a class="forgot-password" href="forgot_password.php">Forgot Password?</a></p>
      <button type="submit" class="btn btn-primary">Sign In</button>
    </form>

    <div id="orDivider" class="or-divider">or</div>
    <button id="createAccountBtn" class="btn btn-secondary" onclick="window.location.href='Registration.html'">Create New Account</button>
  </div>
<script>
  // Get role from query string (?role=customer)
  function getRoleFromQuery() {
    const params = new URLSearchParams(window.location.search);
    return params.get('role');
  }

  // Apply role to form + UI
  function setRole(role) {
    document.getElementById('role').value = role;

    // Highlight the active tab
    document.querySelectorAll('.role-tabs button').forEach(btn => btn.classList.remove('active'));
    const activeTab = document.getElementById(role + "Tab");
    if (activeTab) activeTab.classList.add('active');

    // Save role so it stays highlighted after reload
    sessionStorage.setItem("selectedRole", role);

    // Hide Create Account for Admin
    const orDivider = document.getElementById('orDivider');
    const createAccountBtn = document.getElementById('createAccountBtn');

    if (role === 'admin') {
      orDivider.style.display = 'none';
      createAccountBtn.style.display = 'none';
    } else {
      orDivider.style.display = 'block';
      createAccountBtn.style.display = 'inline-block';
    }
  }

  // Page Load
  window.onload = function () {
    let role = getRoleFromQuery(); // from ?role=
    if (!role) {
      role = sessionStorage.getItem("selectedRole"); // restore previous role
    }
    if (!role) {
      role = "customer"; // default
    }
    setRole(role);
  };
</script>
</body>
</html>
  