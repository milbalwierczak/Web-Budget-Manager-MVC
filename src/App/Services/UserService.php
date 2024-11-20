<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db) {}

    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ['Istnieje już konto o takim adresie email']]);
        }
    }

    public function getUserName()
    {
        $username = $this->db->query(
            "SELECT username FROM users WHERE id = :id",
            [
                'id' => $_SESSION['user']
            ]
        )->count();

        return $username;
    }

    public function create(array $formData): void
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "INSERT INTO users(username, password, email)
            VALUES(:username, :password, :email)",
            [
                'username' => $formData['name'],
                'password' => $password,
                'email' => $formData['email'],
            ]
        );

        $user_id = $this->db->id();

        $this->db->query(
            "INSERT INTO expenses_category_assigned_to_users (user_id, name) SELECT :user_id, name FROM expenses_category_default",
            [
                'user_id' => $user_id
            ]
        );

        $this->db->query(
            "INSERT INTO incomes_category_assigned_to_users (user_id, name) SELECT :user_id, name FROM incomes_category_default",
            [
                'user_id' => $user_id
            ]
        );

        $this->db->query(
            "INSERT INTO payment_methods_assigned_to_users (user_id, name) SELECT :user_id, name FROM payment_methods_default",
            [
                'user_id' => $user_id
            ]
        );

        session_regenerate_id();

        $_SESSION['user'] = $user_id;
    }

    public function login(array $formData): void
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']
        ])->find();

        $passwordMatch = password_verify(
            $formData['password'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordMatch) {
            throw new ValidationException(['password' => ['Niepoprawny login lub hasło']]);
        }

        session_regenerate_id();

        $_SESSION['user'] = $user['id'];
    }

    public function getDailyQuote()
    {
        $totalQuotes = $this->db->query("SELECT COUNT(*) FROM quotes")->count();

        $today = date('Y-m-d');
        srand(strtotime($today));
        $randomId = rand(1, $totalQuotes);

        $data = $this->db->query("SELECT quote, author FROM quotes WHERE id = :id", [
            'id' => $randomId
        ])->find();

        extract($data);

        return [$quote, $author];
    }

    public function logout()
    {
        //unset($_SESSION['user']);
        session_destroy();

        //session_regenerate_id();

        $params = session_get_cookie_params();

        setcookie(
            'PHPSESSID',
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    public function checkPassword(array $formData): void
    {
        $user = $this->db->query("SELECT * FROM users WHERE id = :id", [
            'id' => $_SESSION['user']
        ])->find();

        $passwordMatch = password_verify(
            $formData['currentPassword'],
            $user['password'] ?? ''
        );

        if (!$user || !$passwordMatch) {
            throw new ValidationException(['currentPassword' => ['Niepoprawne hasło']]);
        }
    }

    public function changePassword(array $formData): void
    {
        $password = password_hash($formData['newPassword'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "UPDATE users
            SET password = :password
            WHERE id = :id",
            [
                'id' => $_SESSION['user'],
                'password' => $password
            ]
        );
    }

    public function changeName(array $formData): void
    {
        $this->db->query(
            "UPDATE users
            SET username = :username
            WHERE id = :id",
            [
                'id' => $_SESSION['user'],
                'username' => $formData['name']
            ]
        );
    }

    public function deleteAccount(): void
    {
        $this->db->query(
            "DELETE FROM users
            WHERE id = :id",
            [
                'id' => $_SESSION['user']
            ]
        );

        $this->db->query(
            "DELETE FROM expenses
            WHERE user_id = :id",
            [
                'id' => $_SESSION['user']
            ]
        );

        $this->db->query(
            "DELETE FROM expenses_category_assigned_to_users
            WHERE user_id = :id",
            [
                'id' => $_SESSION['user']
            ]
        );

        $this->db->query(
            "DELETE FROM incomes
            WHERE user_id = :id",
            [
                'id' => $_SESSION['user']
            ]
        );

        $this->db->query(
            "DELETE FROM incomes_category_assigned_to_users
            WHERE user_id = :id",
            [
                'id' => $_SESSION['user']
            ]
        );

        $this->db->query(
            "DELETE FROM payment_methods_assigned_to_users
            WHERE user_id = :id",
            [
                'id' => $_SESSION['user']
            ]
        );
    }
}
