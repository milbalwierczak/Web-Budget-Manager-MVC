<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class RecaptchaRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        $chceck_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $_ENV['RECAPTCHA_SECRET'] . '&response=' . $data[$field]);

        $answer = json_decode($chceck_captcha);

        return $answer->success;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Potwierdź, że nie jesteś botem!";
    }
}
