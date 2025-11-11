<script setup>
/* Importa o composable `usePage` do Inertia.js,
   que permite acessar as propriedades globais enviadas pelo backend Laravel */
import { usePage } from '@inertiajs/vue3';

/* Importa o helper `computed` do Vue,
usado para criar propriedades reativas que mudam automaticamente quando seus dados mudam */
import { computed } from 'vue';

/* Obtém a página atual e suas propriedades compartilhadas (como flash messages, usuário autenticado, etc.) */
const page = usePage();

/* Cria uma propriedade reativa que acessa a mensagem de sucesso enviada pelo Laravel via flash */
const success = computed(() => page.props.flash?.success);

/* Cria uma propriedade reativa que acessa a mensagem de erro enviada pelo Laravel via flash */
const error = computed(() => page.props.flash?.error);

</script>

<template>
    <!-- Container principal das mensagens -->
    <div class="mb-4">
        <!-- Exibe o bloco de mensagem de sucesso, se existir -->
        <div v-if="success" class="p-3 my-3 text-sm text-green-800 rounded-lg bg-green-100 border border-green-200">
            <!-- Mostra o texto da mensagem de sucesso -->
            {{ success }}
        </div>

        <!-- Exibe o bloco de mensagem de erro, se existir -->
        <div v-if="error" class="p-3 my-3 text-sm text-red-800 rounded-lg bg-red-100 border border-red-200">
            <!-- Mostra o texto da mensagem de erro -->
            {{ error }}
        </div>

    </div>

</template>