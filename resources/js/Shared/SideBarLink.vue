<template lang="">
  <Link 
    class="p-5 my-1 w-full"
    :class="{'shadow-md bg-cyan-900 rounded text-slate-200 hover:cursor-pointer': active}"
  >
    <slot />
  </Link>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: { Link },
  props: {
    active: Boolean
  }
}
</script>
<style lang="">
  
</style>