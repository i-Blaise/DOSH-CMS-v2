<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\PrivacyStatement;
use Illuminate\Http\Request;

class MiscController extends Controller
{
    function index()
    {
        $statement = PrivacyStatement::find(1);
        return view('dashboard.pages.privacy-statement', [
            'statement' => $statement
        ]);
    }

    function updatePrivacyStatement(Request $request)
    {
        $statement = PrivacyStatement::find(1);
        $statement->privacy_statement = $request->privacy_statement;
        $statement->save();

        logActivity("Updated Privacy Statement");
        return redirect()->back()->with('success', 'Privacy Statement updated successfully');
    }
}
