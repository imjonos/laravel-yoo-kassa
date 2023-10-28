<?php

namespace Nos\Yookassa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRequest
 * @package Nos\CRUD
 */
class IndexRequest extends FormRequest
{
    /**
     * authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * rules
     */
    public function rules(): array
    {
        return [
        ];
    }
}
