<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ApiRequest extends FormRequest
{
    /**
     * Returns json response with error messages if validation fails
     * 
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errorArray = [];
        foreach ($validator->getMessageBag()->toArray() as $error) {
            $errorArray = array_merge($errorArray, $error);
        }
        $errorText = implode(',', $errorArray);

        throw new HttpResponseException(
            response()->json(['success' => false, 'errors' => $errorText], 422)
        );
    }
}
