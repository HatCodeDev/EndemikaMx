<template>
  <button :type="type" class="rounded-lg border border-transparent bg-darkgreen px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-200 ease-in-out 
           hover:bg-lightgray hover:text-darkgreen 
           focus:outline-none focus:ring-4 focus:ring-lightgray focus:ring-opacity-50 
           active:bg-green-800 shadow-md shadow-darkgreen/50 hover:shadow-lg hover:shadow-darkgreen/40">
    <slot/>
  </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
