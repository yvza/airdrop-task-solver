<template lang="">
  <div class="flex">
    <aside class="w-1/6 p-6 h-screen origin-bg-color text-slate-400 flex flex-col">
      <div class="">
        <img src="../../img/airdrop_task_solver.png" alt="Airdrop Task Solver">
      </div>
      <div class="mt-12">
        <SideBar />
      </div>
      <div class="grow flex items-end justify-center">
        <div class="flex items-center">
          <i class="fas fa-sun"></i>&nbsp;<input type="checkbox" class="toggle" @click="modeToggled()">&nbsp;<i class="fas fa-moon"></i>
        </div>
      </div>
    </aside>
    list garapan
  </div>
</template>
<script>
import SideBar from "../Shared/SideBar.vue"

export default {
  components: { SideBar }
}
</script>
<style lang="">
  
</style>