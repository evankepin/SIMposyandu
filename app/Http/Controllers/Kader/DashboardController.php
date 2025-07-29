<?php
namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('kader.dashboard');
    }
}
