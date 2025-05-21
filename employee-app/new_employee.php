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
      <h2 class="page-title">New Employee</h2>
      <div class="box form-box">
        <header>Employee Details
          <p>Add the Employee Details.</p>
        </header>

        <form action="save_employee.php" method="POST">
          <div class="row">
            <div class="form-group">
              <label for="name">Employee Name</label>
              <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
              <label for="age">Age</label>
              <input type="text" name="age" id="age" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="gender">Gender</label>
              <select name="gender" id="gender" required>
                <option value="gender">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>

            <div class="form-group">
              <label for="marital_status">Marital Status</label>
              <select name="marital_status" id="marital_status" required>
                <option value="marital_status">Select Marital Status</option>
                <option>Single</option>
                <option>Married</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="phone_num">Phone Num</label>
              <input type="tel" name="phone_num" id="phone_num" required>
            </div>

            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="text" name="email" id="email" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" name="address" id="address">
            </div>

            <div class="form-group">
              <label for="date_of_birth">Date Of Birth</label>
              <input type="date" name="date_of_birth" id="date_of_birth" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="nationality">Nationality</label>
              <input type="text" name="nationality" id="nationality" required>
            </div>

            <div class="form-group">
              <label for="hire_date">Hire Date</label>
              <input type="date" name="hire_date" id="hire_date" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="department">Department</label>
              <select name="department" id="department" required>
                <option value="department">Select Department</option>
                <option>HR</option>
                <option>Engineering</option>
                <option>IT</option>
              </select>
            </div>

            <div class="form-group">
              <label for="employment_type">Employment Type</label>
              <select name="employment_type" id="employment_type" required>
                <option value="employment_type">Select Department</option>
                <option>Full-Time</option>
                <option>Part-Time</option>
                <option>Contract</option>
              </select>
            </div>
          </div>

          <div class="field">
            <input type="submit" class="submit" name="submit">
          </div>


        </form>
      </div>
    </div>
  </div>
</body>

</html>