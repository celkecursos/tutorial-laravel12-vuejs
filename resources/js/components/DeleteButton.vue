<script setup lang="ts">
/* Importa o composable `usePage` do Inertia.js,
   que permite acessar as propriedades globais enviadas pelo backend Laravel */
import { router } from '@inertiajs/vue3';

/* Importar os ícones */
import { Trash2 } from 'lucide-vue-next';

/* Define a interface do usuário, útil para tipagem TypeScript */
interface Props {
    // URL da rota que será chamada para apagar o registro
    url: string
    // Título opcional que será exibido na confirmação do SweetAlert
    title?: string
    // Texto opcional que será exibido no botão
    buttonText?: string
}

// Recebe as props passadas para o componente e aplica a tipagem definida
const props = defineProps<Props>()

// Função de confirmação e exclusão
const confirmDelete = () => {
    const confirmMessage = props.title ?? "Tem certeza?";
    const result = confirm(`${confirmMessage}\nEssa ação não poderá ser desfeita!`);

    if (result) {
        router.delete(props.url);
    }
};
</script>

<template>

    <!-- Botão Apagar -->
    <button @click="confirmDelete" class="btn-danger align-icon-btn">
        <Trash2 class="w-4 h-4" />
        <span>{{ buttonText ?? 'Apagar' }}</span>
    </button>

</template>

<style>
@reference "../../css/app.css";
</style>