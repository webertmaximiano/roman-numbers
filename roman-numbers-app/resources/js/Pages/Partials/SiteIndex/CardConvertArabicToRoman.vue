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
        emit('submitValue', value.value, 'convertToRoman');
        value.value = '';
    }
};
</script>

<template>
    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
            </svg>
        </div>

        <div class="pt-3 sm:pt-5">
            <h2 class="text-xl font-semibold text-black dark:text-white">Informe um Número Arábico</h2>

            <form @submit.prevent="handleSubmit" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="convertToRoman" value="Exemplo de Número Arábico: 1, 2, 3 ..." />

                    <TextInput id="convertToRoman" type="text" class="mt-1 block w-full" v-model="value" required autofocus autocomplete="convertToRoman" />

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
