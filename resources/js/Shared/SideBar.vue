<template lang="">
  <aside class="w-72 min-w-72 p-6 h-screen origin-bg-color text-slate-400 flex flex-col">
    <div class="">
      <img src="../../img/airdrop_task_solver.png" alt="Airdrop Task Solver">
      <p class="text-sm text-center">Next generation airdrop tooling</p>
    </div>
    <div class="mt-12">
      <ul class="w-52 flex flex-col">
        <SideBarLink 
          href="/" 
          :active="$page.component === 'GarapanNyar'"
        >
          <i class="fas fa-plus-square mr-3"></i> Garapan Nyar
        </SideBarLink>
        <SideBarLink 
          href="/list-garapan" 
          :active="$page.component === 'ListGarapan'"
        >
          <i class="fas fa-list mr-3"></i> List Garapan
        </SideBarLink>
        <SideBarLink 
          href="/ngatur-akun" 
          :active="$page.component === 'NgaturAkun'"
        >
          <i class="fas fa-users-cog mr-3"></i> Ngatur Akun
        </SideBarLink>
        <SideBarLink 
          href="/ngatur-kata-kata" 
          :active="$page.component === 'NgaturKataKata'"
        >
          <i class="fas fa-file-alt mr-3"></i> Ngatur Kata Kata
        </SideBarLink>
        <SideBarLink 
          href="/basis-kawruh" 
          :active="$page.component === 'BasisKawruh'"
        >
          <i class="far fa-lightbulb mr-3"></i> Basis Kawruh
        </SideBarLink>
        <SideBarLink 
          href="/kridit" 
          :active="$page.component === 'Kridit'"
        >
          <i class="fas fa-info-circle mr-3"></i> Kridit
        </SideBarLink>
      </ul>
    </div>
    <div class="grow flex items-end justify-center">
      <div class="flex flex-col">
        <p class="text-xs mb-3 text-center">Change Mode</p>
        <div class="flex items-center justify-center">
          <i class="fas fa-sun"></i>&nbsp;<input type="checkbox" class="toggle" @click="modeToggled()">&nbsp;<i class="fas fa-moon"></i>
        </div>
      </div>
    </div>
  </aside>
</template>
<script>
import SideBarLink from "./SideBarLink.vue"
import { ref } from 'vue'

export default {
  components: { SideBarLink },
  setup() {
    const isDark = ref(false);
    
    function modeToggled() {
      this.isDark = !this.isDark;
      if (this.isDark) {
        document.querySelector("html").classList.add("dark");
      } else {
        document.querySelector("html").classList.remove("dark");
      }
    }

    return {
      isDark,
      modeToggled
    }
  }
}
</script>
<style lang="">
  
</style>