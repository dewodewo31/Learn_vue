<script setup>
defineProps({
  tags: {
    type: Array,
    required: true
  }
})


</script>

<template>
  <ul class="tags-inline">
    <li v-for="tag in tags" :key="tag">
      <a href="#" class="tag">{{ tag }}</a>
    </li>
  </ul>
</template>
