<?php


namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboards.admin.pages.dashboard.index');
    }

}
