<script setup lang="ts">
/* Importa o layout padrão do sistema */
import AppLayout from '@/layouts/AppLayout.vue'

/* Importa o tipo BreadcrumbItem para tipar corretamente os breadcrumbs */
import { type BreadcrumbItem } from '@/types'
import { Link } from '@inertiajs/vue3'

/* Importar ícone */
import { List, Pencil } from 'lucide-vue-next'

/* Importar o componente para apresentar a mensagem de sucesso e erro */
import FlashMessage from '@/components/FlashMessage.vue'

/* Importar o componente para excluir o registro */
import DeleteButton from '@/components/DeleteButton.vue'


/* Define a interface do veículo */
export interface Task {
    id: number;
    name: string;
    started_at: string;
    finished_at: string;
    created_at: string;
    updated_at: string;
}

/* Recebe a tarefa vindo da controller via Inertia */
const props = defineProps<{
    task: Task;
}>();

/* Define os breadcrumbs exibidos no topo da página */
const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Tarefas', href: '/tasks' },
    { title: 'Visualizar Tarefa', href: '' },
];

</script>

<template>
    <!-- Usa o layout principal do sistema -->
    <AppLayout :breadcrumbs="breadcrumbItems">
        <!-- Define o título da aba -->

        <Head title="Veículo" />

        <!-- Container principal -->
        <div class="content-box">

            <!-- Título -->
            <div class="content-box-header">
                <h3 class="content-box-title">Detalhes do Veículo</h3>
                <div class="content-box-btn">

                    <Link href="/tasks" class="btn-info align-icon-btn">
                    <List class="w-4 h-4" />
                    <span>Listar</span>
                    </Link>

                    <Link :href="`/tasks/${props.task.id}/edit`" class="btn-warning align-icon-btn">
                    <Pencil class="w-4 h-4" />
                    <span>Editar</span>
                    </Link>

                    <DeleteButton :url="`/tasks/${props.task.id}`" title="Deseja realmente apagar esta tarefa?" />

                </div>
            </div>

            <!-- Apresentar a mensagem de sucesso ou erro -->
            <FlashMessage />

            <!-- Card com informações -->
            <div class="detail-box">

                <p><strong class="title-detail-content">ID:</strong> <span class="detail-content">{{ props.task.id
                }}</span></p>
                <p><strong class="title-detail-content">Modelo:</strong> <span class="detail-content">{{
                    props.task.name
                        }}</span></p>
                <p><strong class="title-detail-content">Ano:</strong> <span class="detail-content">{{
                    props.task.started_at ? new
                        Date(props.task.started_at).toLocaleString() : ''
                        }}</span></p>
                <p><strong class="title-detail-content">Ano:</strong> <span class="detail-content">{{
                    props.task.finished_at ? new
                        Date(props.task.finished_at).toLocaleString() : ''
                        }}</span></p>
                <p><strong class="title-detail-content">Criado em:</strong> <span class="detail-content">{{ new
                    Date(props.task.created_at).toLocaleString() }}</span></p>
                <p><strong class="title-detail-content">Atualizado em:</strong> <span class="detail-content">{{ new
                    Date(props.task.updated_at).toLocaleString() }}</span></p>
            </div>

        </div>
    </AppLayout>
</template>
