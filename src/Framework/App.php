<?php

declare(strict_types=1);

namespace Framework;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(string $containerDefinitionsPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefinitionsPath) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, array $controller): App
    {
        $this->router->add('GET', $path, $controller);

        return $this;
    }

    public function post(string $path, array $controller): App
    {
        $this->router->add('POST', $path, $controller);

        return $this;
    }

    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }

    public function add(string $middleware)
    {
        $this->router->addRouteMiddleware($middleware);
    }

    public function deleteIncome(string $path, array $controller): App
    {
        $this->router->add('DELETE_INCOME', $path, $controller);

        return $this;
    }

    public function deleteExpense(string $path, array $controller): App
    {
        $this->router->add('DELETE_EXPENSE', $path, $controller);

        return $this;
    }

    public function editIncome(string $path, array $controller): App
    {
        $this->router->add('EDIT_INCOME', $path, $controller);

        return $this;
    }

    public function editExpense(string $path, array $controller): App
    {
        $this->router->add('EDIT_EXPENSE', $path, $controller);

        return $this;
    }

    public function changePassword(string $path, array $controller): App
    {
        $this->router->add('CHANGE_PASSWORD', $path, $controller);

        return $this;
    }

    public function changeName(string $path, array $controller): App
    {
        $this->router->add('CHANGE_NAME', $path, $controller);

        return $this;
    }


    public function deleteAccount(string $path, array $controller): App
    {
        $this->router->add('DELETE_ACCOUNT', $path, $controller);

        return $this;
    }


    public function addIcnomeCategory(string $path, array $controller): App
    {
        $this->router->add('ADD_INCOME_CATEGORY', $path, $controller);

        return $this;
    }

    public function editIncomeCategory(string $path, array $controller): App
    {
        $this->router->add('EDIT_INCOME_CATEGORY', $path, $controller);

        return $this;
    }


    public function deleteIncomeCategory(string $path, array $controller): App
    {
        $this->router->add('DELETE_INCOME_CATEGORY', $path, $controller);

        return $this;
    }


    public function addExpenseCategory(string $path, array $controller): App
    {
        $this->router->add('ADD_EXPENSE_CATEGORY', $path, $controller);

        return $this;
    }

    public function editExpenseCategory(string $path, array $controller): App
    {
        $this->router->add('EDIT_EXPENSE_CATEGORY', $path, $controller);

        return $this;
    }


    public function deleteExpenseCategory(string $path, array $controller): App
    {
        $this->router->add('DELETE_EXPENSE_CATEGORY', $path, $controller);

        return $this;
    }


    public function addPaymentMethod(string $path, array $controller): App
    {
        $this->router->add('ADD_PAYMENT_METHOD', $path, $controller);

        return $this;
    }

    public function editPaymentMethod(string $path, array $controller): App
    {
        $this->router->add('EDIT_PAYMENT_METHOD', $path, $controller);

        return $this;
    }

    public function deletePaymentMethod(string $path, array $controller): App
    {
        $this->router->add('DELETE_PAYMENT_METHOD', $path, $controller);

        return $this;
    }

    public function setErrorHandler(array $controller)
    {
        $this->router->setErrorHandler($controller);
    }
}
