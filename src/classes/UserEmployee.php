<?php

class UserEmployee
{
    private $database;
    public array $errors = [];

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function submitVacationRequest($userId, $startDate, $endDate, $reason = null): bool
    {
        if (!$this->validateDate($startDate) || !$this->validateDate($endDate)) {
            $this->errors['date'] = 'Invalid date format.';
            return false;
        }

        if ($startDate > $endDate) {
            $this->errors['dateOrder'] = 'Start date must be before end date.';
            return false;
        }

        $currentDate = date('Y-m-d');
        if ($startDate <= $currentDate) {
            $this->errors['startDate'] = 'Start date must be in the future.';
            return false;
        }

        $params = [
            ':user_id' => $userId,
            ':start_date' => $startDate,
            ':end_date' => $endDate,
            ':reason' => $reason
        ];

        $sql = "INSERT INTO requests (user_id, start_date, end_date, reason, status, created_at, updated_at)
                VALUES (:user_id, :start_date, :end_date, :reason, 'pending', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

        $success = $this->database->query($sql, $params);

        if (!$success) {
            $this->errors['database'] = 'Failed to submit request.';
            return false;
        }

        return true;
    }

    private function validateDate($date): bool
    {
        return (bool)strtotime($date);
    }

    public function getAllVacationRequests(): array
    {
        return $this->database->query("SELECT requests.id, requests.user_id, requests.start_date, requests.end_date, requests.reason, requests.status, requests.created_at, users.email, users.name , users.employee_code
        FROM requests 
        JOIN users ON requests.user_id = users.id
        ORDER BY requests.created_at DESC")
            ->get();
    }

    public function fetchVacationRequestsByUser($user_id): array
    {
        return $this->database->query("SELECT * FROM requests WHERE user_id = :user_id ORDER BY created_at DESC", [':user_id' => $user_id])->get();
    }

    public function deleteVacationRequest($request_id, $user_id): bool
    {
        $stmt = $this->database->query("DELETE FROM requests WHERE id = :id AND user_id = :user_id AND status = 'pending'", [':id' => $request_id, ':user_id' => $user_id]);

        return $stmt !== false;
    }

    public function checkForPendingRequests($user_id): bool
    {
        $stmt = $this->database->query("SELECT COUNT(*) AS count FROM requests WHERE status = 'pending' AND user_id = :user_id", [':user_id' => $user_id])->find();

        return $stmt['count'] > 0 ? true : false;
    }
}
