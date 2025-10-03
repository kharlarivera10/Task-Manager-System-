<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Fetch all tasks
    public function index()
    {
        return response()->json(Task::orderBy('created_at', 'desc')->get());
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'content' => $request->content,
        ]);

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['content' => 'required|string|max:255']);
        $task = Task::findOrFail($id);
        $task->update(['content' => $request->content]);
        return response()->json($task);
    }


    // Delete task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['Deleted' => true]);
    }
}
