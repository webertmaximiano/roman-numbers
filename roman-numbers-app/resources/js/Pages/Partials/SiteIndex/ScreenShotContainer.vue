<script setup>
// em caso de erro oculta a div do componente
function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>
<template>
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
</template>