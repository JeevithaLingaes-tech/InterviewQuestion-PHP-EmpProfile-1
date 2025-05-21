<?php
$file = 'employees.json';
$employees = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>All Employees</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="layout">
    <?php include "sidebar_layout.php"; ?>
    <div class="container">
      <div class="row">
        <h2 class="page-title">All Employee Profiles</h2>
        <a href="new_employee.php" class="btn" margin-left=> Add New Employee </a>
      </div>
      <table class="styled-table">
        <thead>
          <tr>
            <th>Employee Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Marital Status</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date Of Birth</th>
            <th>Nationality</th>
            <th>Hire Date</th>
            <th>Department</th>
            <th>Employment Type</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($employees as $emp): ?>
            <tr>
              <td><?= ($emp['name']) ?></td>
              <td><?= ($emp['age']) ?></td>
              <td><?= ($emp['gender']) ?></td>
              <td><?= ($emp['marital_status']) ?></td>
              <td><?= ($emp['phone_num']) ?></td>
              <td><?= ($emp['email']) ?></td>
              <td><?= ($emp['address']) ?></td>
              <td><?= ($emp['date_of_birth']) ?></td>
              <td><?= ($emp['nationality']) ?></td>
              <td><?= ($emp['hire_date']) ?></td>
              <td><?= ($emp['department']) ?></td>
              <td><?= ($emp['employment_type']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</body>

</html>