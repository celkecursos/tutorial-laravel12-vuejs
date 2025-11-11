<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Executa a criação de registros na tabela tasks.
     */
    public function run(): void
    {
        Task::insert([
            [
                'name' => 'Create login page',
                'started_at' => Carbon::now()->subDays(2),
                'finished_at' => Carbon::now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Implement user authentication',
                'started_at' => Carbon::now()->subDay(),
                'finished_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test system cache cleaning',
                'started_at' => Carbon::now(),
                'finished_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
