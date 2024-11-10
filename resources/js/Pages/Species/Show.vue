<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DarkButton from '@/Components/DarkButton.vue';

const props = defineProps({
  specie: { type: Object }, 
  protectedAreas: { type: Object }
});
</script>

<template>
    <Head title="Especies" />
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
                <!-- Texto alineado a la izquierda -->
                {{ specie.common_name }}
                
                <!-- Botón alineado a la derecha -->
                <NavLink :href="route('specie.index')">
                  <DarkButton>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#ffffff" d="M48.5 224L40 224c-13.3 0-24-10.7-24-24L16 72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8L48.5 224z"/>
                    </svg>
                  </DarkButton>
                </NavLink>

        </div>

        <div class="grid gap-4 bg-white mb-8 mt-2 md:grid-cols-2 border-l-4 border-l-lightgray rounded-lg shadow-lg p-4">
          <div class="min-w-0 p-4 rounded-lg bg-gray-50">
            <p class="text-sm mb-2"><span class=" text-gray-600">Nombre científico:</span> <span class="text-gray-800 font-medium">{{ specie.scientific_name }}</span></p>
            <p class="text-sm mb-2"><span class=" text-gray-600">Descripción:</span> <span class="text-gray-800">{{ specie.description }}</span></p>
            <p class="text-sm mb-2"><span class=" text-gray-600">Estado de conservación:</span> <span class="text-gray-800">{{ specie.conservation_status }}</span></p>
            <p class="text-sm mb-2"><span class=" text-gray-600">Tipo de dieta:</span> <span class="text-gray-800">{{ specie.diet_type }}</span></p>
            <p class="text-sm mb-2"><span class=" text-gray-600">Población estimada:</span> <span class="text-gray-800">{{ specie.population_estimate }}</span></p>
            <p class="text-sm mb-2"><span class=" text-gray-600">Amenazas:</span> <span class="text-gray-800">{{ specie.threats }}</span></p>
            <p class="text-sm"><span class=" text-gray-600">Áreas protegidas:</span> 
                <span v-for="(a, i) in protectedAreas" :key="i" class="text-gray-800 font-medium">
                    <a v-if="i == (protectedAreas.length-1)">{{ a.area_name }}</a>
                    <a v-else>{{ a.area_name + ', '}}</a>
                </span>
            </p>
          </div>
      
          <div class="min-w-0 p-4 rounded-lg bg-gray-50">
            <img :src="'../storage' + specie.image" :alt="specie.common_name" width="500">
          </div>
        </div>


      
        <div class="inline-flex overflow-hidden mb-4 w-full">
            <!-- {{ specie.scientific_name }}
            {{ specie.conservation_status }}
            {{ specie.average_lifespan }}
            {{ specie.diet_type }}
            {{ specie.population_estimate }}
            {{ specie.threats }}
            {{ specie.description }} -->
        </div>
      </template>
    </AuthenticatedLayout>
</template>
