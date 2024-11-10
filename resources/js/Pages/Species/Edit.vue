<script setup>
import Form from './Form.vue';
const props = defineProps({
  protectedAreas: { type: Object },
  specie: { type: Object },
  protectedAreasOfSpecie:  { type: Object }

});

</script>

<template>
  <Form :protectedAreas="protectedAreas" :specie="specie" :protectedAreasOfSpecie="protectedAreasOfSpecie" />
</template>
