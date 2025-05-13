<template>
    <div style="min-height: 100vh; display: flex; flex-direction: column;">
        <Navbar />
        
        <main style="flex-grow: 1; width: 90%; max-width: 1200px; margin: 0 auto; padding: 16px;">
            <slot />
        </main>
        
        <Footer />
    </div>
</template>

<script setup>
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
</script> 