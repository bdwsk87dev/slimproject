<?php

declare(strict_types=1);

namespace App\Controllers\Validators;

use App\Controllers\Services\AuthService;
use Respect\Validation\Exceptions\NestedValidationException;

class AuthValidator
{
    protected $requestHandler;
    public $errors = [];

    public function validate($request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($field)->assert(AuthService::getParam($request, $field));
            } catch (NestedValidationException $ex) {
                $this->errors[$field] = $ex->getMessages();
            }
        }
        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

}