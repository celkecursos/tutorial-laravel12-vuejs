<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model para a tabela de tarefas.
 *
 * Representa as tarefas do sistema, armazenando o nome da tarefa,
 * a data/hora de início e a data/hora de término.
 */
class Task extends Model
{
    use HasFactory;

    /**
     * Nome da tabela associada ao model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * Campos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'started_at',
        'finished_at',
    ];

    /**
     * Tipos de dados que devem ser convertidos automaticamente.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}
