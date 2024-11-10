<template>
    <div class="relative text-lightgray focus-within:text-darkgreen">
        <select
       class="block w-full pl-10 mt-1 text-sm text-darkgreen border border-lightgray bg-white rounded-md shadow-sm focus:border-darkgreen focus:ring focus:ring-darkgreen focus:ring-opacity-10 focus:outline-none transition-all duration-200 ease-in-out"
        :placeholder="text" 
        :required="required"  
        :value="modelValue" 
        @input="$emit('update:modelValue', $event.target.value)" 
        ref="input" 
        >
            <option value="" selected>{{ text }}</option>
            <option v-for="op in options" :key="op.id" :value="op.id">
              {{ op.region_name }}
            </option>

        </select>
        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
          <slot></slot>
        </div>
    </div>
</template>
  
<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue','text','options','required']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>
  