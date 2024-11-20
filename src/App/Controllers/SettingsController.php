<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{TransactionService, UserService, ValidatorService};

class SettingsController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private UserService $userService,
        private ValidatorService $validatorService
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

    public function changePassword()
    {
        $this->userService->checkPassword($_POST);

        $this->validatorService->validateNewPassword($_POST);

        $this->userService->changePassword($_POST);

        $_SESSION['password_changed'] = true;

        redirectTo('/settings');
    }

    public function changeName()
    {
        $this->validatorService->validateNewName($_POST);

        $this->userService->changeName($_POST);

        $_SESSION['name_changed'] = true;

        redirectTo('/settings');
    }

    public function deleteAccount()
    {
        $this->userService->deleteAccount();

        $this->userService->logout();

        redirectTo('/index');
    }
}
