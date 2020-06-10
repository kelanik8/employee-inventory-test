<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function home() {
        return view('views.home-dashboard');
    }

    public function createEmployee() {
        return view('views.create-employee');
    }
    
    public function editEmployee($id) {
        return view('views.edit-employee');
    }
}
