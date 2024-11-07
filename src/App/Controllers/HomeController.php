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
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');

        $balance = $this->transactionService->getUserBalance($start_date, $end_date);

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
