<?php

namespace Squarebit\EVA\Rules;

use Illuminate\Contracts\Validation\Rule;
use Squarebit\EVA\EVA;

class EVAValidated implements Rule
{
    /** @var bool */
    protected $required;

    /** @var string */
    protected $attribute;

    /** @var \Squarebit\EVA\EVA */
    protected $evaService;

    public function __construct()
    {
        $this->required = true;
        $this->evaService = new EVA();
    }

    public function nullable(): self
    {
        $this->required = false;
        return $this;
    }

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        if (!$this->required && ($value === '0' || $value === 0 || $value === null)) {
            return true;
        }

        return $this->evaService->validateEmail($value);
    }

    public function message(): string
    {
        return __('Email is not valid');
    }
}
