<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    public function index()
    {
        return view('weight_logs.index'); // `resources/views/weight_logs/index.blade.php`
    }
}
