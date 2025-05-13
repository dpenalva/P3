<template>
    <div v-if="visible" class="cookie-simple">
        Este sitio usa cookies
        <button @click="acceptCookies">Aceptar</button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const visible = ref(true);

onMounted(() => {
    const cookieConsent = localStorage.getItem('cookie_consent');
    if (cookieConsent === 'accepted') {
        visible.value = false;
    }
});

function acceptCookies() {
    localStorage.setItem('cookie_consent', 'accepted');
    visible.value = false;
}
</script>

<style scoped>
.cookie-simple {
    position: fixed;
    bottom: 10px;
    right: 10px;
    background: #eee;
    padding: 5px;
    font-size: 14px;
    border: 1px solid #ccc;
}

button {
    margin-left: 5px;
}
</style> 