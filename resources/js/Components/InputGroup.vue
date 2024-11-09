<template>
  <div class="relative text-lightgray focus-within:text-darkgreen">
    <input 
    class="block w-full pl-10 mt-1 text-sm text-darkgreen border border-lightgray bg-white focus:border-darkgreen focus:ring focus:ring-darkgreen focus:ring-opacity-10 focus:outline-none form-input" 
    :placeholder="text" 
    :type="type" 
    :required="required" 
    :accept="accept" 
    :value="modelValue" 
    @input="$emit('update:modelValue', $event.target.value)" 
    ref="input" />
    <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue','text','type','required', 'accept']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>
