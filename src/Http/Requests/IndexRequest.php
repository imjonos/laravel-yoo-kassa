<?php

declare(strict_types=1);

namespace Nos\Yookassa\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRequest
 * @package Nos\CRUD
 */
final class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['string', 'required'],
            'event' => ['string', 'required'],
            'object' => ['array', 'required'],

        ];
    }
}
