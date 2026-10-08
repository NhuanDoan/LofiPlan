<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'date' => ['sometimes', 'date_format:Y-m-d'],
        ]);
        $base = isset($validated['date']) ? Carbon::createFromFormat('Y-m-d', $validated['date']) : Carbon::today();

        $startOfWeek = $base->copy()->startOfWeek();
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = $startOfWeek->copy()->addDays($i);
        }

        $start = $days[0]->toDateString();
        $end = $days[6]->toDateString();

        $todos = Todo::where('user_id', Auth::id())
                     ->whereBetween('date', [$start, $end])
                     ->orderBy('date')
                     ->orderByRaw("CASE shift WHEN 'morning' THEN 0 WHEN 'afternoon' THEN 1 WHEN 'evening' THEN 2 ELSE 3 END")
                     ->get()
                     ->groupBy(fn($t) => $t->date->toDateString());

        return view('todos.index', compact('days','todos','base'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'date' => 'required|date_format:Y-m-d',
            'shift' => 'required|in:morning,afternoon,evening',
        ]);

        $data['user_id'] = Auth::id();

        $todo = Todo::create($data);

        if ($request->wantsJson()) {
            return response()->json($todo, 201);
        }

        return redirect()->back()->with('success', 'Đã thêm công việc');
    }

    public function show(Todo $todo)
    {
        $this->authorizeTodo($todo);
        return response()->json($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorizeTodo($todo);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'is_done' => 'sometimes|boolean',
        ]);

        $todo->update($data);

        return response()->json($todo);
    }

    public function toggleDone(Todo $todo)
    {
        $this->authorizeTodo($todo);
        $todo->update(['is_done' => ! $todo->is_done]);

        if (request()->wantsJson()) {
            return response()->json($todo);
        }

        return redirect()->back()->with('success', 'Trạng thái công việc đã được cập nhật.');
    }

    public function destroy(Todo $todo)
    {
        $this->authorizeTodo($todo);

        $todo->delete();

        if (request()->wantsJson()) {
            return response()->json(['deleted' => true]);
        }

        return redirect()->back()->with('success', 'Đã xóa');
    }

    private function authorizeTodo(Todo $todo)
    {
        abort_unless($todo->user_id === Auth::id(), 403, 'Không có quyền truy cập công việc này');
    }
}
