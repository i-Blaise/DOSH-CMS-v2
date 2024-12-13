<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivacyStatement;
use Illuminate\Http\Request;

class MiscController extends Controller
{
    public function getPrivacyStatement()
    {
        $statement = PrivacyStatement::find(1);
        return response()->json([
            'privacy_statement' => $statement->privacy_statement
        ]);
    }
}
