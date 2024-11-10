<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/SelectInput.vue';
import {ref} from 'vue';
import select2 from 'select2';
select2();
import Select2 from 'vue3-select2-component';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    protectedAreas: { type: Object },
    specie: { type: Object },
    protectedAreasOfSpecie:  { type: Object }
});

const conservationStatusOptions = [
  { id: 'En peligro crítico', region_name: 'En peligro crítico' },
  { id: 'En peligro', region_name: 'En peligro' },
  { id: 'Vulnerable', region_name: 'Vulnerable' },
  { id: 'Casi amenazado', region_name: 'Casi amenazado' },
  { id: 'Preocupación menor', region_name: 'Preocupación menor' },
];

const form = useForm({
  id: '',
  scientific_name: '',
  common_name: '',
  description: '',
  conservation_status: '',
  average_lifespan: '',
  diet_type: '',
  population_estimate: '',
  threats: '',
  image: '',
  protectedAreas: []
});

const title_form = ref(
  (props.specie == null) ? 'Crear especie endémica' : 'Editar especie endémica'
);

const req = ref('required');
const srcImg = ref('../../storage/img/example.png');
const msj = ref('');
const classMsj = ref('hidden');

const options = ref([]);

props.protectedAreas.map((row) => {
  options.value.push({ 'id': row.id, 'text': row.area_name });
});


if (props.specie != null) {
  form.scientific_name = props.specie.scientific_name;
  form.common_name = props.specie.common_name;
  form.description = props.specie.description;
  form.conservation_status = props.specie.conservation_status;
  form.average_lifespan = props.specie.average_lifespan;
  form.diet_type = props.specie.diet_type;
  form.population_estimate = props.specie.population_estimate;
  form.threats = props.specie.threats;
  form.image = props.specie.image;
  form.id = props.specie.id;
  srcImg.value = '../../storage/' + props.specie.image;
    props.protectedAreasOfSpecie.map((row) => {
        form.protectedAreas.push(row.id);
    });
}

const save = () => {
  if (props.specie == null) {
    form.post(route('specie.store'), {
      onSuccess: () => { ok('Especie endémica creada') }
    });
  } else {
    form.post(route('updatespecie'));
  }
}
const ok = (m) => {
  form.reset();
  msj.value = m;
  classMsj.value = 'block';
  setTimeout(() => {
    classMsj.value = 'hidden';
  }, 8000);
}
const showImg = (e) => {
  form.image = e.target.files[0];
  srcImg.value = URL.createObjectURL(e.target.files[0]);
}


</script>


<template>
    <Head title="Especies" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                    <!-- Texto alineado a la izquierda -->
                    {{ title_form }}

                    <!-- Botón alineado a la derecha -->
                    <NavLink :href="route('specie.index')">
                      <PrimaryButton>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#ffffff" d="M48.5 224L40 224c-13.3 0-24-10.7-24-24L16 72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8L48.5 224z"/>
                        </svg>
                      </PrimaryButton>
                    </NavLink>
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

        <div class="grid gap-4 bg-white mb-8 mt-2 md:grid-cols-2 border-l-4 border-l-lightgray rounded-lg shadow-lg p-4">
            <div class="min-w-0 p-4 rounded-lg bg-gray-50">
                <form class="mt-6 mb-6 space-y-6 max-w-xl" @submit.prevent="save">
                    <!-- Nombre científico -->
                    <InputGroup :text="'Nombre científico'" :required="'required'" v-model="form.scientific_name">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="#324132" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 21h14M6 18h2m-1 0v3m2-10l3 3l6-6l-3-3zm1.5 1.5L9 14m8-11l3 3m-8 15a6 6 0 0 0 3.715-10.712"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.scientific_name"/>

                    <!-- Nombre común -->
                    <InputGroup :text="'Nombre común'" :required="'required'" v-model="form.common_name">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#324132" d="M192 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 7.8c0 27.7-2.4 55.3-7.1 82.5l-84.4 25.3c-40.6 12.2-68.4 49.6-68.4 92l0 71.9c0 40 32.5 72.5 72.5 72.5c26 0 50-13.9 62.9-36.5l13.9-24.3c26.8-47 46.5-97.7 58.4-150.5l94.4-28.3-12.5 37.5c-3.3 9.8-1.6 20.5 4.4 28.8s15.7 13.3 26 13.3l128 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-83.6 0 18-53.9c3.8-11.3 .9-23.8-7.4-32.4s-20.7-11.8-32.2-8.4L316.4 198.1c2.4-20.7 3.6-41.4 3.6-62.3l0-7.8c0-53-43-96-96-96s-96 43-96 96l0 32c0 17.7 14.3 32 32 32s32-14.3 32-32l0-32zm-9.2 177l49-14.7c-10.4 33.8-24.5 66.4-42.1 97.2l-13.9 24.3c-1.5 2.6-4.3 4.3-7.4 4.3c-4.7 0-8.5-3.8-8.5-8.5l0-71.9c0-14.1 9.3-26.6 22.8-30.7zM24 368c-13.3 0-24 10.7-24 24s10.7 24 24 24l40.3 0c-.2-2.8-.3-5.6-.3-8.5L64 368l-40 0zm592 48c13.3 0 24-10.7 24-24s-10.7-24-24-24l-310.1 0c-6.7 16.3-14.2 32.3-22.3 48L616 416z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.common_name"/>
                
                    <!-- Descripción -->
                    <InputGroup :text="'Descripción'" v-model="form.description">
                        <svg class="w-5 h-5"  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="#324132" d="M8 18h8v-2H8zm0-4h8v-2H8zm-2 8q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v12q0 .825-.587 1.413T18 22zm7-13h5l-5-5z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.description"/>
                
                    <!-- Estado de conservación -->
                    <SelectInput 
                    :text="'Estado de Conservación'" 
                    :required="'required'" 
                    v-model="form.conservation_status" 
                    :options="conservationStatusOptions"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#324132" d="M269.4 2.9C265.2 1 260.7 0 256 0s-9.2 1-13.4 2.9L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L269.4 2.9zM144 221.3c0-33.8 27.4-61.3 61.3-61.3c16.2 0 31.8 6.5 43.3 17.9l7.4 7.4 7.4-7.4c11.5-11.5 27.1-17.9 43.3-17.9c33.8 0 61.3 27.4 61.3 61.3c0 16.2-6.5 31.8-17.9 43.3l-82.7 82.7c-6.2 6.2-16.4 6.2-22.6 0l-82.7-82.7c-11.5-11.5-17.9-27.1-17.9-43.3z"/>
                        </svg>
                    </SelectInput>
                    <InputError :message="form.errors.conservation_status"/>

                    <!-- Esperanza de vida promedio -->
                    <InputGroup :text="'Esperanza de vida promedio'" v-model="form.average_lifespan" type="number">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#324132" d="M228.3 469.1L47.6 300.4c-4.2-3.9-8.2-8.1-11.9-12.4l87 0c22.6 0 43-13.6 51.7-34.5l10.5-25.2 49.3 109.5c3.8 8.5 12.1 14 21.4 14.1s17.8-5 22-13.3L320 253.7l1.7 3.4c9.5 19 28.9 31 50.1 31l104.5 0c-3.7 4.3-7.7 8.5-11.9 12.4L283.7 469.1c-7.5 7-17.4 10.9-27.7 10.9s-20.2-3.9-27.7-10.9zM503.7 240l-132 0c-3 0-5.8-1.7-7.2-4.4l-23.2-46.3c-4.1-8.1-12.4-13.3-21.5-13.3s-17.4 5.1-21.5 13.3l-41.4 82.8L205.9 158.2c-3.9-8.7-12.7-14.3-22.2-14.1s-18.1 5.9-21.8 14.8l-31.8 76.3c-1.2 3-4.2 4.9-7.4 4.9L16 240c-2.6 0-5 .4-7.3 1.1C3 225.2 0 208.2 0 190.9l0-5.8c0-69.9 50.5-129.5 119.4-141C165 36.5 211.4 51.4 244 84l12 12 12-12c32.6-32.6 79-47.5 124.6-39.9C461.5 55.6 512 115.2 512 185.1l0 5.8c0 16.9-2.8 33.5-8.3 49.1z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.average_lifespan"/>
                
                    <!-- Tipo de dieta -->
                    <InputGroup :text="'Tipo de dieta'" v-model="form.diet_type">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="#324132" d="M416 0C400 0 288 32 288 176l0 112c0 35.3 28.7 64 64 64l32 0 0 128c0 17.7 14.3 32 32 32s32-14.3 32-32l0-128 0-112 0-208c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7L80 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-224.4c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16l0 134.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8L64 16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.diet_type"/>
                
                    <!-- Población estimada -->
                    <InputGroup :text="'Población estimada'" v-model="form.population_estimate" :type="'number'">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path fill="#324132" d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3l0-84.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5l0 21.5c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-26.8C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112l32 0c24 0 46.2 7.5 64.4 20.3zM448 416l0-21.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176l32 0c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2l0 26.8c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7l0 84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3l0-84.7c-10 11.3-16 26.1-16 42.3zm144-42.3l0 84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2l0 42.8c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-42.8c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112l32 0c61.9 0 112 50.1 112 112z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.population_estimate"/>
                
                    <!-- Amenazas -->
                    <InputGroup :text="'Amenazas'" v-model="form.threats">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="#324132" d="M368 128c0 44.4-25.4 83.5-64 106.4l0 21.6c0 17.7-14.3 32-32 32l-96 0c-17.7 0-32-14.3-32-32l0-21.6c-38.6-23-64-62.1-64-106.4C80 57.3 144.5 0 224 0s144 57.3 144 128zM168 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm144-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM3.4 273.7c7.9-15.8 27.1-22.2 42.9-14.3L224 348.2l177.7-88.8c15.8-7.9 35-1.5 42.9 14.3s1.5 35-14.3 42.9L295.6 384l134.8 67.4c15.8 7.9 22.2 27.1 14.3 42.9s-27.1 22.2-42.9 14.3L224 419.8 46.3 508.6c-15.8 7.9-35 1.5-42.9-14.3s-1.5-35 14.3-42.9L152.4 384 17.7 316.6C1.9 308.7-4.5 289.5 3.4 273.7z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.threats"/>
                
                    <!-- Imagen -->
                    <InputGroup v-if="props.specie == null" @change="showImg($event)" :text="'Imagen'" :required="'required'" :type="'file'" :accept="'image/*'">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#324132" d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                        </svg>
                    </InputGroup>
                    <InputGroup v-else :text="'Imagen'" @change="showImg($event)"  :type="'file'" :accept="'image/*'">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#324132" d="M0 96C0 60.7 28.7 32 64 32l384 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM323.8 202.5c-4.5-6.6-11.9-10.5-19.8-10.5s-15.4 3.9-19.8 10.5l-87 127.6L170.7 297c-4.6-5.7-11.5-9-18.7-9s-14.2 3.3-18.7 9l-64 80c-5.8 7.2-6.9 17.1-2.9 25.4s12.4 13.6 21.6 13.6l96 0 32 0 208 0c8.9 0 17.1-4.9 21.2-12.8s3.6-17.4-1.4-24.7l-120-176zM112 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                        </svg>
                    </InputGroup>
                    <InputError :message="form.errors.image"/>
                    <span class="mt-5">Añadir Áreas Protegidas</span>
                    <Select2 v-model="form.protectedAreas" :options="options"
                      :settings="{ multiple: true, width: '100%' }"
                      @change="form.protectedAreas = $event.target.value" 
                    />
                    <InputError :message="form.errors.protectedAreas" />

                    <PrimaryButton>Guardar</PrimaryButton>

                

                </form>
            </div>
      
            <div class="min-w-0 p-4 rounded-lg bg-gray-50">
              <img :src="srcImg" width="500">
            </div>
        </div>
    
    </AuthenticatedLayout>
</template>
