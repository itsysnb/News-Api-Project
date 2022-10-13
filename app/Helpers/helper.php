<?php

use Illuminate\Validation\ValidationException;

function checkPassword($requestPwd, $originalPwd)
{
    if (!$requestPwd == $originalPwd) {
        throw ValidationException::withMessages(['password' => 'The provided credentials are incorrect.']);
    }

}
