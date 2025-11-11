<script setup lang="ts">
/* Importa o layout padrão do sistema */
import AppLayout from '@/layouts/AppLayout.vue'

/* Importa os componentes do Inertia */
import { Link, Head, useForm } from '@inertiajs/vue3'

/* Importa tipos e ícones */
import { type BreadcrumbItem } from '@/types'
import { Save, List, Eye } from 'lucide-vue-next'

/* Importar o componente para apresentar a mensagem de sucesso e erro */
import FlashMessage from '@/components/FlashMessage.vue';

/* Recebe o Tarefa da Controller */
const props = defineProps<{
    task: {
        id: number
        name: string
        started_at: string
        finished_at: string
    }
}>()

/* Define os breadcrumbs */
const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Tarefas', href: '/tasks' },
    { title: 'Editar Tarefa', href: '' }
]

// Formatar a data
function formatDateTime(datetime?: string | null): string {
    if (!datetime) return '';
    const date = new Date(datetime);
    const tzOffset = date.getTimezoneOffset() * 60000;
    return new Date(date.getTime() - tzOffset).toISOString().slice(0, 16);
}

/* Cria o formulário com os valores atuais */
const form = useForm({
    name: props.task.name,
    started_at: formatDateTime(props.task.started_at),
    finished_at: formatDateTime(props.task.finished_at),
})

/* Envia os dados para o backend */
const submit = () => {
    form.put(`/tasks/${props.task.id}`)
}

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Editar Tarefa" />

        <div class="content-box">
            <div class="content-box-header">
                <h3 class="content-box-title">Editar Tarefa</h3>
                <div class="content-box-btn">
                    <Link href="/tasks" class="btn-info align-icon-btn">
                    <List class="w-4 h-4" />
                    <span>Listar</span>
                    </Link>

                    <Link :href="`/tasks/${props.task.id}`" class="btn-primary align-icon-btn">
                    <Eye class="w-4 h-4" />
                    <span>Visualizar</span>
                    </Link>
                </div>
            </div>

            <!-- Apresentar a mensagem de sucesso ou erro -->
            <FlashMessage />

            <!-- Formulário -->
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="name" class="form-label">Nome *</label>
                    <input id="name" v-model="form.name" type="text" class="form-input"
                        placeholder="Digite o nome da tarefa" required />
                    <div v-if="form.errors.name" class="form-error">{{ form.errors.name }}</div>
                </div>

                <div class="mb-4">
                    <label for="started_at" class="form-label">Data de Início *</label>
                    <input id="started_at" v-model="form.started_at" type="datetime-local" class="form-input"
                        required />
                    <div v-if="form.errors.started_at" class="form-error">{{ form.errors.started_at }}</div>
                </div>

                <div class="mb-4">
                    <label for="finished_at" class="form-label">Data Final *</label>
                    <input id="finished_at" v-model="form.finished_at" type="datetime-local" class="form-input"
                        required />
                    <div v-if="form.errors.finished_at" class="form-error">{{ form.errors.finished_at }}</div>
                </div>

                <div class="mb-4">
                    <span class="required-field">* Campo obrigatório</span>
                </div>

                <button type="submit" class="btn-success align-icon-btn" :disabled="form.processing">
                    <Save class="w-4 h-4" />
                    <span>{{ form.processing ? 'Salvando...' : 'Salvar' }}</span>
                </button>
            </form>
        </div>
    </AppLayout>
</template>
