<template>
  <div class="relative text-lightgray focus-within:text-darkgreen">
    <input 
      v-if="type !== 'file'"
      class="block w-full pl-10 mt-1 text-sm text-darkgreen border border-lightgray bg-white rounded-md shadow-sm focus:border-darkgreen focus:ring focus:ring-darkgreen focus:ring-opacity-10 focus:outline-none transition-all duration-200 ease-in-out"
      :placeholder="text" 
      :type="type" 
      :required="required" 
      :accept="accept" 
      :value="modelValue" 
      @input="$emit('update:modelValue', $event.target.value)" 
      ref="input" 
    />

    <!-- Diseño personalizado para el input de tipo file -->
    <div v-else class="block w-full mt-1 text-sm text-darkgreen border border-lightgray bg-white rounded-md shadow-sm focus-within:border-darkgreen focus-within:ring focus-within:ring-darkgreen focus-within:ring-opacity-10 focus:outline-none transition-all duration-200 ease-in-out flex items-center">
      <input 
        type="file" 
        :required="required" 
        :accept="accept" 
        @change="handleFileChange" 
        ref="input" 
        class="hidden"
      />
      <button
        type="button"
        @click="triggerFileInput"
        :class="fileName ? 'bg-lightgray text-darkgreen' : 'bg-darkgreen text-white'"
        class="px-4 py-2 text-sm rounded-l-md transition-all duration-200 ease-in-out focus:outline-none hover:bg-opacity-90"
      >
        Seleccionar archivo
      </button>
      <span class="pl-3 text-sm" :class="fileName ? 'text-darkgreen' : 'text-gray-500 italic'">
        {{ fileName ? fileName : 'Ningún archivo seleccionado' }}
      </span>
    </div>

    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none" v-if="type !== 'file'">
      <slot></slot>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue';

const emit = defineEmits(['update:modelValue']); // Define el emit

const props = defineProps(['modelValue', 'text', 'type', 'required', 'accept']);

const input = ref(null);
const fileName = ref('');

const triggerFileInput = () => {
  input.value.click();
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  fileName.value = file ? file.name : '';
  emit('update:modelValue', file); // Usa emit en lugar de $emit
};
</script>
