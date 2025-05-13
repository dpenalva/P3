<template>
    <Head title="Listado de Cicles Formatius" />
    
    <CiclesLayout>
        <h1 style="text-align: center; color: #2b72e6; margin-bottom: 15px; font-size: 32px;">Listado de Cicles Formatius</h1>
        
        <div v-if="$page.props.flash && $page.props.flash.success" style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 15px;">
            {{ $page.props.flash.success }}
        </div>
        <div style="width: 100%; margin-bottom: 18px; padding: 10px;">
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <label for="busqueda-input" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Buscar cicles</label>
                <input 
                    id="busqueda-input"
                    type="text" 
                    v-model="busqueda" 
                    placeholder="Buscar cicles..." 
                    style="flex-grow: 1; padding: 10px; border: 1px solid #767676;"
                    @input="buscarConAxios"
                    aria-label="Buscar cicles por nombre, nivel, descripción o email"
                />
            </div>
        </div>
        
        <div style="width: 100%; margin-bottom: 12px; padding: 10px;">
            <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                <label for="familia-select" style="min-width: 120px;">Filtrar por família:</label>
                <select 
                    id="familia-select"
                    v-model="familiaSeleccionada" 
                    style="flex-grow: 1; padding: 8px; border: 1px solid #767676;" 
                    @change="buscarConAxios"
                    aria-label="Filtrar cicles por família"
                >
                    <option value="">Todas las famílias</option>
                    <option v-for="familia in familias" :key="familia.id" :value="familia.id">
                        {{ familia.nombre }}
                    </option>
                </select>
            </div>
        </div>
        
        <div style="overflow-x: auto; margin-bottom: 20px; border: 1px solid #ddd;">
            <table style="width: 100%; border-collapse: collapse;" aria-label="Listado de cicles formatius">
                <caption style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Listado de cicles formatius disponibles</caption>
                <thead style="background-color: white;">
                    <tr>
                        <th scope="col" style="border: 1px solid #ddd; padding: 5px; text-align: center; color: black;">ID</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Nom del Cicle</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Descripció</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Família</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Nivell</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Valoració</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Opinió</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Email</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Hora</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Data</th>
                        <th scope="col" style="border: 1px solid #ddd; padding: 8px; text-align: center; color: black;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(cicle, index) in ciclesFiltrados" :key="cicle.id" style="border: 1px solid #ddd;" :style="index % 2 === 0 ? 'background-color: #f2f2f2;' : 'background-color: white;'">
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ cicle.id }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ cicle["Nom del Cicle"] }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ cicle.Descripció }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ cicle.Família }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ cicle.Nivell }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ cicle.Valoració }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ cicle.Opinió }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ cicle.Email }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ cicle.hora }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ cicle.date }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                            <Link 
                                :href="route('cicles.show', cicle.id)" 
                                style="background-color: #2b72e6; color: white; padding: 5px; text-decoration: none; margin-right: 3px; display: inline-block;"
                                aria-label="Ver detalles del cicle"
                            >
                                Ver
                            </Link>
                            <Link 
                                :href="route('cicles.edit', cicle.id)" 
                                style="background-color: #c85200; color: white; padding: 5px; text-decoration: none; margin-right: 3px; display: inline-block;"
                                aria-label="Editar cicle"
                            >
                                Editar
                            </Link>
                            <button 
                                @click="eliminarCicle(cicle.id)" 
                                style="background-color: #e00; color: white; padding: 5px; border: none; cursor: pointer;"
                                aria-label="Eliminar cicle"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <tr v-if="ciclesFiltrados.length === 0">
                        <td colspan="11" style="border: 1px solid #ddd; padding: 15px; text-align: center; color: #666;">No se encontraron cicles</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <nav v-if="cicles.links && cicles.links.length > 3" style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px;" aria-label="Paginación de cicles">
            <div style="display: flex; justify-content: center; margin: 10px 0;">
                <Link 
                    v-for="(link, i) in cicles.links" 
                    :key="i"
                    :href="link.url ? link.url : '#'"
                    :style="{
                        padding: '8px 12px',
                        margin: '0 2px',
                        border: '1px solid #ccc',
                        backgroundColor: link.active ? '#2b72e6' : 'white',
                        color: link.active ? 'white' : '#2b72e6',
                        textDecoration: 'none',
                        cursor: link.url ? 'pointer' : 'not-allowed',
                        opacity: link.url ? '1' : '0.5'
                    }"
                    :aria-current="link.active ? 'page' : undefined"
                    :aria-disabled="!link.url"
                    :tabindex="link.url ? 0 : -1"
                    v-html="link.label"
                ></Link>
            </div>
            <div style="font-size: 14px; color: #666; margin-top: 8px;" aria-live="polite">
                Mostrando {{ cicles.from }} a {{ cicles.to }} de {{ cicles.total }} cicles
            </div>
        </nav>
        
        <div style="text-align: center; margin-top: 20px;">
            <Link 
                :href="route('cicles.create')" 
                style="background-color: #008933; color: white; padding: 10px 15px; text-decoration: none; display: inline-block;"
                aria-label="Añadir Nuevo Cicle"
            >
            Añadir Nuevo Cicle
            </Link>
        </div>
    </CiclesLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import CiclesLayout from '@/layouts/cicleslayout.vue';
import { router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    cicles: Object,
    familias: Array,
    filters: Object
});

const busqueda = ref('');
const familiaSeleccionada = ref('');
const ciclesFiltrados = ref([]);
const cargando = ref(false);
let timeoutId = null;

onMounted(() => {
    if (props.filters) {
        busqueda.value = props.filters.search || '';
        familiaSeleccionada.value = props.filters.familia || '';
    }
    ciclesFiltrados.value = props.cicles.data || [];
});

// Buscar con Axios
function buscarConAxios() {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
    
    timeoutId = setTimeout(() => {
        axios.get(route('cicles.buscar'), {
            params: {
                q: busqueda.value,
                familia: familiaSeleccionada.value
            }
        })
        .then(response => {
            ciclesFiltrados.value = response.data;
        })
        .catch(error => {
            ciclesFiltrados.value = [];
        });
    }, 300);
}

// Eliminar Cicle 
function eliminarCicle(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este cicle?')) {
        axios.post(`/cicles/${id}`, {
            _method: 'DELETE'
        })
            .then(() => ciclesFiltrados.value = ciclesFiltrados.value.filter(cicle => cicle.id !== id))
            .catch(() => alert('Error al eliminar'));
    }
}
</script>