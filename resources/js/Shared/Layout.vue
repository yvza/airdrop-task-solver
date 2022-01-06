<template lang="">
  <section class="flex">
    <SideBar />
    <slot />
  </section>
</template>
<script>
import SideBar from "./SideBar.vue"

export default {
  components: { SideBar }
}
</script>
<style>
  html {
    overflow-y: hidden;
  }
  .origin-bg-color {
    background: #0F2133;
  }
</style>