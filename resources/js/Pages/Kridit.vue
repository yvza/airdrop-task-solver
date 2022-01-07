<template lang="">
  <AppHead title="Kridit">
    <meta name="description" content="Kridit - Airdrop Task Solver" />
  </AppHead>
  <Layout>
    <article class="w-full flex flex-col">
      <div class="px-10 p-10 shadow-lg">
        <div class="head-content">
          <h1 class="text-2xl font-bold font-sans">Kridit</h1>
          <h6 class="text-sm text-slate-400 font-sans dark:text-slate-900">Shottss gawe wong-wong seng melu kontribusi (Contributor and Collaborator)</h6>
        </div>
      </div>
      <div class="content grow bg-slate-100 p-10 flex flex-row">
        <p class="max-h-[37rem] overflow-y-scroll w-full">
          Dependensi lengkap bisa dilihat di <a class="text-sky-900" target="_blank" href="https://github.com/yvza/airdrop-task-solver/network/dependencies">GitHub</a>. <br>
          Logo Designer : <a class="text-sky-900" target="_blank" href="https://dribbble.com/puji_hartono">@warehouse_logo</a>. <br>
          Font : <a class="text-sky-900" target="_blank" href="https://www.dafont.com/true-south.font">True South</a>. <br>
        </p>
      </div>
    </article>
  </Layout>
</template>
<script>
import Layout from '../Shared/Layout.vue'
import AppHead from '../Shared/AppHead.vue'

export default {
  components: { 
    Layout,
    AppHead 
  }
}
</script>
<style lang="">
  
</style>