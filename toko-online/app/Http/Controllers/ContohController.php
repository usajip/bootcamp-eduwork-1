<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function index($name)
    {
        $fruits = [
            ['name' => 'apple', 'stock'=>10],
            ['name' => 'banana', 'stock'=>5],
        ];
        return view('contoh', compact('fruits'));
    }

    public function index2()
    {
        $title = '<h1>halaman contoh 2</h1>';
        $users = ['John', 'Jane', 'Bob'];
        return view('contoh2', compact('title', 'users'));
    }
}
