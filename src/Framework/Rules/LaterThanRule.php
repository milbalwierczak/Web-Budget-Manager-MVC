<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class LaterThanRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $fieldOne = \DateTime::createFromFormat('d-m-Y', $data[$field]);;
        $fieldTwo = \DateTime::createFromFormat('d-m-Y', $data[$params[0]]);

        return $fieldOne > $fieldTwo;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return 'Wprowadź prawidłowy zakres dat';
    }
}
