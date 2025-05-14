<template>
    <footer class="bg-gray-800 text-white py-6 mt-auto" role="contentinfo">
        <div class="w-11/12 max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-center md:text-left text-gray-300">
                        &copy; {{ new Date().getFullYear() }} Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <CookieConsent />
</template>

<script setup>
</script> 