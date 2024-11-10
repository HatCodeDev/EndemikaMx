<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Pagination from '@/Components/Pagination.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import {ref} from 'vue';


const props = defineProps({
    species: { type: Object },
    flash: { type: Object }
});
const form = useForm({ 
    id: '',
    scientific_name: '',
    common_name: '',
    description: '',
    conservation_status: '',
    average_lifespan: null,
    diet_type: 'otro',
    population_estimate: null,
    threats: '',
    image: ''
});

const showModalDel = ref(false);
const msj = ref((props.flash.success != null) ? props.flash.success : '');
const classMsj = ref((props.flash.success != null) ? '' : 'hidden');

const openModalDel = (species) => {
    form.id = species.id;
    form.scientific_name = species.scientific_name;
    form.common_name = species.common_name;
    showModalDel.value = true;
};

const closeModalDel = () => {
    showModalDel.value = false;
};

const deleteSpecie = () => {
    // Verifica el ID que estás intentando eliminar
    console.log("ID de la especie a eliminar:", form.id);
    // Construye y muestra la URL en la consola
    const url = route('specie.destroy', form.id);
    console.log("URL de eliminación:", url);
    
    form.delete(route('specie.destroy', form.id), {
    onSuccess: () => { ok('Especie endémica eliminada') }
});

const ok = (m) => {
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
    setTimeout(()=>{
        classMsj.value = 'hidden';
    },8000)
}

}

</script>

<template>
    <Head title="Especies Endémicas" />
    <AuthenticatedLayout>
		<template #header>
            <div class="flex justify-between items-center">
                <!-- Texto alineado a la izquierda -->
                <span>Especies Endémicas</span>
            </div>
        </template>

		<div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md" :class="classMsj">
		    <div class="flex justify-center items-center w-12 bg-lightgray">
		    	
                <svg class="w-6 h-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20">
                    <path fill="currentColor" d="M10 20a10 10 0 0 1 0-20a10 10 0 1 1 0 20m-2-5l9-8.5L15.5 5L8 12L4.5 8.5L3 10z"/>
                </svg>
		    </div>
        
		    <div class="px-4 py-2 -mx-3">
		    	<div class="mx-3">
		    		<span class="font-semibold text-lightgray">Success</span>
		    		<p class="text-sm text-gray-600">{{msj}}</p>
		    	</div>
		    </div>
		</div>

		<div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50">
                            <th class="px-4 py-3">#header</th>
                            <!-- <th class="px-4 py-3">Nombre Cientifico</th> -->
                            <th class="px-4 py-3">Nombre común</th>
                            <!-- <th class="px-4 py-3">Descripcion</th> -->
                            <th class="px-4 py-3">Estado de conservación</th>
                            <th class="px-4 py-3">Esperanza de vida</th>
                            <th class="px-4 py-3">Dieta</th>
                            <th class="px-4 py-3">Poblacion</th>
                            <th class="px-4 py-3">Amenzas</th>
                            <th class="px-4 py-3">imagen</th>
                            <th class="px-4 py-3">Detalle</th>
                            <th class="px-4 py-3">Editar</th>
                            <th class="px-4 py-3">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y " >
                        <tr v-for="(species, i) in species.data" :key="species.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ i + 1 }}
                            </td>
                            <!-- <td class="px-4 py-3 text-sm">
                                {{ species.scientific_name }}
                            </td> -->
                            <td class="px-4 py-3 text-sm">
                                {{ species.common_name }}
                            </td>
                            <!-- <td class="px-4 py-3 text-sm">
                                {{ species.description }}
                            </td> -->
                            <!-- <td class="px-4 py-3 text-sm">
                                {{ species.page }}
                            </td> -->
                            <td class="px-4 py-3 text-sm">
                                {{ species.conservation_status }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ species.average_lifespan }} años
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ species.diet_type }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ species.population_estimate }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ species.threats }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <img :src="'storage' + species.image" :alt=" species.common_name " class="w-20 h-20 object-cover rounded-lg">
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <NavLink :href="route('specie.show', species.id)">
                                    <SecondaryButton>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                        <path  d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                    </svg>
                                    </SecondaryButton>
                                </NavLink>

                            </td>
                            <td class="px-4 py-3 text-sm">
                                <NavLink :href="route('specie.edit', species.id)">
                                    <WarningButton >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                            <path fill="#ffffff" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                        </svg>
                                    </WarningButton>
                                </NavLink>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="openModalDel(species)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                        <path fill="#ffffff" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
				<pagination :links="species.links" />
			</div>
        </div>
        
        <Modal :show="showModalDel" @close="closeModalDel">
            <div class="p-6">
                <p class="text-2xl text-gray-500">
                    ¿Estás seguro de eliminar la especie endémica 
                    <span class="text-2xl font-medium text-gray-500">{{ form.common_name }}</span>?
                </p>
            </div>
            <div class="m-6 flex justify-end space-x-4">
                <PrimaryButton @click="deleteSpecie">Sí, eliminar</PrimaryButton>
                <SecondaryButton @click="closeModalDel">Cancelar</SecondaryButton>
            </div>
        </Modal>



	</AuthenticatedLayout>
    
</template>
