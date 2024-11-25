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

    public function addIncomeCategory()
    {
        $this->validatorService->validateNewIncomeCategory($_POST);

        $this->userService->doesIncomeCategoryExist($_POST['newIncomeCategory']);

        $this->userService->addNewIncomeCategory($_POST);

        $_SESSION['income_category_added'] = true;

        redirectTo('/settings');
    }


    public function editIncomeCategory()
    {
        $this->validatorService->validateEditedIncomeCategory($_POST);

        $this->userService->doesIncomeCategoryExist($_POST['newIncomeCategory']);

        $this->userService->editIncomeCategory($_POST);

        $_SESSION['income_category_edited'] = true;

        redirectTo('/settings');
    }

    public function deleteIncomeCategory()
    {
        $deletedId = $this->transactionService->getIncomeCategoryId($_POST['category']);
        $othersId = $this->transactionService->getIncomeCategoryId('Inne');

        $this->userService->deleteIncomeCategory($_POST, $deletedId, $othersId);

        $_SESSION['income_category_deleted'] = true;

        redirectTo('/settings');
    }

    public function addExpenseCategory()
    {
        $this->validatorService->validateNewExpenseCategory($_POST);

        $this->userService->doesExpenseCategoryExist($_POST['newExpenseCategory']);

        $this->userService->addNewExpenseCategory($_POST);

        $_SESSION['expense_category_added'] = true;

        redirectTo('/settings');
    }


    public function editExpenseCategory()
    {
        $this->validatorService->validateEditedExpenseCategory($_POST);

        $this->userService->doesExpenseCategoryExist($_POST['newExpenseCategory']);

        $this->userService->editExpenseCategory($_POST);

        $_SESSION['expense_category_edited'] = true;

        redirectTo('/settings');
    }

    public function deleteExpenseCategory()
    {
        $deletedId = $this->transactionService->getExpenseCategoryId($_POST['category']);
        $othersId = $this->transactionService->getExpenseCategoryId('Inne');

        $this->userService->deleteExpenseCategory($_POST, $deletedId, $othersId);

        $_SESSION['expense_category_deleted'] = true;

        redirectTo('/settings');
    }

    public function addPaymentMethod()
    {
        $this->validatorService->validateNewPaymentMethod($_POST);

        $this->userService->doesPaymentMethodExist($_POST['newPaymentMethod']);

        $this->userService->addNewPaymentMethod($_POST);

        $_SESSION['payment_method_added'] = true;

        redirectTo('/settings');
    }

    public function editPaymentMethod()
    {
        $this->validatorService->validateEditedPaymentMethod($_POST);

        $this->userService->doesPaymentMethodExist($_POST['newPaymentMethod']);

        $this->userService->editPaymentMethod($_POST);

        $_SESSION['payment_method_edited'] = true;

        redirectTo('/settings');
    }

    public function deletePaymentMethod()
    {
        $deletedId = $this->transactionService->getPaymentMethodId($_POST['method']);
        $cashId = $this->transactionService->getPaymentMethodId('Gotówka');

        $this->userService->deletePaymentMethod($_POST, $deletedId, $cashId);

        $_SESSION['payment_method_deleted'] = true;

        redirectTo('/settings');
    }
}
