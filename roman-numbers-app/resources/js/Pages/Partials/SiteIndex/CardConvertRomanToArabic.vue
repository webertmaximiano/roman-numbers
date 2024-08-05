<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

// Definindo o evento
const emit = defineEmits(['submitValue']);
const value = ref('');

const handleSubmit = () => {
    if (value.value) {
        emit('submitValue', value.value, 'convertToArabic');
        value.value = '';
    }
};
</script>

<template>
    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="pt-3 sm:pt-5">
            <h2 class="text-xl font-semibold text-black dark:text-white">Informe um Número Romano</h2>

            <form @submit.prevent="handleSubmit" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="convertToArabic" value="Exemplo de Número Romano: I, V, X ..." />

                    <TextInput id="convertToArabic" type="text" class="mt-1 block w-full" v-model="value" required autofocus autocomplete="convertToArabic" />

                </div>
                <PrimaryButton class="ml-4 shrink-0 self-center stroke-[#FF2D20]" >
                    <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                    Converter
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>
