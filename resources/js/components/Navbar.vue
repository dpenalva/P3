<template>
    <nav style="background-color: #343a40; color: white; padding: 16px; position: relative;">
        <div style="width: 90%; max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            <Link :href="route('home')" style="font-size: 20px; font-weight: bold; color: white; text-decoration: none; z-index: 15;">TriaEducativa</Link>
            
            <button 
                @click="toggleMenu" 
                style="display: none; background: none; border: none; color: white; font-size: 24px; cursor: pointer; z-index: 15;"
                :style="{ display: isMobile ? 'block' : 'none' }"
                aria-label="Abrir menú de navegación"
            >
                ☰
            </button>

            <div 
                style="display: flex; gap: 16px; align-items: center;"
                :style="{ 
                    display: (isMobile && !menuOpen) ? 'none' : 'flex',
                    position: isMobile ? 'absolute' : 'static',
                    flexDirection: isMobile ? 'column' : 'row',
                    top: isMobile ? '100%' : 'auto',
                    left: isMobile ? '0' : 'auto',
                    right: isMobile ? '0' : 'auto',
                    backgroundColor: isMobile ? '#343a40' : 'transparent',
                    padding: isMobile ? '16px' : '0',
                    zIndex: isMobile ? '10' : 'auto',
                    boxShadow: isMobile ? '0 4px 8px rgba(0,0,0,0.2)' : 'none',
                    width: isMobile ? '100%' : 'auto'
                }"
            >
                <Link 
                    :href="route('cicles.index')" 
                    style="color: white; text-decoration: none; padding: 10px; transition: opacity 0.3s;"
                    :style="{ width: isMobile ? '100%' : 'auto', textAlign: isMobile ? 'center' : 'left' }"
                >
                    Llista de Cicles
                </Link>
                <Link 
                    :href="route('cicles.create')" 
                    style="color: white; text-decoration: none; padding: 10px; transition: opacity 0.3s;"
                    :style="{ width: isMobile ? '100%' : 'auto', textAlign: isMobile ? 'center' : 'left' }"
                >
                    Crear Cicle
                </Link>
                
                <template v-if="$page.props.auth.user">
                    <div 
                        style="position: relative;" 
                        @click.stop="showUserMenu = !showUserMenu"
                        :style="{ width: isMobile ? '100%' : 'auto', textAlign: isMobile ? 'center' : 'left' }"
                    >
                        <button style="background: none; border: none; color: white; padding: 10px; cursor: pointer; display: flex; align-items: center; gap: 5px; margin: 0 auto;">
                            {{ $page.props.auth.user.name }}
                            <span style="font-size: 12px;">▼</span>
                        </button>
                        
                        <div 
                            v-if="showUserMenu" 
                            style="position: absolute; background-color: white; border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); min-width: 150px; z-index: 100;"
                            :style="{
                                top: '100%',
                                right: isMobile ? '50%' : '0',
                                transform: isMobile ? 'translateX(50%)' : 'none'
                            }"
                        >
                            <Link href="/settings" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; border-bottom: 1px solid #eee;">
                                Perfil
                            </Link>
                            <button @click="logout" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 15px; color: #333; cursor: pointer;">
                                Cerrar Sesión
                            </button>
                        </div>
                    </div>
                </template>
                
                <template v-else>
                    <div :style="{ display: 'flex', flexDirection: isMobile ? 'column' : 'row', gap: '10px', width: isMobile ? '100%' : 'auto' }">
                        <Link 
                            v-if="route().has('login')" 
                            :href="route('login')" 
                            style="color: white; text-decoration: none; padding: 10px; transition: opacity 0.3s; border: 1px solid white; border-radius: 4px; text-align: center;"
                        >
                            Iniciar Sesión
                        </Link>
                        <Link 
                            v-if="route().has('register')" 
                            :href="route('register')" 
                            style="color: white; text-decoration: none; padding: 10px; transition: opacity 0.3s; background-color: #008933; border-radius: 4px; text-align: center;"
                        >
                            Registrarse
                        </Link>
                    </div>
                </template>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';

const showUserMenu = ref(false);
const menuOpen = ref(false);
const windowWidth = ref(window.innerWidth);

const isMobile = computed(() => {
    return windowWidth.value <= 768;
});

function toggleMenu() {
    menuOpen.value = !menuOpen.value;
}

function handleResize() {
    windowWidth.value = window.innerWidth;
    if (windowWidth.value > 768) {
        menuOpen.value = true; 
    } else {
        menuOpen.value = false; 
    }
}


function handleClickOutside(event) {
    if (showUserMenu.value && !event.target.closest('button') && !event.target.closest('div[style*="position: relative"]')) {
        showUserMenu.value = false;
    }
    
    if (isMobile.value && menuOpen.value && !event.target.closest('nav') && !event.target.closest('button[aria-label="Abrir menú de navegación"]')) {
        menuOpen.value = false;
    }
}

function logout() {
    router.post(route('logout'));
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
    window.addEventListener('resize', handleResize);
    handleResize(); 
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
    window.removeEventListener('resize', handleResize);
});
</script> 