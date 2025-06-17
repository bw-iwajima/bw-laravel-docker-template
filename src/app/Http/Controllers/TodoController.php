<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;

class TodoController extends Controller
{
    //<ここから>
    public function index()
    {
        $todo = new Todo();
        $todos = $todo->all();
        dd($todos);
        
        return view('todo.index');
    }
    //<ここまで>
}
