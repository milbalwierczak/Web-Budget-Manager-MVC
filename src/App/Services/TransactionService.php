<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db) {}

    public function createIncome(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "INSERT INTO transactions (user_id, description, amount, date)
            VALUES(:user_id, :description, :amount, :date)",
            [
                'user_id' => $_SESSION['user'],
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate
            ]
        );
    }

    public function createExpense(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";

        $this->db->query(
            "INSERT INTO transactions (user_id, description, amount, date)
            VALUES(:user_id, :description, :amount, :date)",
            [
                'user_id' => $_SESSION['user'],
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate
            ]
        );
    }

    public function getExpenseCategories()
    {

        $categories = $this->db->query(
            "SELECT name FROM expenses_category_assigned_to_users WHERE user_id = :user_id",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();

        return $categories;
    }

    public function getUserTransactions(int $length, int $offset)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'user_id' => $_SESSION['user'],
            'description' => "%{$searchTerm}%"
        ];

        $transactions = $this->db->query(
            "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date
            FROM transactions 
            WHERE user_id = :user_id
            AND description LIKE :description
            LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $transactions = array_map(function (array $transaction) {
            $transaction['receipts'] = $this->db->query(
                "SELECT * FROM receipts WHERE transaction_id = :transaction_id",
                ['transaction_id' => $transaction['id']]
            )->findAll();

            return $transaction;
        }, $transactions);

        $transactionCount = $this->db->query(
            "SELECT COUNT(*)
            FROM transactions 
            WHERE user_id = :user_id
            AND description LIKE :description",
            $params
        )->count();

        return [$transactions, $transactionCount];
    }

    public function getUserBalance(string $start_date = null, $end_date = null)
    {
        $start_date = $start_date ?? date('Y-m-01');
        $end_date = $end_date ?? date('Y-m-t');

        $expense = $this->db->query(
            "SELECT SUM(amount)
            FROM expenses
            WHERE user_id = :user_id AND date_of_expense BETWEEN :start_date AND :end_date",
            [
                'user_id' => $_SESSION['user'],
                'start_date' => $start_date,
                'end_date' => $end_date
            ]
        )->sum();

        $income = $this->db->query(
            "SELECT SUM(amount)
            FROM incomes
            WHERE user_id = :user_id AND date_of_income BETWEEN :start_date AND :end_date",
            [
                'user_id' => $_SESSION['user'],
                'start_date' => $start_date,
                'end_date' => $end_date
            ]
        )->sum();

        $balance = $income - $expense;

        return $balance;
    }
}
