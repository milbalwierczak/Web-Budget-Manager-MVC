<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
    HomeController,
    AboutController,
    AuthController,
    TransactionController,
    ReceiptController,
    ErrorController
};
use App\Middleware\{
    AuthRequiredMiddleware,
    GuestOnlyMiddleware
};

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/index', [AuthController::class, 'indexView'])->add(GuestOnlyMiddleware::class);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/expense', [TransactionController::class, 'expenseView'])->add(AuthRequiredMiddleware::class);
    $app->post('/expense', [TransactionController::class, 'createExpense'])->add(AuthRequiredMiddleware::class);
    $app->get('/income', [TransactionController::class, 'incomeView'])->add(AuthRequiredMiddleware::class);
    $app->post('/income', [TransactionController::class, 'createIncome'])->add(AuthRequiredMiddleware::class);
    $app->get('/balance', [TransactionController::class, 'balanceView'])->add(AuthRequiredMiddleware::class);
    $app->post('/balance', [TransactionController::class, 'customBalance'])->add(AuthRequiredMiddleware::class);
    $app->get('/balancePreviousMonth', [TransactionController::class, 'balancePreviousMonth'])->add(AuthRequiredMiddleware::class);
    $app->get('/balanceCurrentYear', [TransactionController::class, 'balanceCurrentYear'])->add(AuthRequiredMiddleware::class);
    $app->editIncome('/balance', [TransactionController::class, 'editIncome'])->add(AuthRequiredMiddleware::class);
    $app->editExpense('/balance', [TransactionController::class, 'editExpense'])->add(AuthRequiredMiddleware::class);
    $app->deleteIncome('/balance', [TransactionController::class, 'deleteIncome'])->add(AuthRequiredMiddleware::class);
    $app->deleteExpense('/balance', [TransactionController::class, 'deleteExpense'])->add(AuthRequiredMiddleware::class);

    $app->setErrorHandler([ErrorController::class, 'notFound']);
}
