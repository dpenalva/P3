<template>
    <Head title="Editar Cicle" />
    
    <CiclesLayout>
        <h1 style="text-align: center; color: orange; font-size: 24px; margin-bottom: 20px;">Editar Cicle Formatiu</h1>
        
        <form @submit.prevent="submit" style="width: 80%; margin: 0 auto; background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd;">
            <!-- Nom del Cicle -->
            <div style="margin-bottom: 15px;">
                <label for="NomCicle" style="display: block; margin-bottom: 5px; font-weight: bold;">Nom del Cicle:</label>
                <input id="NomCicle" v-model="form['Nom del Cicle']" type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc;" required />
                <div v-if="form.errors['Nom del Cicle']" style="color: red; margin-top: 5px;">{{ form.errors['Nom del Cicle'] }}</div>
            </div>
            
            <!-- Nivell -->
            <div style="margin-bottom: 15px;">
                <label for="Nivell" style="display: block; margin-bottom: 5px; font-weight: bold;">Nivell:</label>
                <input id="Nivell" v-model="form.Nivell" type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc;" />
                <div v-if="form.errors.Nivell" style="color: red; margin-top: 5px;">{{ form.errors.Nivell }}</div>
            </div>
            
            <!-- Familia -->
            <div style="margin-bottom: 15px;">
                <label for="Familia" style="display: block; margin-bottom: 5px; font-weight: bold;">Família:</label>
                <select id="Familia" v-model="form.familia_id" style="width: 100%; padding: 8px; border: 1px solid #ccc;" required>
                    <option value="" disabled>Selecciona una família</option>
                    <option v-for="familia in familias" :key="familia.id" :value="familia.id">
                        {{ familia.nombre }}
                    </option>
                </select>
                <div v-if="form.errors.Família" style="color: red; margin-top: 5px;">{{ form.errors.Família }}</div>
                <div v-if="form.errors.familia_id" style="color: red; margin-top: 5px;">{{ form.errors.familia_id }}</div>
            </div>
            
            <!-- Descripció -->
            <div style="margin-bottom: 15px;">
                <label for="Descripcio" style="display: block; margin-bottom: 5px; font-weight: bold;">Descripció:</label>
                <textarea id="Descripcio" v-model="form.Descripció" style="width: 100%; padding: 8px; border: 1px solid #ccc; min-height: 100px;" required></textarea>
                <div v-if="form.errors.Descripció" style="color: red; margin-top: 5px;">{{ form.errors.Descripció }}</div>
            </div>
            
            <!-- Valoració -->
            <div style="margin-bottom: 15px;">
                <label for="Valoracio" style="display: block; margin-bottom: 5px; font-weight: bold;">Valoració (1-5):</label>
                <input id="Valoracio" v-model="form.Valoració" type="number" min="1" max="5" style="width: 100%; padding: 8px; border: 1px solid #ccc;" />
                <div v-if="form.errors.Valoració" style="color: red; margin-top: 5px;">{{ form.errors.Valoració }}</div>
            </div>
            
            <!-- Opinió -->
            <div style="margin-bottom: 15px;">
                <label for="Opinio" style="display: block; margin-bottom: 5px; font-weight: bold;">Opinió:</label>
                <textarea id="Opinio" v-model="form.Opinió" style="width: 100%; padding: 8px; border: 1px solid #ccc; min-height: 100px;"></textarea>
                <div v-if="form.errors.Opinió" style="color: red; margin-top: 5px;">{{ form.errors.Opinió }}</div>
            </div>
            
            <!-- Email -->
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                <input id="email" v-model="form.Email" type="email" style="width: 100%; padding: 8px; border: 1px solid #ccc;" required />
                <div v-if="form.errors.Email" style="color: red; margin-top: 5px;">{{ form.errors.Email }}</div>
            </div>

            <!-- Fecha -->
            <div style="margin-bottom: 15px;">
                <label for="date" style="display: block; margin-bottom: 5px; font-weight: bold;">Fecha:</label>
                <input id="date" v-model="form.date" type="date" style="width: 100%; padding: 8px; border: 1px solid #ccc;" required />
                <div v-if="form.errors.date" style="color: red; margin-top: 5px;">{{ form.errors.date }}</div>
            </div>

            <!-- Hora -->
            <div style="margin-bottom: 15px;">
                <label for="hora" style="display: block; margin-bottom: 5px; font-weight: bold;">Hora:</label>
                <input id="hora" v-model="form.hora" type="time" style="width: 100%; padding: 8px; border: 1px solid #ccc;" required />
                <div v-if="form.errors.hora" style="color: red; margin-top: 5px;">{{ form.errors.hora }}</div>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <Link :href="route('cicles.index')" style="background-color: #767676; color: white; padding: 10px 15px; text-decoration: none; display: inline-block; margin-right: 10px;">
                    Cancelar
                </Link>
                <button type="submit" style="background-color: #c85200; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                    Actualizar
                </button>
            </div>
        </form>
    </CiclesLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import CiclesLayout from '@/layouts/cicleslayout.vue';

const props = defineProps({
    cicle: Object,
    familias: Array
});

const form = useForm({
    'Nom del Cicle': props.cicle['Nom del Cicle'],
    'Nivell': props.cicle.Nivell,
    'Família': props.cicle.Família,
    'Descripció': props.cicle.Descripció,
    'Valoració': props.cicle.Valoració,
    'Opinió': props.cicle.Opinió,
    'Email': props.cicle.Email,
    'date': props.cicle.date,
    'hora': props.cicle.hora,
    'familia_id': props.cicle.familia_id,
});

const submit = () => {
    form.put(route('cicles.update', props.cicle.id));
};
</script> 