<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{TransactionService, UserService};

class SettingsController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private UserService $userService
    ) {}

    public function settings()
    {
        $incomeCategories = $this->transactionService->getIncomeCategories();
        $expenseCategories = $this->transactionService->getExpenseCategories();
        $paymentMethods = $this->transactionService->getPaymentMethods();

        echo $this->view->render("/settings.php", [
            'incomeCategories' => $incomeCategories,
            'expenseCategories' => $expenseCategories,
            'paymentMethods' => $paymentMethods
        ]);
    }
}
