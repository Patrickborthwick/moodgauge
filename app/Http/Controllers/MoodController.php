<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
        return view('mood.index');
    }

    public function store() {}

    public function create() {}
    public function show() {}
}
