<script setup>
import { ref, watch, onMounted } from 'vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

import Logo from '@/Components/Logo.vue';
import NavSiteIndex from '@/Components/NavSiteIndex.vue';
import ScreenShotContainer from './Partials/SiteIndex/ScreenShotContainer.vue';
import DocsCardContent from './Partials/SiteIndex/DocsCardContent.vue';
import IconArrow from './Partials/SiteIndex/IconArrow.vue';
import MainRulesRomanNumber from './Partials/SiteIndex/MainRulesRomanNumber.vue';
import CardConvertArabicToRoman from './Partials/SiteIndex/CardConvertArabicToRoman.vue';
import CardConvertRomanToArabic from './Partials/SiteIndex/CardConvertRomanToArabic.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    roman: {
        type: String,
    },
    arabic: {
        type: Number,
    },
    flash: {
        type: String,
    }
});

// mensagens
const flash = usePage().props.flash || null;

// handleImageError() movida para ScreenShotContainer

//receber os valores e chamar as rotas via inertia
const form = useForm({
    value: ''
});

//resposta em romano
const roman = ref(usePage().props.roman || null);

//resposta em arabico
const arabic = ref(usePage().props.arabic || null);

// Controle de visibilidade do modal responsavel por exibir a resposta da conversao
const showModal = ref(false);

// fechar modal
const closeModal = () => {
    showModal.value = false;
};

//convertToRoman() movidada para CardConvertArabicToRoman


//aciona a rota de conversao para arabico convertToArabic 

</script>

<template>

    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <!-- Logo  -->
                    <Logo />
                    <NavSiteIndex
                        :canLogin="canLogin"
                        :canRegister="canRegister"
                    />
                </header>

                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        
                        <a href="https://www.educamaisbrasil.com.br/enem/matematica/numeros-romanos" id="docs-card"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                            <ScreenShotContainer/>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <!-- Historia dos Numeros -->
                                <DocsCardContent/>
                                <!-- icone da seta -->
                                <IconArrow/>
                            </div>
                        </a>

                        <a href="https://www.youtube.com/watch?v=FusgWF4y-2E"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                            <!-- Principais Regras -->
                            <MainRulesRomanNumber/>
                            <!-- icone da seta -->
                            <IconArrow class="size-6 shrink-0 self-center"/>
                        </a>
                        <!-- Card Converter Arabico x Romano -->
                        <CardConvertArabicToRoman/>
                        <!-- Card Converter Romano x Arabico -->
                        <CardConvertRomanToArabic/>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    by Webert Maximiano - (21) 98176-0591 - Laravel {{ laravelVersion }} (PHP v{{ phpVersion }})
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal  -->
    <Teleport to="main">
        <div v-if="showModal" class="modal">
            <p>Número Convertido com Sucesso </p>
            <!-- Resposta da Conversao -->
            <span></span>
            <button @click="open = false">Close</button>
        </div>
    </Teleport>
</template>

<style scoped>
.modal {
  position: fixed;
  z-index: 999;
  top: 20%;
  left: 50%;
  width: 300px;
  margin-left: -150px;
}
</style>