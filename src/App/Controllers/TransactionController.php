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
        $balance = $this->transactionService->getUserBalance();
        $incomes = $this->transactionService->getUserIncomes();
        $expenses = $this->transactionService->getUserExpenses();
        [$expenses_labels, $expenses_data] = $this->transactionService->getUserExpensesCategorized();
        [$incomes_labels, $incomes_data] = $this->transactionService->getUserIncomesCategorized();
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');

        echo $this->view->render("balance.php", [
            'balance' => $balance,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'expenses_labels' => $expenses_labels,
            'expenses_data' => $expenses_data,
            'incomes_labels' => $incomes_labels,
            'incomes_data' => $incomes_data
        ]);
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
}
