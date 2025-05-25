<?php
header("Content-Type: application/json");

$dataFile = 'employees.json';

$required_fields = [
    'name',
    'age',
    'gender',
    'marital_status',
    'phone_num',
    'email',
    'date_of_birth',
    'nationality',
    'hire_date',
    'department',
    'employment_type'
];

function sanitizeInput($data, $required_fields)
{
    $input = [];

    foreach ($required_fields as $field) {
        $input[$field] = htmlspecialchars(trim($data[$field] ?? ''));
    }

    $input['address'] = htmlspecialchars(trim($data['address'] ?? ''));

    return $input;
}

function validateInput($input, $dataFile, $required_fields)
{
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            $errors[$field] = "This field is required.";
        }
    }

    if (!isset($errors['phone_num']) && !preg_match('/^\d{1,11}$/', $input['phone_num'])) {
        $errors['phone_num'] = "Phone number must be numeric and up to 11 digits.";
    }

    if (!isset($errors['date_of_birth'])) {
        $birthDate = $input['date_of_birth'];

        $cutoffYear = date('Y') - 18;
        $cutoffDate = "$cutoffYear-12-31";

        if ($birthDate > $cutoffDate) {
            $errors['date_of_birth'] = "Employee must be at least 18 years old (born on or before 31/12/$cutoffYear).";
        }
    }

    if (!isset($errors['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (!isset($errors['email']) && file_exists($dataFile)) {
        $employees = json_decode(file_get_contents($dataFile), true) ?: [];
        foreach ($employees as $employee) {
            if (isset($employee['email']) && strtolower($employee['email']) === strtolower($input['email'])) {
                $errors['email'] = "Email already exists.";
                break;
            }
        }
    }

    return $errors;
}

function storeDetails($input, $dataFile)
{
    $employees = [];

    if (file_exists($dataFile) && filesize($dataFile) > 0) {
        $employees = json_decode(file_get_contents($dataFile), true);
        if (!is_array($employees)) {
            $employees = [];
        }
    }

    $maxId = 0;
    foreach ($employees as $emp) {
        if (isset($emp['id']) && is_numeric($emp['id']) && $emp['id'] > $maxId) {
            $maxId = $emp['id'];
        }
    }
    $input['id'] = $maxId + 1;

    $employees[] = $input;

    file_put_contents($dataFile, json_encode($employees, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawData = file_get_contents("php://input");
    $json = json_decode($rawData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid JSON"]);
        exit;
    }

    $input = sanitizeInput($json, $required_fields);
    $errors = validateInput($input, $dataFile, $required_fields);

    if (!empty($errors)) {
        http_response_code(422);
        echo json_encode(["errors" => $errors]);
        exit;
    }

    storeDetails($input, $dataFile);
    http_response_code(201);
    echo json_encode(["message" => "Employee created successfully"]);
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Method Not Allowed"]);
