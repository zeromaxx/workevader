<?php

class Helper
{
    public static function generateUniqueEmployeeCode(): string
    {
        $code = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

        $db = new Database();
        $existingUser = $db->query("SELECT * FROM users WHERE employee_code = ?", [$code])->find();

        if ($existingUser) {
            return self::generateUniqueEmployeeCode();
        }

        return $code;
    }

    public static function displaySuccess(): void
    {
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success mt-3 text-center' role='alert'>";
            echo "<p class='mb-0'>{$_SESSION['success']}</p>";
            echo "</div>";
            unset($_SESSION['success']);
        }
    }

    public static function displayErrors(): void
    {
        if (isset($_SESSION['errors'])) {
            echo "<div class='alert alert-danger mt-3 text-center' role='alert'>";
            foreach ($_SESSION['errors'] as $error) {
                echo "<p class='mb-0'>$error</p>";
            }
            echo "</div>";
            unset($_SESSION['errors']);
        }
    }
}
