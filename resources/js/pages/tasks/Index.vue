<script setup lang="ts">
/* Importa o layout padrão do sistema para envolver a página */
import AppLayout from '@/layouts/AppLayout.vue';

/* Importa o componente Link do Inertia para navegação sem reload */
import { Link } from '@inertiajs/vue3';

/* Importa o tipo BreadcrumbItem para tipar corretamente os breadcrumbs */
import { type BreadcrumbItem } from '@/types';
import { CirclePlus, Eye, Pencil } from 'lucide-vue-next';

/* Importar o componente de paginação */
import Pagination from '@/components/Pagination.vue';

/* Importar o componente para apresentar a mensagem de sucesso e erro */
import FlashMessage from '@/components/FlashMessage.vue';

/* Importar o componente para excluir o registro */
import DeleteButton from '@/components/DeleteButton.vue'

/* Define a interface do veículo, útil para tipagem TypeScript */
export interface Vehicle {
    id: number;
    name: string;
    started_at: string;
    finished_at: string;
}

/* Recebe os dados da controller via props usando Inertia */
const props = defineProps<{
    tasks: {
        data: Vehicle[]; // Lista de Tarefas
        links: { url: string | null; label: string; active: boolean }[]; // Links da paginação
    };
}>();

/* Define os breadcrumbs que serão exibidos no layout */
const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Tarefas', href: '' },
];

</script>

<template>
    <!-- Usa o layout padrão e passa os breadcrumbs para exibição -->
    <AppLayout :breadcrumbs="breadcrumbItems">

        <!-- Define o título da página para o <head> -->

        <Head title="Tarefas" />

        <!-- Container principal da página -->
        <div class="content-box">

            <!-- Título da seção -->
            <div class="content-box-header">
                <h3 class="content-box-title">Tarefas</h3>
                <div class="content-box-btn">

                    <Link href="/tasks/create"
                        class="bg-green-500 text-white text-sm px-2 py-1 rounded hover:bg-green-600 transition-colors cursor-pointer flex items-center space-x-1">
                    <CirclePlus class="w-4 h-4" />
                    <span>Cadastrar</span>
                    </Link>

                </div>
            </div>

            <!-- Apresentar a mensagem de sucesso ou erro -->
            <FlashMessage />

            <!-- Container da tabela com bordas e sombra -->
            <div class="table-container">

                <!-- Tabela de Tarefas -->
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <!-- Cabeçalhos da tabela -->
                            <th class="table-row-header">
                                ID</th>
                            <th class="table-row-header">
                                Nome</th>
                            <th class="table-row-header">
                                Início</th>
                            <th class="table-row-header">
                                Fim</th>
                            <th class="table-row-header">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Itera sobre os Tarefas recebidos das props -->
                        <tr v-for="task in props.tasks.data" :key="task.id" class="table-body">
                            <!-- Colunas da tabela -->
                            <td class="table-row-body ">
                                {{ task.id }}</td>
                            <td class="table-row-body ">
                                {{ task.name }}</td>
                            <td class="table-row-body ">
                                {{ task.started_at ? new
                                    Date(task.started_at).toLocaleString() : '' }}</td>
                            <td class="table-row-body ">
                                {{ task.finished_at ? new
                                    Date(task.finished_at).toLocaleString() : '' }}</td>
                            <td class="table-actions">
                                <div class="table-actions-align">

                                    <Link :href="`/tasks/${task.id}`" class="btn-primary align-icon-btn">
                                    <Eye class="w-4 h-4" />
                                    <span>Visualizar</span>
                                    </Link>

                                    <Link :href="`/tasks/${task.id}/edit`" class="btn-warning align-icon-btn">
                                    <Pencil class="w-4 h-4" />
                                    <span>Editar</span>
                                    </Link>

                                    <!-- Botão de apagar -->
                                    <!-- Usa o componente genérico -->
                                    <DeleteButton :url="`/tasks/${task.id}`"
                                        title="Deseja realmente apagar esta tarefa?" />

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <Pagination :links="props.tasks.links" />

            </div>
        </div>

    </AppLayout>
</template>
