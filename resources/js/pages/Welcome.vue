<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import PublicidadModal from '@/components/PublicidadModal.vue';
import { ref, onMounted, computed, onBeforeUnmount } from 'vue';

const props = defineProps({
    ciclesDestacados: {
        type: Array,
        default: () => [],
    },
});

const irAListadoCicles = () => {
    router.visit(route('cicles.index'));
};

const irACrearCicles = () => {
    router.visit(route('cicles.create'));
};
</script>

<template>
    <Head title="- Inicio" />
    
    <div style="min-height: 100vh; display: flex; flex-direction: column;">
        <Navbar />
        
        <main style="flex-grow: 1;">
            <div style="background-color: #d1d1d1; text-align: center; color: black; padding: 20px;">
                Benvinguts:
                Descobreix cicles formatius d'FP i orienta't cap al teu futur.
            </div>

            <div style="background-color: #d1d1d1; text-align: center; color: black; padding: 20px;">
                Cicles Formatius:
                <div style="margin-top: 10px;">
                    <button @click="irACrearCicles" style="background-color: white; color: black; font-weight: bold; padding: 8px 15px; border: 1px solid black; margin-right: 10px; cursor: pointer;">
                        Crear
                    </button>
                    <button @click="irAListadoCicles" style="background-color: white; color: black; font-weight: bold; padding: 8px 15px; border: 1px solid black; cursor: pointer;">
                        Ver Lista
                    </button>
                </div>
            </div>
        </main>

        <Footer />
        
        <PublicidadModal 
            title="¡Cicles Formatius!"
            :delay="3000"
        />
    </div>
</template>

<style>
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}
</style>
