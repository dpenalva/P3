<template>
    <Head title="Detalles del Cicle" />
    
    <CiclesLayout>
        <h1 style="text-align: center; color: purple; font-size: 24px; margin-bottom: 20px;">Detalles del Cicle Formatiu</h1>
        
        <div style="width: 80%; margin: 0 auto; background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd;">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">ID:</h3>
                    <p style="font-size: 18px;">{{ cicle.id }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Nom del Cicle:</h3>
                    <p style="font-size: 18px;">{{ cicle["Nom del Cicle"] }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Nivell:</h3>
                    <p style="font-size: 18px;">{{ cicle.Nivell }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Família:</h3>
                    <p style="font-size: 18px;">{{ cicle.Família }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Valoració:</h3>
                    <p style="font-size: 18px;">
                        {{ cicle.Valoració }}/5
                    </p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Email:</h3>
                    <p style="font-size: 18px;">{{ cicle.Email }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Hora:</h3>
                    <p style="font-size: 18px;">{{ cicle.hora }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Data:</h3>
                    <p style="font-size: 18px;">{{ cicle.date }}</p>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Fecha de creación:</h3>
                    <p style="font-size: 18px;">{{ new Date(cicle.created_at).toLocaleString() }}</p>
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Descripció:</h3>
                <p style="font-size: 18px;">{{ cicle.Descripció }}</p>
            </div>
            
            <div v-if="cicle.Opinió" style="margin-top: 20px;">
                <h3 style="font-size: 14px; font-weight: bold; color: #666; margin-bottom: 5px;">Opinió:</h3>
                <p style="font-size: 18px;">{{ cicle.Opinió }}</p>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <Link :href="route('cicles.index')" style="background-color: #767676; color: white; padding: 10px 15px; text-decoration: none; display: inline-block; margin-right: 10px;">
                    Volver
                </Link>
                <Link :href="route('cicles.edit', cicle.id)" style="background-color: #c85200; color: white; padding: 10px 15px; text-decoration: none; display: inline-block;">
                    Editar
                </Link>
            </div>
        </div>
    </CiclesLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import CiclesLayout from '@/layouts/cicleslayout.vue';

const props = defineProps({
    cicle: Object
});
</script> 