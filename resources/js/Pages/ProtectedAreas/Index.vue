<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import {ref} from 'vue';


const props = defineProps({
    protected_areas: { type: Object },
    regions: { type: Object }
});
const form = useForm({
    area_name: '',
    area_km2: '',
    established_date: '',
    protection_level: '',
    region_id: ''
});

const v = ref({
    id: '',
    area_name: '',
    species:[]
});

const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (a) => {
    v.value.name = a.area_name; 
    v.value.region = a.region.region_name; 
    v.value.species = a.species; 
    showModalView.value = true;
};
const openModalForm = () => {
    showModalForm.value = true;

};
const openModalDel = () => {
    showModalForm.value = true;
};

const closeModalView = () => {
    showModalView.value = false;
};

const closeModalForm = () => {
    showModalForm.value = false;
};

const closeModalDel = () => {
    showModalDel.value = false;
};


</script>

<template>
    <Head title="Areas protegidas" />
    <AuthenticatedLayout>
		<template #header>
            <div class="flex justify-between items-center">
                <!-- Texto alineado a la izquierda -->
                <span>Áreas protegidas</span>

                <!-- Botón alineado a la derecha -->
                <DarkButton>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                        <path fill="#ffffff" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm16 80c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 48-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-48z"/>
                    </svg>
                </DarkButton>
            </div>
        </template>

		
		<div class="w-full overflow-hidden rounded-lg border shadow-md">
            <div class="w-full overflow-x-auto bg-white">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50">
                            <th class="px-4 py-3">#header</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Area</th>
                            <th class="px-4 py-3">Fecha de establecimiento</th>
                            <th class="px-4 py-3">Nivel de proteccion</th>
                            <th class="px-4 py-3">Region</th>
                            <th class="px-4 py-3">Detalle</th>
                            <th class="px-4 py-3">Editar</th>
                            <th class="px-4 py-3">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y " >
                        <tr v-for="(a, i) in protected_areas" :key="a.id" class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ i + 1 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ a.area_name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ a.area_km2 }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ a.established_date }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ a.protection_level }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ a.region.region_name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <SecondaryButton @click="openModalView(a)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                        <path  d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                    </svg>
                                </SecondaryButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <WarningButton @click="openModalForm">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                        <path fill="#ffffff" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                    </svg>
                                </WarningButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="openModalDel">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                        <path fill="#ffffff" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                    </svg>
                                </DangerButton>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <Modal :show="showModalView" @close="closeModalView">
            <div class="p-6">
                <p>Área protegida: <span class="text-lg font-medium text-gray-900">{{ v.name }}</span></p>
                <p>Región: <span class="text-lg font-medium text-gray-900">{{ v.region }}</span></p>
                Especies:
                <ol>
                    <li class="text-lg font-medium text-gray-900" v-for="b, i in v.species">
                        {{ (i + 1) + '. ' + b.common_name }}
                    </li>
                </ol>
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Cancel</SecondaryButton>
            </div>
        </Modal>
        <Modal :show="showModalForm" @close="closeModalForm">
            <div class="p-6">
            
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
            </div>
        </Modal>
        <Modal :show="showModalDel" @close="closeModalDel">
            <div class="p-6">
            
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModalDel">Cancel</SecondaryButton>
            </div>
        </Modal>



	</AuthenticatedLayout>
    
</template>