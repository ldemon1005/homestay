<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class ModController extends Controller
{
    protected $admin;

    public function __construct()
    {
        $this->admin = new Admin;
    }

    public function index()
    {
        $data['admins'] = $this->admin->get();
        return view('admin.mod.list', $data);
    }

    public function getAdd()
    {
        return view('admin.mod.add');
    }

    public function postAdd()
    {
        return back();
    }
}
