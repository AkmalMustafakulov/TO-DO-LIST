<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $todo_list = TodoList::where('user_id', '=', $user_id)->get();

        return $todo_list;
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255|string',
            'user_id' => 'required|numeric',
            'is_done' => 'required|boolean'
        ]);
        $new_todo_list = TodoList::create($request->validated());
        return $new_todo_list;
    }
    public function update(Request $request, TodoList $todo_list) {
        $request->validate([
            'title' => 'required|max:255|string',
            'user_id' => 'required|numeric',
            'is_done' => 'required|boolean'
        ]);
        $todo_list->update($request->validated());
        return $todo_list;
    }
    public function destroy(TodoList $todo_list) {
        $todo_list->delete();
        return $todo_list;
    }
}
