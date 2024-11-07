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
