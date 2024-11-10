<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import SelectInput from '@/Components/SelectInput.vue';
import {ref} from 'vue';


const props = defineProps({
    protected_areas: { type: Object },
    regions: { type: Object }
});

const protectionLevelOptions = [
  { id: 'Alto', region_name: 'Alto' },
  { id: 'Medio', region_name: 'Medio' },
  { id: 'Bajo', region_name: 'Bajo' }
];


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
    area_km2: '',
    established_date: '',
    protection_level: '',
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
    v.value.area_km2 = a.area_km2; 
    v.value.established_date = a.established_date; 
    v.value.region = a.region.region_name; 
    v.value.protection_level = a.protection_level; 
    v.value.species = a.species; 
    showModalView.value = true;
};
const openModalForm = (op, a) => {
    showModalForm.value = true;
    operation.value = op;
    
    if (op === 1) {
        title.value = 'Create Area';
        
    } else {
        title.value = 'Edit Area';
        form.area_name = a.area_name;
        form.area_km2 = a.area_km2;
        form.established_date = a.established_date;
        form.protection_level = a.protection_level;
        form.region_id = a.region_id;
        v.value.id = a.id;  
    }
};
const openModalDel = (a) => {
    showModalDel.value = true;
    v.value.id = a.id; 
    v.value.name = a.area_name; 
};

const closeModalView = () => {
    showModalView.value = false;
};

const closeModalForm = () => {
    showModalForm.value = false;
    form.reset();
};

const closeModalDel = () => {
    showModalDel.value = false;
};

const save = () => {
    if (operation.value == 1) {
        form.post(route('protectedAreas.store'), {
            onSuccess: () => { ok('Area protegida creada') }
        });
    } else {
        // Agrega este console.log para verificar el ID
        // console.log("ID para actualizar:", v.value.id);
        
        // Verifica la URL generada para el PUT o PATCH
        // console.log("URL generada:", route('protectedAreas.update', v.value.id));

        // Verifica los datos que se envían en el formulario
        // console.log("Datos para actualizar:", form.data());

        form.put(route('protectedAreas.update', v.value.id), {
            onSuccess: () => { ok('Área protegida actualizada'); }
        });
    }
};

const ok = (m) => {
    if (operation.value == 2) {
        closeModalForm();
    }
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
    setTimeout(()=>{
        classMsj.value = 'hidden';
    },8000)
}

const deleteAreaProtegida = () => {
    // Agrega este console.log para verificar el ID
    // console.log("ID para eliminar:", v.value.id);
    // Verifica la URL generada para el PUT o PATCH
    // console.log("URL generada:", route('protectedAreas.destroy', v.value.id));

    form.delete(route('protectedAreas.destroy', v.value.id), {
        onSuccess: () => { ok('Area eliminada') }
    });
}


</script>

<template>
    <Head title="Areas protegidas" />
    <AuthenticatedLayout>
		<template #header>
            <div class="flex justify-between items-center">
                <!-- Texto alineado a la izquierda -->
                <span>Áreas protegidas</span>

                <!-- Botón alineado a la derecha -->
                <PrimaryButton @click="openModalForm(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                        <path fill="#ffffff" d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 38.6C310.1 219.5 256 287.4 256 368c0 59.1 29.1 111.3 73.7 143.3c-3.2 .5-6.4 .7-9.7 .7L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zm48 96a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm16 80c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 48-48 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l48 0 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-48 48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-48z"/>
                    </svg>
                </PrimaryButton>
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
                                <WarningButton @click="openModalForm(2,a)">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 576 512">
                                        <path fill="#ffffff" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                    </svg>
                                </WarningButton>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <DangerButton @click="openModalDel(a)">
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
                <p>Fecha: <span class="text-lg font-medium text-gray-900">{{ v.established_date }}</span></p>
                <p>Area: <span class="text-lg font-medium text-gray-900">{{ v.area_km2 }}</span></p>
                <p>Nivel de protección: <span class="text-lg font-medium text-gray-900">{{ v.protection_level}}</span></p>
                <p>Región: <span class="text-lg font-medium text-gray-900">{{ v.region }}</span></p>
                Especies:
                <ol>
                    <li class="text-lg font-medium text-gray-900" v-for="b, i in v.species">
                        {{ (i + 1) + '. ' + b.common_name }}
                    </li>
                </ol>
            </div>

            <div class="m-6 flex justify-end">
                <SecondaryButton @click="closeModalView">Cancel</SecondaryButton>
            </div>
        </Modal>
        <Modal :show="showModalForm" @close="closeModalForm">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
                <div class="mt-6 space-y-6 max-w-xl">
                    <InputGroup :text="'Nombre'" :required="'required'" v-model="form.area_name" :type="'text'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"  viewBox="0 0 512 512">
                          <path fill="#324132" d="M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5l88 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-16 0-72 0s0 0 0 0c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440l0 16c0 13.3 10.7 24 24 24s24-10.7 24-24l0-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z"/>
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.area_name"></InputError>

                    <InputGroup :text="'Área en km'" :required="'required'" v-model="form.area_km2" :type="'number'">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="#324132" d="M3 5v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2m16.002 14H5V5h14z"/>
                            <path fill="#324132" d="M15 12h2V7h-5v2h3zm-3 3H9v-3H7v5h5z"/>
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.area_km2"></InputError>
                
                    <InputGroup :text="'Fecha de Establecimiento'" :required="'required'" v-model="form.established_date" :type="'date'">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="#324132"  d="M7 1.75a.75.75 0 0 1 .75.75v.763c.662-.013 1.391-.013 2.194-.013h4.112c.803 0 1.532 0 2.194.013V2.5a.75.75 0 0 1 1.5 0v.827q.39.03.739.076c1.172.158 2.121.49 2.87 1.238c.748.749 1.08 1.698 1.238 2.87q.074.562.107 1.23a.75.75 0 0 1 .019.46c.027.801.027 1.712.027 2.743v2.112c0 1.838 0 3.294-.153 4.433c-.158 1.172-.49 2.121-1.238 2.87c-.749.748-1.698 1.08-2.87 1.238c-1.14.153-2.595.153-4.433.153H9.944c-1.838 0-3.294 0-4.433-.153c-1.172-.158-2.121-.49-2.87-1.238c-.748-.749-1.08-1.698-1.238-2.87c-.153-1.14-.153-2.595-.153-4.433v-2.112c0-1.031 0-1.942.027-2.744a.75.75 0 0 1 .02-.46q.032-.667.106-1.229c.158-1.172.49-2.121 1.238-2.87c.749-.748 1.698-1.08 2.87-1.238q.35-.046.739-.076V2.5A.75.75 0 0 1 7 1.75m-4.237 8c-.013.653-.013 1.396-.013 2.25v2c0 1.907.002 3.262.14 4.29c.135 1.005.389 1.585.812 2.008s1.003.677 2.009.812c1.028.138 2.382.14 4.289.14h4c1.907 0 3.262-.002 4.29-.14c1.005-.135 1.585-.389 2.008-.812s.677-1.003.812-2.009c.138-1.027.14-2.382.14-4.289v-2c0-.854 0-1.597-.013-2.25zm18.405-1.5H2.832q.024-.284.058-.54c.135-1.005.389-1.585.812-2.008s1.003-.677 2.009-.812c1.028-.138 2.382-.14 4.289-.14h4c1.907 0 3.262.002 4.29.14c1.005.135 1.585.389 2.008.812s.677 1.003.812 2.009q.034.255.058.539m-10.381 4.057a.75.75 0 0 1 .463.693v4a.75.75 0 0 1-1.5 0v-2.19l-.22.22a.75.75 0 0 1-1.06-1.06l1.5-1.5a.75.75 0 0 1 .817-.163M14 13.75a.25.25 0 0 0-.25.25v2a.25.25 0 1 0 .5 0v-2a.25.25 0 0 0-.25-.25m-1.75.25a1.75 1.75 0 1 1 3.5 0v2a1.75 1.75 0 1 1-3.5 0z" clip-rule="evenodd"/>
                        </svg>
                    </InputGroup>
                    <InputError class="mt-1" :message="form.errors.established_date"></InputError>
                
                    <SelectInput 
                      :text="'Nivel de Protección'" 
                      :required="'required'" 
                      v-model="form.protection_level" 
                      :options="protectionLevelOptions"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="#324132">
                            <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                            <path fill="#324132" d="m12.702 2.195l7 2.625A2 2 0 0 1 21 6.693v5.363a9 9 0 0 1-4.975 8.05l-3.354 1.677a1.5 1.5 0 0 1-1.342 0l-3.354-1.677A9 9 0 0 1 3 12.056V6.693A2 2 0 0 1 4.298 4.82l7-2.625a2 2 0 0 1 1.404 0M12 4.068L5 6.693v5.363a7 7 0 0 0 3.87 6.26L12 19.883l3.13-1.565A7 7 0 0 0 19 12.056V6.693zM12 8a1 1 0 0 1 1 1v2h2a1 1 0 1 1 0 2h-2v2a1 1 0 1 1-2 0v-2H9a1 1 0 1 1 0-2h2V9a1 1 0 0 1 1-1"/></g>
                        </svg>
                    </SelectInput>
                    <InputError :message="form.errors.protection_level"/>
                    <InputError class="mt-1" :message="form.errors.protection_level"></InputError>
                
                    <SelectInput :text="'Región'" :required="'required'" v-model="form.region_id" :options="regions">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                            <path fill="#324132" d="M17.91 93.761c19.4 67.244 47.029 124.21 79.363 187.172l27.561-8.368c-34.337-52.44-62.494-96.45-72.16-152.817l24.231 6.32c12.377 75.413 79.95 133.444 109.213 168.56c4.905 16.388.589 32.776-4.916 46.354c51.616 25.103 104.672 57.56 163.292 69.531c22.014-17.212 44.264-27.73 68.126 7.726l9.833-28.094l23.177-.702L432.636 361c22.372 8.044 50.335-16.05 50.92-22.826c1.675-19.426.496-31.362 10.535-47.056l-55.836 7.725c-1.367 16.264 1.583 34.771-15.1 44.247c-88.44 50.234-115.313-62.388-107.457-109.564c-36.356-16.025-40.996-34.962-62.507-68.126l-22.475-2.81l-15.451 13.345l-40.033-51.27z"/>
                        </svg>
                    </SelectInput>
                    <InputError class="mt-1" :message="form.errors.region_id"></InputError>
                </div>
            </div>
            <div class="m-6 flex justify-end space-x-4">
                <PrimaryButton @click="save">Guardar</PrimaryButton>
                <SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
            </div>
        </Modal>
        <Modal :show="showModalDel" @close="closeModalDel">
            <div class="p-6">
                <p class="text-2xl text-gray-500">
                    ¿Estás seguro de eliminar el área protegida 
                    <span class="text-2xl font-medium text-gray-500">{{ v.name }}</span>?
                </p>
            </div>
            <div class="m-6 flex justify-end space-x-4">
                <PrimaryButton @click="deleteAreaProtegida">Sí, eliminar</PrimaryButton>
                <SecondaryButton @click="closeModalDel">Cancelar</SecondaryButton>
            </div>
        </Modal>



	</AuthenticatedLayout>
    
</template>