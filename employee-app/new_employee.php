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

        <form id="employeeForm">
          <div class="row">
            <div class="form-group">
              <label for="name">Employee Name</label>
              <input type="text" name="name" id="name" required>
              <?php if (isset($errors['age'])): ?>
                <span style="color:red;">Age is required</span>
              <?php endif; ?>

            </div>

            <div class="form-group">
              <label for="age">Age</label>
              <input type="text" name="age" id="age" readonly placeholder="Enter the date of birth first">
              <div class="error-message" id="age_error"></div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="gender">Gender</label>
              <select name="gender" id="gender" required>
                <option value="" disabled selected hidden>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>

            </div>

            <div class="form-group">
              <label for="marital_status">Marital Status</label>
              <select name="marital_status" id="marital_status" required>
                <option value="" disabled selected hidden>Select Marital Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="phone_num">Phone Num</label>
              <input type="tel" name="phone_num" id="phone_num" required>
              <div class="error-message" id="phone_num_error"></div>
            </div>

            <div class="form-group">
              <label for="email">Email Address</label>
              <input
                type="email"
                name="email"
                id="email"
                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required>
              <?php if (isset($errors['email'])): ?>
                <div class="invalid-feedback"><?= $errors['email'] ?></div>
              <?php endif; ?>
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
                <option value="" disabled selected hidden>Select Department</option>
                <option value="HR">HR</option>
                <option value="Engineering">Engineering</option>
                <option value="IT">IT</option>
              </select>
            </div>

            <div class="form-group">
              <label for="employment_type">Employment Type</label>
              <select name="employment_type" id="employment_type" required>
                <option value="" disabled selected hidden>Select Employment Type</option>
                <option value="Full-Time">Full-Time</option>
                <option value="Part-Time">Part-Time</option>
                <option value="Contract">Contract</option>
              </select>
            </div>
          </div>

          <div class="field">
            <input type="submit" class="submit" name="submit">
          </div>
        </form>
      </div>
      <br>
      <div style="text-align: right; width: 100%; margin-top: 10px;">
        <a href="employees.php" class="btn secondary">← Back</a>
      </div>

    </div>

  </div>


  <script>
    /**
     * Calculate age from date of birth
     */
    function calculateAgeFromDOB(dob) {
      const dobYear = new Date(dob).getFullYear();
      const currentYear = new Date().getFullYear();
      return currentYear - dobYear;

    }

    /**
     * Update the age field and validation based on DOB
     */
    function updateAgeField() {
      const dob = dateOfBirthField.value;
      const age = calculateAgeFromDOB(dob);

      if (dob && !isNaN(age)) {
        ageField.value = age;

        if (age < 18) {
          ageError.textContent = "Employee must be at least 18 years old.";
        } else {
          ageError.textContent = "";
        }
      } else {
        ageField.value = "";
        ageError.textContent = "Date of birth is required to determine age.";
      }
    }

    /**
     * Validate form fields before submission
     */
    function validateForm(data) {
      let isValid = true;

      // Reset error messages
      phoneError.textContent = "";
      ageError.textContent = "";

      // Validate phone number
      if (!/^\d{1,11}$/.test(data.phone_num)) {
        phoneError.textContent = "Phone number must be numeric and up to 11 digits.";
        isValid = false;
      }

      // Validate age
      const age = parseInt(data.age, 10);
      if (isNaN(age) || age < 18) {
        ageError.textContent = "Age must be a number greater than 17.";
        isValid = false;
      }

      return isValid;
    }

    /**
     * Submit form via fetch
     */
    async function submitForm(data) {
      try {
        const response = await fetch("save_employee.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
          window.location.href = "employees.php?success=1";
        } else if (response.status === 422) {
          alert(Object.entries(result.errors).map(([field, msg]) => `${field}: ${msg}`).join("\n"));
        } else {
          alert("Error: " + (result.error || "Something went wrong"));
        }
      } catch (error) {
        alert("Network or server error: " + error.message);
      }
    }

    // DOM references
    const form = document.getElementById("employeeForm");
    const ageField = document.getElementById("age");
    const dateOfBirthField = document.getElementById("date_of_birth");
    const ageError = document.getElementById("age_error");
    const phoneError = document.getElementById("phone_num_error");

    // Auto-calculate age on DOB change
    dateOfBirthField.addEventListener("change", updateAgeField);

    // Handle form submission
    form.addEventListener("submit", function(e) {
      e.preventDefault();

      const formData = new FormData(form);
      const jsonData = {};

      formData.forEach((value, key) => {
        jsonData[key] = value.trim();
      });

      if (validateForm(jsonData)) {
        submitForm(jsonData);
      }
    });
  </script>

</body>

</html>