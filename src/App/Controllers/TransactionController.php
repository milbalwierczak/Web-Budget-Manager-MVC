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

        echo $this->view->render("transactions/expense.php", [
            'categories' => $categories
        ]);
    }

    public function incomeView()
    {
        echo $this->view->render("transactions/income.php");
    }

    public function createExpense()
    {
        $this->validatorService->validateTransaction($_POST);

        $this->transactionService->createExpense($_POST);

        redirectTo('/');
    }


    public function createIncome()
    {
        $this->validatorService->validateTransaction($_POST);

        $this->transactionService->createIncome($_POST);

        redirectTo('/');
    }
}
