<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $req) {
        return response()->json([
            'success' => true,
            'message' => "Thank you for your report. We will review it as soon as possible"
        ]);
    }
    
}
