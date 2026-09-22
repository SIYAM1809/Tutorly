<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match(true) {
            $user->hasRole('super_admin')  => view('dashboard.super-admin'),
            $user->hasRole('branch_admin') => view('dashboard.branch-admin'),
            $user->hasRole('teacher')      => view('dashboard.teacher'),
            $user->hasRole('student')      => view('dashboard.student'),
            $user->hasRole('parent')       => view('dashboard.parent'),
            default                        => abort(403, 'Unauthorised. Your account has no assigned role.'),
        };
    }
}
