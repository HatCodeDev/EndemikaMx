<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Bar, Pie } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js';
import { ref } from 'vue';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

const props = defineProps({
    protectedAreas: { type: Object },
    species: { type: Number },
    regions:  { type: Object }
});

const areas = ref([]);
const reg = ref([]);
const chartData1 = ref([]);
const chartOptions1 = ref([]);
const chartData2 = ref([]);
const chartOptions2 = ref([]);
const areas2 = ref([]);
const spe = ref([]);
const colors = ref([]);

const random = () => {
  return Math.floor(Math.random() * 256);
}

// Graphic1
props.regions.forEach((row, index) => {
    reg.value.push(row.region_name);
    const protectedAreaCount = row.protected_area_count || 0;
    areas.value.push(protectedAreaCount);
    colors.value.push(`rgb(${random()}, ${random()}, ${random()})`);
});
chartOptions1.value = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      position: 'right',
      labels: {
        font: {
          size: window.innerWidth < 768 ? 10 : 12, // Tamaño de fuente adaptado para dispositivos móviles
        },
        padding: 10,
        boxWidth: 20,
        boxHeight: 10,
      },
    },
    tooltip: {
      enabled: true,
    },
  },
  scales: {
    x: {
      ticks: {
        autoSkip: window.innerWidth < 768 ? true : false, // Saltar etiquetas en dispositivos móviles para evitar saturación
        maxRotation: 45,
        minRotation: 45,
        font: {
          size: window.innerWidth < 768 ? 10 : 12,
        },
      },
    },
    y: {
      beginAtZero: true,
      ticks: {
        font: {
          size: window.innerWidth < 768 ? 10 : 12,
        },
      },
    },
  },
};
chartData1.value = {
  labels: reg.value,
  datasets: [
    {
      label: 'Protected Areas',
      data: areas.value,
      backgroundColor: colors,
    },
  ],
};
// Graphic2
props.protectedAreas.forEach((area, index) => {
    areas2.value.push(area.area_name);
    const speciesCount = area.species ? area.species.length : 0;
    spe.value.push(speciesCount);
    colors.value.push(`rgb(${random()}, ${random()}, ${random()})`);
});

chartOptions2.value = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: {
      position: window.innerWidth < 768 ? 'bottom' : 'right', // Cambia la posición de la leyenda para dispositivos móviles
      labels: {
        font: {
          size: window.innerWidth < 768 ? 10 : 12, // Tamaño de fuente reducido para móviles
        },
        padding: 8,
        boxWidth: 15,
        boxHeight: 8,
      },
    },
    tooltip: {
      enabled: true,
    },
  },
};
chartData2.value = {
    labels: areas2.value, 
    datasets: [
        {
            label: 'Species Count per Protected Area',
            data: spe.value, 
            backgroundColor: colors.value,
        },
    ],
};
</script>

<template>
	<Head title="Dashboard" />
	<AuthenticatedLayout>
		<template #header>
			Dashboard
		</template>
		<div class="p-4 bg-white rounded-lg shadow-xs">
			<div class="grid gap-8 mb-8 md:grid-cols-3 xl:grid-cols-3">
              <!-- Card -->
              <div class="flex border items-center p-4 bg-white rounded-lg shadow-xs ">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full d">
					<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                		<path fill="currentcolor" d="M1 7.998a6.998 6.998 0 0 1 13.966-.666a14 14 0 0 0-1.037-.237a6 6 0 0 0-1.894-3.534c-.101.18-.233.407-.384.648c-.338.54-.823 1.24-1.308 1.603a.2.2 0 0 0-.045.04c0 .027.01.101.085.27q.05.111.13.27c.09.182.202.406.303.655a7 7 0 0 0-.99.223a10 10 0 0 0-.162-.334a9 9 0 0 1-.197-.412c-.088-.2-.184-.46-.167-.736c.02-.32.182-.58.443-.776c.317-.238.716-.783 1.06-1.334c.166-.263.307-.51.407-.69l.023-.042A5.97 5.97 0 0 0 7.998 2H7.95c.091.18.191.395.281.634c.244.646.464 1.592.071 2.428c-.361.77-.984.97-1.45 1.09l-.067.017c-.453.117-.64.165-.776.37c-.126.192-.103.433.04.9l.033.105c.057.182.125.398.16.602c.044.254.056.572-.104.88a1.5 1.5 0 0 1-.622.651a2.1 2.1 0 0 1-.664.21l-.068.012c-.358.063-.54.095-.715.282c-.137.147-.222.402-.271.772q-.029.225-.045.456l-.007.082a4 4 0 0 1-.069.53l-.025.11a6 6 0 0 0 2.215 1.476q-.282.42-.524.868A7 7 0 0 1 1 7.998m1 0a5.97 5.97 0 0 0 .787 2.973l.018-.15c.054-.405.169-.933.532-1.322c.415-.444.923-.528 1.248-.581l.092-.016a1.2 1.2 0 0 0 .36-.103a.5.5 0 0 0 .213-.236c.015-.027.033-.09.006-.245a4 4 0 0 0-.122-.451l-.042-.134c-.13-.425-.333-1.115.081-1.744c.36-.547.939-.686 1.314-.777l.114-.028c.397-.103.632-.2.795-.547c.213-.452.12-1.062-.101-1.65a5.4 5.4 0 0 0-.43-.88A6 6 0 0 0 2 7.998m13.925.74A.5.5 0 0 0 15.5 8.5h-.008l-.026-.003l-.091-.018a6 6 0 0 1-.299-.078l-.095-.026a15 15 0 0 0-.841-.218a8.5 8.5 0 0 0-2.952-.153c-1.202.15-2.121.558-2.748 1.142c-.63.589-.94 1.337-.94 2.1q.001.275.038.52c1.05-.916 2.345-1.657 3.776-2.23a.5.5 0 1 1 .372.929c-.797.319-1.534.687-2.198 1.102c-1.652.964-2.681 2.202-3.435 3.71a.5.5 0 1 0 .894.447c.384-.766.843-1.455 1.448-2.068q.03.057.07.124c.11.186.28.435.512.686c.465.5 1.214 1.034 2.273 1.034c.652 0 1.194-.166 1.638-.456c.44-.286.758-.675.996-1.083c.368-.63.579-1.38.735-1.936q.059-.211.109-.377c.173-.564.426-1.07.66-1.484q.179-.31.325-.541l.016-.026a5 5 0 0 0 .218-.373a.5.5 0 0 0-.022-.486"/>
              		</svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 ">
                    Áreas protegidas
                  </p>
                  <p class="text-lg font-semibold text-gray-700 ">
                    {{protectedAreas.length}}
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex border items-center p-4 bg-white rounded-lg shadow-xs ">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full ">
					<svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    	<path fill-rule="evenodd" d="M181.5 197.1l12.9 6.4c5.9 3 12.4 4.5 19.1 4.5c23.5 0 42.6-19.1 42.6-42.6l0-21.4c0-35.3-28.7-64-64-64l-64 0c-35.3 0-64 28.7-64 64l0 21.4c0 23.5 19.1 42.6 42.6 42.6c6.6 0 13.1-1.5 19.1-4.5l12.9-6.4 8.4-4.2L135.1 185c-4.5-3-7.1-8-7.1-13.3l0-3.7c0-13.3 10.7-24 24-24l16 0c13.3 0 24 10.7 24 24l0 3.7c0 5.3-2.7 10.3-7.1 13.3l-11.8 7.9 8.4 4.2zm-8.6 49.4L160 240l-12.9 6.4c-12.6 6.3-26.5 9.6-40.5 9.6c-3.6 0-7.1-.2-10.6-.6l0 .6c0 35.3 28.7 64 64 64l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l160 0 0-48 0-16c0-23.7 12.9-44.4 32-55.4c9.4-5.4 20.3-8.6 32-8.6l0-16c0-26.5 21.5-48 48-48c8.8 0 16 7.2 16 16l0 32 0 16 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-99.7c0-48.2-30.8-91-76.6-106.3l-8.5-2.8c-8-2.7-12.6-11.1-10.4-19.3s10.3-13.2 18.6-11.6l19.9 4C576 86.1 640 164.2 640 254.9l0 1.1s0 0 0 0c0 123.7-100.3 224-224 224l-1.1 0L256 480l-.6 0C132 480 32 380 32 256.6l0-.6 0-39.2c-10.1-14.6-16-32.3-16-51.4L16 144l0-1.4C6.7 139.3 0 130.5 0 120c0-13.3 10.7-24 24-24l2.8 0C44.8 58.2 83.3 32 128 32l64 0c44.7 0 83.2 26.2 101.2 64l2.8 0c13.3 0 24 10.7 24 24c0 10.5-6.7 19.3-16 22.6l0 1.4 0 21.4c0 1.4 0 2.8-.1 4.3c12-6.2 25.7-9.6 40.1-9.6l8 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-8 0c-13.3 0-24 10.7-24 24l0 8 56.4 0c-15.2 17-24.4 39.4-24.4 64l-32 0c-42.3 0-78.2-27.4-91-65.3c-5.1 .9-10.3 1.3-15.6 1.3c-14.1 0-27.9-3.3-40.5-9.6zM96 128a16 16 0 1 1 0 32 16 16 0 1 1 0-32zm112 16a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z"/>
                  	</svg>
        
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 ">
                    Especies
                  </p>
                  <p class="text-lg font-semibold text-gray-700 ">
                    {{ species }}
                  </p>
                </div>
              </div>
              <!-- Card -->
              	<div class="flex border items-center p-4 bg-white rounded-lg shadow-xs ">
                	<div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full ">
						<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
							<path fill="currentColor" d="M17.91 93.761c19.4 67.244 47.029 124.21 79.363 187.172l27.561-8.368c-34.337-52.44-62.494-96.45-72.16-152.817l24.231 6.32c12.377 75.413 79.95 133.444 109.213 168.56c4.905 16.388.589 32.776-4.916 46.354c51.616 25.103 104.672 57.56 163.292 69.531c22.014-17.212 44.264-27.73 68.126 7.726l9.833-28.094l23.177-.702L432.636 361c22.372 8.044 50.335-16.05 50.92-22.826c1.675-19.426.496-31.362 10.535-47.056l-55.836 7.725c-1.367 16.264 1.583 34.771-15.1 44.247c-88.44 50.234-115.313-62.388-107.457-109.564c-36.356-16.025-40.996-34.962-62.507-68.126l-22.475-2.81l-15.451 13.345l-40.033-51.27z"/>
						</svg>
                	</div>
                	<div>
                	  <p class="mb-2 text-sm font-medium text-gray-600 ">
                	    Regiones
                	  </p>
                	  <p class="text-lg font-semibold text-gray-700 ">
                	    {{ regions.length }}
                	  </p>
                	</div>
              	</div>
			</div>
			<div class="space-y-6 bg-white p-6 border rounded-lg">
			  <!-- Gráfico de Áreas Protegidas por Región -->
			  <div class="w-full p-6 rounded-lg shadow-md bg-gray-50 border">
			    <h2 class="text-lg md:text-xl font-semibold text-gray-700 mb-4 text-center">Áreas Protegidas por Región</h2>
			    <div class="flex justify-center items-center h-[300px] md:h-[500px]">
			      <Bar :data="chartData1" :options="chartOptions1" class="w-full max-w-full md:max-w-3xl"></Bar>
			    </div>
			  </div>
			  <!-- Gráfico de Especies por Área Protegida -->
			  <div class="w-full p-6 rounded-lg shadow-md bg-gray-50 border">
			    <h2 class="text-lg md:text-xl font-semibold text-gray-700 mb-4 text-center">Especies por Área Protegida</h2>
			    <div class="flex justify-center items-center h-[300px] md:h-[500px]">
			      <Pie :data="chartData2" :options="chartOptions2" class="w-full max-w-full md:max-w-3xl"></Pie>
			    </div>
			  </div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
