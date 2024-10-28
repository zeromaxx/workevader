<?php

class AuthService
{
    private $database;
    public array $errors = [];

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function registerUser($email, $password, $role = null, $employee_code = null): bool
    {
        $email = trim($email);
        $password = trim($password);

        if (!$this->validateInput($email, $password)) {
            return false;
        }

        if ($this->isEmailRegistered($email)) {
            $this->errors['email'] = 'Email is already registered.';
            return false;
        }

        if (!$role) {
            $role = 'employee';
        }

        if (!$employee_code) {
            $employee_code = Helper::generateUniqueEmployeeCode();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->database->query(
            "INSERT INTO users (email, employee_code, password, role) VALUES (?, ?, ?, ?)",
            [$email, $employee_code, $hashedPassword, $role]
        );

        return true;
    }

    private function validateInput($email, $password): bool
    {
        if (!Validator::validateEmail($email)) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::validatePassword($password)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        return empty($this->errors);
    }

    public function loginUser($email, $password): bool
    {
        $email = trim($email);
        $password = trim($password);

        $user = $this->database
            ->query("SELECT * FROM users WHERE email = ?", [$email])
            ->find();

        if (!$user || !password_verify($password, $user['password'])) {
            $this->errors['login'] = 'Invalid email or password.';
            return false;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        return true;
    }

    public function getRedirectPathByRole($role): string
    {
        $rolePaths = [
            'employee' => '/employee/dashboard',
            'manager' => '/manager/dashboard',
        ];

        return $rolePaths[$role] ?? '/';
    }

    private function isEmailRegistered($email): bool
    {
        $result = $this->database
            ->query("SELECT COUNT(*) as count FROM users WHERE email = ?", [$email])
            ->find();

        return $result['count'] > 0;
    }

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public static function retrieveSessionUserId(): ?string
    {
        return $_SESSION['user_id'] ?? null;
    }

    public static function getUserRole(): ?string
    {
        return $_SESSION['user_role'] ?? null;
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        header("Location: /login");
        exit;
    }
}
