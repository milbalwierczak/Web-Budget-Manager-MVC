<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{
    ValidatorService,
    TransactionService
};

class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TransactionService $transactionService
    ) {}

    public function expenseView()
    {
        $categories = $this->transactionService->getExpenseCategories();
        $methods = $this->transactionService->getPaymentMethods();

        echo $this->view->render("transactions/expense.php", [
            'categories' => $categories,
            'methods' => $methods
        ]);
    }

    public function incomeView()
    {
        $categories = $this->transactionService->getIncomeCategories();

        echo $this->view->render("transactions/income.php", [
            'categories' => $categories
        ]);
    }

    public function balanceView()
    {
        $start_date = $_SESSION['start_date'] ?? date('Y-m-01');
        $end_date = $_SESSION['end_date'] ?? date('Y-m-t');

        if (isset($_SESSION['start_date'])) {
            unset($_SESSION['start_date']);
        }

        if (isset($_SESSION['end_date'])) {
            unset($_SESSION['end_date']);
        }

        $balance = $this->transactionService->getUserBalance($start_date, $end_date);
        $incomes = $this->transactionService->getUserIncomes($start_date, $end_date);
        $expenses = $this->transactionService->getUserExpenses($start_date, $end_date);
        [$expenses_labels, $expenses_data] = $this->transactionService->getUserExpensesCategorized($start_date, $end_date);
        [$incomes_labels, $incomes_data] = $this->transactionService->getUserIncomesCategorized($start_date, $end_date);
        $categories = $this->transactionService->getIncomeCategories();


        echo $this->view->render("balance.php", [
            'balance' => $balance,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'expenses_labels' => $expenses_labels,
            'expenses_data' => $expenses_data,
            'incomes_labels' => $incomes_labels,
            'incomes_data' => $incomes_data,
            'categories' => $categories
        ]);
    }

    public function balancePreviousMonth()
    {
        $_SESSION['start_date']  = date('Y-m-01', strtotime('first day of last month'));
        $_SESSION['end_date'] = date('Y-m-t', strtotime('last day of last month'));

        redirectTo('/balance');
    }

    public function balanceCurrentYear()
    {
        $_SESSION['start_date'] = date('Y-01-01');
        $_SESSION['end_date'] = date('Y-12-31');

        redirectTo('/balance');
    }

    public function customBalance()
    {
        $this->validatorService->validateBalance($_POST);

        $_SESSION['start_date']  = \DateTime::createFromFormat('d-m-Y', $_POST['dateStart'])->format('Y-m-d');
        $_SESSION['end_date'] =  \DateTime::createFromFormat('d-m-Y', $_POST['dateEnd'])->format('Y-m-d');

        redirectTo('/balance');
    }

    public function createExpense()
    {
        $this->validatorService->validateExpense($_POST);

        $this->transactionService->createExpense($_POST);

        $_SESSION['expense_added'] = true;

        redirectTo('/expense');
    }


    public function createIncome()
    {
        $this->validatorService->validateIncome($_POST);

        $this->transactionService->createIncome($_POST);

        $_SESSION['income_added'] = true;

        redirectTo('/income');
    }

    public function editIncome()
    {
        $this->validatorService->validateIncome($_POST);

        $this->transactionService->editIncome($_POST);

        $_SESSION['income_added'] = true;

        redirectTo('/balance');
    }
}
