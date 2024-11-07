<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\{TransactionService, UserService};

class HomeController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private UserService $userService
    ) {}

    public function home()
    {
        $balance = $this->transactionService->getUserBalance();

        $username = $this->userService->getUserName();

        [$quote, $author] = $this->userService->getDailyQuote();

        echo $this->view->render("/home.php", [
            'balance' => $balance,
            'username' => $username,
            'quote' => $quote,
            'author' => $author,
        ]);
    }
}
