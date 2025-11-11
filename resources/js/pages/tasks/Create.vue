<script setup lang="ts">
/* Importa o layout padrão do sistema */
import AppLayout from '@/layouts/AppLayout.vue';

/* Importa os componentes do Inertia */
import { Link, Head, useForm } from '@inertiajs/vue3';

/* Importa tipos e ícones */
import { type BreadcrumbItem } from '@/types';
import { CirclePlus, List } from 'lucide-vue-next';

/* Importar o componente para apresentar a mensagem de sucesso e erro */
import FlashMessage from '@/components/FlashMessage.vue';

/* Define os breadcrumbs da página */
const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Tarefas', href: '/tasks' },
    { title: 'Cadastrar Tarefa', href: '' }
];

/* Cria o formulário com os campos e valores iniciais */
const form = useForm({
    name: '',
    started_at: '',
    finished_at: '',
});

/* Envia o formulário para o backend */
const submit = () => {
    form.post('/tasks');
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">

        <Head title="Cadastrar Tarefa" />

        <div class="content-box">
            <div class="content-box-header">
                <h3 class="content-box-title">Cadastrar Tarefa</h3>
                <div class="content-box-btn">
                    <Link href="/tasks" class="btn-info align-icon-btn">
                    <List class="w-4 h-4" />
                    <span>Listar</span>
                    </Link>
                </div>
            </div>

            <!-- Apresentar a mensagem de sucesso ou erro -->
            <FlashMessage />

            <!-- Formulário -->
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="name" class="form-label">Nome *</label>
                    <input id="name" v-model="form.name" type="text" class="form-input" placeholder="Digite o nome da tarefa"
                         />
                    <div v-if="form.errors.name" class="form-error">{{ form.errors.name }}</div>
                </div>

                <div class="mb-4">
                    <label for="started_at" class="form-label">Data de Início *</label>
                    <input id="started_at" v-model="form.started_at" type="datetime-local" class="form-input" required />
                    <div v-if="form.errors.started_at" class="form-error">{{ form.errors.started_at }}</div>
                </div>

                <div class="mb-4">
                    <label for="finished_at" class="form-label">Data Final *</label>
                    <input id="finished_at" v-model="form.finished_at" type="datetime-local" class="form-input" required />
                    <div v-if="form.errors.finished_at" class="form-error">{{ form.errors.finished_at }}</div>
                </div>

                <div class="mb-4">
                    <span class="required-field">* Campo obrigatório</span>
                </div>

                <button type="submit" class="btn-success align-icon-btn" :disabled="form.processing">
                    <CirclePlus class="w-4 h-4" />
                    <span>{{ form.processing ? 'Salvando...' : 'Cadastrar' }}</span>
                </button>
            </form>
        </div>
    </AppLayout>
</template>
