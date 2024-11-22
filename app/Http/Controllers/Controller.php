<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function _update(Request $request, mixed $object)
    {
        // TODO: Validate and return client error if something's not right.
        foreach ($object::API_FIELDS as $fieldName) {
            $value = $request->input($fieldName);
            if ($value !== null)
                $object->$fieldName = $value;
        }
        $object->save();
    }
}
