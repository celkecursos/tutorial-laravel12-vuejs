<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Listar as tarefas
     */
    public function index(Request $request)
    {

        // Recuperar as tarefas do banco de dados
        // $tasks = Task::orderBy('started_at', 'ASC')->paginate(10);
        $tasks = Task::when(
            $request->filled('name'),
            fn($query) => $query->whereLike('name', '%' . $request->name . '%')
        )
        ->when(
            $request->filled('started_at'),
            fn($query) => $query->where('started_at', '>=', Carbon::parse($request->started_at))
        )
        ->when(
            $request->filled('finished_at'),
            fn($query) => $query->where('finished_at', '<=', Carbon::parse($request->finished_at))
        )
        ->orderBy('started_at', 'ASC')
        ->paginate(10)
        ->withQueryString();

        // Enviar os dados diretamente para a view
        return Inertia::render('tasks/Index', [
            'tasks' => $tasks,
            'name' => $request->name,
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
        ]);
    }

    // Visualizar os detalhes da tarefa
    public function show(Task $task)
    {

        // Enviar os dados diretamente para a view
        return Inertia::render('tasks/Show', ['task' => $task]);
    }

    // Carregar o formulário cadastrar tarefa
    public function create()
    {
        return Inertia::render('tasks/Create');
    }

    // Cadastrar o tarefa no banco de dados
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'started_at' => 'required|date',
                'finished_at' => 'required|date|after_or_equal:started_at',
            ],
            [
                'name.required' => "Campo nome é obrigatório!",

                'started_at.required' => "Campo data/hora de início é obrigatório!",
                'started_at.date' => "Informe uma data/hora válida para o início!",

                'finished_at.required' => "Campo data/hora de término é obrigatório!",
                'finished_at.date' => "Informe uma data/hora válida para o término!",
                'finished_at.after_or_equal' => "A data de término deve ser igual ou posterior à data de início!",
            ]
        );


        // Capturar possíveis exceções durante a execução.
        try {
            $task = Task::create([
                'name' => $request->name,
                'started_at' => $request->started_at,
                'finished_at' => $request->finished_at,
            ]);

            return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Tarefa cadastrada com sucesso!');
        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Tarefa não cadastrada!');
        }
    }

    // Carregar o formulário editar tarefa
    public function edit(Task $task)
    {

        return Inertia::render('tasks/Edit', ['task' => $task]);
    }

    // Editar a tarefa no banco de dados
    public function update(Task $task, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'started_at' => 'required|date',
                'finished_at' => 'required|date|after_or_equal:started_at',
            ],
            [
                'name.required' => "Campo nome é obrigatório!",

                'started_at.required' => "Campo data/hora de início é obrigatório!",
                'started_at.date' => "Informe uma data/hora válida para o início!",

                'finished_at.required' => "Campo data/hora de término é obrigatório!",
                'finished_at.date' => "Informe uma data/hora válida para o término!",
                'finished_at.after_or_equal' => "A data de término deve ser igual ou posterior à data de início!",
            ]
        );

        // Capturar possíveis exceções durante a execução.
        try {

            $task->update([
                'name' => $request->name,
                'started_at' => $request->started_at,
                'finished_at' => $request->finished_at,
            ]);

            return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Tarefa editada com sucesso!');
        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Tarefa não editada!');
        }
    }

    // Apagar a tarefa
    public function destroy(Task $task)
    {
        // Capturar possíveis exceções durante a execução.
        try {
            $task->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('tasks.index')->with('success', 'Tarefa apagada com sucesso!');
        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('tasks.index')->with('error', 'Tarefa não apagada!');
        }
    }
}
