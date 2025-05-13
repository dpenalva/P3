<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({ title: String, delay: { type: Number, default: 3000 } });

const isOpen = ref(false);

onMounted(() => setTimeout(() => isOpen.value = true, props.delay));
</script>

<template>
    <div v-if="isOpen" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.3);display:flex;justify-content:center;align-items:center;z-index:1000">
        <div style="background:white;padding:8px;width:200px;text-align:center">
            <div>{{ title || 'Publicidad' }}</div>
            <button @click="isOpen = false" style="margin-top:5px;background:#666;color:white;border:none;padding:3px 8px">Cerrar</button>
        </div>
    </div>
</template> 