<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class PositiveNumberRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        return $data[$field] > 0;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Wprowadź liczbę większą od 0";
    }
}
