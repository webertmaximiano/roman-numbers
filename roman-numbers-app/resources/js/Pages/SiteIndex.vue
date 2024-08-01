<script setup>
import { ref, watch, onMounted } from 'vue'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Logo from '@/Components/Logo.vue';
import NavSiteIndex from '@/Components/NavSiteIndex.vue';

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

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

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

//aciona a rota de conversao para romano
const convertToRoman = () => {
    form.post(route('site.convertToRoman'), {
        preserveState: true,
        onSuccess: () => {
            showModal.value = true; // Mostra o modal em caso de sucesso
        },
        onFinish: () => form.reset('value'),
    });
};

//aciona a rota de conversao para arabico
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
                            <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                <img src="https://images.educamaisbrasil.com.br/content/banco_de_imagens/guia-de-estudo/D/relogio-numeros-romanos-matematica.jpg"
                                    alt="Relogio Romano"
                                    class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                                    @error="handleImageError" />
                                <img src="https://images.educamaisbrasil.com.br/content/banco_de_imagens/guia-de-estudo/D/relogio-numeros-romanos-matematica.jpg"
                                    alt="Relogio Romano"
                                    class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block" />
                                <div
                                    class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
                                </div>
                            </div>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                        <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <path fill="#FF2D20"
                                                d="M23 4a1 1 0 0 0-1.447-.894L12.224 7.77a.5.5 0 0 1-.448 0L2.447 3.106A1 1 0 0 0 1 4v13.382a1.99 1.99 0 0 0 1.105 1.79l9.448 4.728c.14.065.293.1.447.1.154-.005.306-.04.447-.105l9.453-4.724a1.99 1.99 0 0 0 1.1-1.789V4ZM3 6.023a.25.25 0 0 1 .362-.223l7.5 3.75a.251.251 0 0 1 .138.223v11.2a.25.25 0 0 1-.362.224l-7.5-3.75a.25.25 0 0 1-.138-.22V6.023Zm18 11.2a.25.25 0 0 1-.138.224l-7.5 3.75a.249.249 0 0 1-.329-.099.249.249 0 0 1-.033-.12V9.772a.251.251 0 0 1 .138-.224l7.5-3.75a.25.25 0 0 1 .362.224v11.2Z" />
                                            <path fill="#FF2D20"
                                                d="m3.55 1.893 8 4.048a1.008 1.008 0 0 0 .9 0l8-4.048a1 1 0 0 0-.9-1.785l-7.322 3.706a.506.506 0 0 1-.452 0L4.454.108a1 1 0 0 0-.9 1.785H3.55Z" />
                                        </svg>
                                    </div>

                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Números Romanos
                                        </h2>
                                        <h2 class="text-xl font-semibold text-black dark:text-white"> Sistema numérico
                                            que surgiu na
                                            Roma Antiga</h2>



                                        <p class="mt-4 text-sm/relaxed">
                                            Os números romanos formam um sistema numérico, criado há cerca de 2 mil
                                            anos, na Roma
                                            antiga.
                                            Por muito tempo esse sistema foi a principal forma de representação numérica
                                            na Europa e
                                            atualmente é utilizado para indicar séculos, capítulos de livros e nomes de
                                            imperadores,
                                            reis, papas, etc.
                                        </p>

                                        <p class="mt-4 text-sm/relaxed">
                                            Exemplo:
                                        </p>

                                        <p class="mt-4 text-sm/relaxed"> • D. Pedro II (Dom Pedro Segundo)</p>

                                        <p class="mt-4 text-sm/relaxed">• Luís XV (Luís Quinze)</p>
                                        <p class="mt-4 text-sm/relaxed">• Século XVI (Século 16)</p>
                                        <p class="mt-4 text-sm/relaxed">Também conhecidos por numeração romana ou
                                            algarismos romanos,
                                            esse sistema utiliza sete letras para indicar números: </p>
                                        <p class="mt-4 text-sm/relaxed">1 = I; 5 = V; 10 = X; 50 = L; 100 = C; 500 = D;
                                            1.000 = M.</p>

                                    </div>
                                </div>

                                <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                </svg>
                            </div>
                        </a>

                        <a href="https://www.youtube.com/watch?v=FusgWF4y-2E"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <g fill="#FF2D20">
                                        <path
                                            d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z" />
                                    </g>
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Principais regras</h2>

                                <p class="mt-4 text-sm/relaxed">
                                    1- As letras I, X, C, M só podem ser repetidos três vezes consecutivas. Exemplo: III
                                    = 3 e XXX = 30;
                                </p>
                                <p class="mt-4 text-sm/relaxed">
                                    2- No princípio subtrativo, quando duas letras são diferentes e a de menor valor
                                    antecede a de maior
                                    valor, subtraem-se os seus valores. Exemplo: IV (5 – 1) = 4 e XLV (55 - 10) = 45;
                                </p>
                                <p class="mt-4 text-sm/relaxed">
                                    3- No princípio aditivo, quando duas letras são diferentes e a de maior valor
                                    antecede a de menor
                                    valor, somam-se os seus valores. Exemplo: VI (5 + 1) = 6 e LIII (50 + 3) = 53;
                                </p>
                                <p class="mt-4 text-sm/relaxed">
                                    4- Colocando-se um traço sobre uma ou mais letras, seu valor é multiplicado por
                                    1.000;
                                </p>
                            </div>

                            <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>

                        <div
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
                                </svg>

                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Informe um Número Arábico
                                </h2>

                                <form @submit.prevent="convertToRoman" class="mt-6 space-y-6">
                                    <div>
                                        <InputLabel for="convertToRoman"
                                            value="Exemplo de Número Arábico: 1, 2, 3 ..." />

                                        <TextInput id="name" type="text" class="mt-1 block w-full"
                                            v-model="form.value" required autofocus autocomplete="name" />

                                        <InputError class="mt-2" :message="form.errors.roman" />
                                    </div>
                                    <PrimaryButton class=" ml-4 shrink-0 self-center stroke-[#FF2D20]" :disabled="form.processing">
                                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                        </svg>
                                        Converter
                                    </PrimaryButton>    
                                </form>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Informe um Número Romano
                                </h2>

                                <form @submit.prevent="convertToArabic" class="mt-6 space-y-6">
                                    <div>
                                        <InputLabel for="convertToArabic"
                                            value="Exemplo de Número Arábico: 1, 2, 3 ..." />

                                        <TextInput id="name" type="text" class="mt-1 block w-full"
                                            v-model="form.value" required autofocus autocomplete="name" />

                                        <InputError class="mt-2" :message="form.errors.roman" />
                                    </div>
                                    <PrimaryButton class=" ml-4 shrink-0 self-center stroke-[#FF2D20]" :disabled="form.processing">
                                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                        </svg>
                                        Converter
                                    </PrimaryButton>    
                                </form>
                            </div>
                        </div>
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