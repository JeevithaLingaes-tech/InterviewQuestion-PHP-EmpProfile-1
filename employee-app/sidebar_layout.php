<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar Layout</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

  <div class="sidebar">
    <h3>Menu</h3>
    <ul>

    <li><a href="home.php" class="<?= $currentPage == 'home.php' ? 'active' : '' ?>"><i class="fas fa-house sidebar-icon"></i>Home</a></li>
    <li>
  <a href="employees.php" class="<?= in_array($currentPage, ['employees.php', 'new_employee.php']) ? 'active' : '' ?>">
    <i class="fas fa-users sidebar-icon"></i>Employee
  </a>
</li>

    </ul>
  </div>
</body>

</html>
