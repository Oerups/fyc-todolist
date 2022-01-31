<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Task;

class TodoListController extends Controller
{
    public function index()
    {
        return response()->json(Task::all());
    }

    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        return response()->json($task);
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $validated = $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $task->delete();
        return response()->json(null, 204);
    }
}
