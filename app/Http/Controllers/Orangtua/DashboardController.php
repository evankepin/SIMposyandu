<?php
namespace App\Http\Controllers\Orangtua;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('orangtua.dashboard');
    }
}
