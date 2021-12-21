<template lang="">
  <ul class="w-52 flex flex-col">
    <SideBarLink href="/" :active="$page.component === 'GarapanNyar'"><i class="fas fa-plus-square mr-3"></i> Garapan Nyar</SideBarLink>
    <SideBarLink href="/list-garapan" :active="$page.component === 'ListGarapan'"><i class="fas fa-list mr-3"></i> List Garapan</SideBarLink>
    <SideBarLink href="/ngatur-akun" :active="$page.component === 'NgaturAkun'"><i class="fas fa-users-cog mr-3"></i> Ngatur Akun</SideBarLink>
    <SideBarLink href="/ngatur-kata-kata" :active="$page.component === 'NgaturKataKata'"><i class="fas fa-file-alt mr-3"></i> Ngatur Kata Kata</SideBarLink>
    <SideBarLink href="/basis-kawruh" :active="$page.component === 'BasisKawruh'"><i class="far fa-lightbulb mr-3"></i> Basis Kawruh</SideBarLink>
    <SideBarLink href="/kridit" :active="$page.component === 'Kridit'"><i class="fas fa-info-circle mr-3"></i> Garapan Nyar</SideBarLink>
  </ul>
</template>
<script>
import SideBarLink from "./SideBarLink.vue"

export default {
  components: { SideBarLink }
}
</script>
<style lang="">
  
</style>