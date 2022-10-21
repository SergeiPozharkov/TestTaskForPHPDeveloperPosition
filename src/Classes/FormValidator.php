<?php

namespace App\Classes;

use App\Interfaces\IValidator;

class FormValidator implements IValidator
{
    private array $data;

    private static array $fields = ['ramSize', 'fileSize'];

    public function __construct($postData)
    {
        $this->data = $postData;
    }

    public function validateForm(): bool
    {
        foreach (static::$fields as $field) {
            if (!empty($this->data[$field]) && $this->data[$field] != "") {
                return true;
            }
        }
        return false;
    }
}