<?php
$file = 'employees.json';
$employees = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$totalEmployees = count($employees);
$departments = [];

$newHiresThisMonth = 0;
$currentMonth = date('Y-m');

foreach ($employees as $emp) {

  if (!empty($emp['department'])) {
    $departments[$emp['department']] = true;
  }

  if (!empty($emp['hire_date']) && strpos($emp['hire_date'], $currentMonth) === 0) {
    $newHiresThisMonth++;
  }
}

$totalDepartments = count($departments);

$recentEmployees = array_slice(array_reverse($employees), 0, 1); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Employee</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="layout">
    <?php include "sidebar_layout.php"; ?>
    <div class="container">
      <div class="stats-section">
        <div class="stat-card">
          <h3><?= $totalEmployees ?></h3>
          <p>Total Employees</p>
        </div>
        <div class="stat-card">
          <h3><?= $totalDepartments ?></h3>
          <p>Departments</p>
        </div>
        <div class="stat-card">
          <h3><?= $newHiresThisMonth ?></h3>
          <p>New Hires This Month</p>
        </div>
      </div>
      <div class="hero-section">
        <img src="images/teamwork.jpg" alt="Employees working together" class="hero-image" />
        <p class="hero-text">
          “Take care of your employees and they'll take care of your business.” – Richard Branson
        </p>
      </div>
      <div class="recent-activity">
        <h4>Recent Activity</h4>
        <ul>
          <?php foreach ($recentEmployees as $emp): ?>
            <li>👤 <?= htmlspecialchars($emp['name']) ?> joined <?= htmlspecialchars($emp['department']) ?> Department</li>
          <?php endforeach; ?>
          <li>📅 Monthly review scheduled for <?php echo date('F Y'); ?></li>
        </ul>
      </div>

    </div>

  </div>
</body>

</html>
