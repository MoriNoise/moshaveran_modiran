<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\MessageGroup;
use App\Models\MessageTemplate;
use App\Models\User;


class DashboardController extends Controller
{

    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = Admin::count();
        $totalTemplates = MessageTemplate::count();
        $totalGroups = MessageGroup::count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.index', compact(
            'totalUsers',
            'totalAdmins',
            'totalTemplates',
            'totalGroups',
            'recentUsers'
        ));
    }

}

