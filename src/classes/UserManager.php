<?php

class UserManager
{
    private $database;
    public array $errors = [];

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function updateUser($userId, $email, $password = null, $name = null)
    {
        if (!Validator::validateEmail($email)) {
            $this->errors['email'] = 'Invalid email address.';
            return false;
        }

        $params = [':name' => $name, ':email' => $email, ':id' => $userId];
        $sql = "UPDATE users SET name = :name, email = :email";

        if (!empty($password)) {
            if (!Validator::validatePassword($password)) {
                $this->errors['password'] = 'Password must be at least seven characters.';
                return false;
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $params[':password'] = $hashedPassword;
            $sql .= ", password = :password ";
        }

        if ($this->isEmailRegistered($email, $userId)) {
            $this->errors['emailTaken'] = 'This email is already taken.';
            return false;
        }

        $sql .= " WHERE id = :id";

        $this->database->query($sql, $params);

        return true;
    }

    public function deleteUser($userId): bool
    {
        $this->database->query("DELETE FROM users WHERE id = ?", [$userId]);
        return true;
    }

    public function isEmailRegistered($email, $exclude_user_id = null): bool
    {
        $params = [':email' => $email];
        $sql = "SELECT id FROM users WHERE email = :email";

        if ($exclude_user_id) {
            $sql .= " AND id != :exclude_user_id";
            $params[':exclude_user_id'] = $exclude_user_id;
        }

        $stmt = $this->database->query($sql, $params)->find();

        return $stmt !== false;
    }

    public function approveVacationRequest($request_id): bool
    {
        $stmt = $this->database->query("UPDATE requests SET status = 'approved' WHERE id = :id AND status = 'pending'", [':id' => $request_id]);

        return $stmt !== false && $this->database->rowCount() > 0;
    }

    public function rejectVacationRequest($request_id): bool
    {
        $stmt = $this->database->query("UPDATE requests SET status = 'rejected' WHERE id = :id AND status = 'pending'", [':id' => $request_id]);

        return $stmt !== false && $this->database->rowCount() > 0;
    }

    public function getUserById($user_id): ?array
    {
        return $this->database->query("SELECT * FROM users WHERE id = ?", [$user_id])->find();
    }

    public function getAllUsers(): array
    {
        $currentLoggedInUserId = AuthService::retrieveSessionUserId();
        return $this->database->query("SELECT * FROM users WHERE id != :id",['id' => $currentLoggedInUserId])->get();
    }
}
