<?php

namespace App;


class Validator
{
    private $value;
    private $field;

    public function __construct($value, $field)
    {
        $this->value = $value;
        $this->field = $field;
    }

    public function require(): self
    {
        if (empty($this->value)) {
            throw new ValidatorException("El campo {$this->field} es requerido");
        }

        return $this;
    }


    public function min($min): self
    {
        if ($this->value < $min) {
            throw new ValidatorException("El campo {$this->field} tiene que ser mas grande que ($min)");
        }
        return $this;
    }
}
