<script setup>
//import { ref, watch, onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    value: ''
});

const convertToArabic = () => {
    form.post(route('site.convertToArabic'), {
        preserveState: true,
        onSuccess: () => {
            showModal.value = true; // Mostra o modal em caso de sucesso
        },
        onFinish: () => form.reset('value'),
    });
};
</script>
<template>
    <div
        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>

        </div>

        <div class="pt-3 sm:pt-5">
            <h2 class="text-xl font-semibold text-black dark:text-white">Informe um Número Romano
            </h2>

            <form @submit.prevent="convertToArabic" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="convertToArabic" value="Exemplo de Número Arábico: 1, 2, 3 ..." />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.value" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.roman" />
                </div>
                <PrimaryButton class=" ml-4 shrink-0 self-center stroke-[#FF2D20]" :disabled="form.processing">
                    <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                    Converter
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>