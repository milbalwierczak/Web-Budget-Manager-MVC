<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    MinRule,
    InRule,
    UrlRule,
    MatchRule,
    LengthMaxRule,
    NumericRule,
    DateFormatRule,
    RecaptchaRule,
    LaterThanRule,
    PositiveNumberRule
};

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('match', new MatchRule());
        $this->validator->add('lengthMax', new LengthMaxRule());
        $this->validator->add('numeric', new NumericRule());
        $this->validator->add('dateFormat', new DateFormatRule());
        $this->validator->add('recaptcha', new RecaptchaRule());
        $this->validator->add('laterThan', new LaterThanRule());
        $this->validator->add('positive', new PositiveNumberRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'name' => ['required', 'lengthMax:50'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'g-recaptcha-response' => ['recaptcha']
        ]);
    }

    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

    public function validateExpense(array $formData)
    {
        $this->validator->validate($formData, [
            'value' => ['required', 'numeric', 'positive'],
            'date' => ['required', 'dateFormat:d-m-Y'],
            'category' => ['required'],
            'method' => ['required'],
            'description' => ['lengthMax:255']
        ]);
    }

    public function validateIncome(array $formData)
    {
        $this->validator->validate($formData, [
            'value' => ['required', 'numeric', 'positive'],
            'date' => ['required', 'dateFormat:d-m-Y'],
            'category' => ['required'],
            'description' => ['lengthMax:255']
        ]);
    }

    public function validateBalance(array $formData)
    {
        $this->validator->validate($formData, [
            'dateStart' => ['required', 'dateFormat:d-m-Y'],
            'dateEnd' => ['required', 'dateFormat:d-m-Y', 'laterThan:dateStart']
        ]);
    }

    public function validateNewPassword(array $formData)
    {
        $this->validator->validate($formData, [
            'newPassword' => ['required'],
            'confirmNewPassword' => ['required', 'match:newPassword'],
        ]);
    }

    public function validateNewName(array $formData)
    {
        $this->validator->validate($formData, [
            'name' => ['required', 'lengthMax:50']
        ]);
    }
}
