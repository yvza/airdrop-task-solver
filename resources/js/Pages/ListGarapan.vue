<template lang="">
  <AppHead title="List Garapan">
    <meta name="description" content="List Garapan - Airdrop Task Solver" />
  </AppHead>
  <Layout>
    <article class="w-full flex flex-col">
      <div class="px-10 p-10 shadow-lg">
        <div class="head-content">
          <h1 class="text-2xl font-bold font-sans">List Garapan</h1>
          <h6 class="text-sm text-slate-400 font-sans dark:text-slate-900">Iki gawe sorting garapan seng kate land</h6>
        </div>
      </div>
      <div class="content grow bg-slate-100 p-10 flex flex-row">
        <div class="flex-grow mr-5 h-full">
          <p v-if="!today" class="text-center text-2xl mb-9">Land Saiki ({{ list_garapan[0].length }})</p>
          <p v-if="today" class="text-center text-2xl mb-9">Land Saiki (-)</p>
          <div class="max-h-[33rem] overflow-y-scroll">
            <div v-for="garapan in list_garapan[0]" class="rounded-md border-solid border-2 border-sky-900 p-4 my-3">
              <p class="font-bold">{{ garapan.airdrop_name }}</p>
              <p><i class="fas fa-link mr-2"></i><a class="text-sky-900" target="_blank" :href="garapan.project_url">{{ garapan.project_url }}</a></p>
              <p><i class="fas fa-calendar-day mr-2"></i>{{ garapan.distribution_date }}</p>
              <p><i class="far fa-dot-circle mr-2"></i>{{ garapan.created_at }}</p>
            </div>
            <div v-if="today" class="rounded-md border-solid border-2 border-sky-900 p-4 my-3">
              <p class="font-bold">Empty</p>
              <p><i class="fas fa-link mr-2"></i><a class="text-sky-900" target="_blank" href="#">-</a></p>
              <p><i class="fas fa-calendar-day mr-2"></i>-</p>
              <p><i class="far fa-dot-circle mr-2"></i>-</p>
            </div>
          </div>
        </div>
        <div class="flex-grow mr-5 h-full">
          <p v-if="!nextThreeDays" class="text-center text-2xl mb-9">Telong dino neh ({{ list_garapan[1].length }})</p>
          <p v-if="nextThreeDays" class="text-center text-2xl mb-9">Telong dino neh (-)</p>
          <div class="max-h-[33rem] overflow-y-scroll">
            <div v-for="garapan in list_garapan[1]" class="rounded-md border-solid border-2 border-sky-900 p-4 my-3">
              <p class="font-bold">{{ garapan.airdrop_name }}</p>
              <p><i class="fas fa-link mr-2"></i><a class="text-sky-900" target="_blank" :href="garapan.project_url">{{ garapan.project_url }}</a></p>
              <p><i class="fas fa-calendar-day mr-2"></i>{{ garapan.distribution_date }}</p>
              <p><i class="far fa-dot-circle mr-2"></i>{{ garapan.created_at }}</p>
            </div>
            <div v-if="nextThreeDays" class="rounded-md border-solid border-2 border-sky-900 p-4 my-3">
              <p class="font-bold">Empty</p>
              <p><i class="fas fa-link mr-2"></i><a class="text-sky-900" target="_blank" href="#">-</a></p>
              <p><i class="fas fa-calendar-day mr-2"></i>-</p>
              <p><i class="far fa-dot-circle mr-2"></i>-</p>
            </div>
          </div>
        </div>
        <div class="flex-grow h-full">
          <p v-if="!stillInLongTime" class="text-center text-2xl mb-9">Jek Suwe ({{ list_garapan[2].length }})</p>
          <p v-if="stillInLongTime" class="text-center text-2xl mb-9">Jek Suwe (-)</p>
          <div class="max-h-[33rem] overflow-y-scroll">
            <div v-for="garapan in list_garapan[2]" class="rounded-md border-solid border-2 border-sky-900 p-4 my-3">
              <p class="font-bold">{{ garapan.airdrop_name }}</p>
              <p><i class="fas fa-link mr-2"></i><a class="text-sky-900" target="_blank" :href="garapan.project_url">{{ garapan.project_url }}</a></p>
              <p><i class="fas fa-calendar-day mr-2"></i>{{ garapan.distribution_date }}</p>
              <p><i class="far fa-dot-circle mr-2"></i>{{ garapan.created_at }}</p>
            </div>
            <div v-if="stillInLongTime" class="rounded-md border-solid border-2 border-sky-900 p-4 my-3">
              <p class="font-bold">Empty</p>
              <p><i class="fas fa-link mr-2"></i><a class="text-sky-900" target="_blank" href="#">-</a></p>
              <p><i class="fas fa-calendar-day mr-2"></i>-</p>
              <p><i class="far fa-dot-circle mr-2"></i>-</p>
            </div>
          </div>
        </div>
      </div>
    </article>
  </Layout>
</template>
<script>
import _ from 'lodash'
import Layout from '../Shared/Layout.vue'
import AppHead from '../Shared/AppHead.vue'

export default {
  props: ['list_garapan'],
  components: { 
    Layout,
    AppHead 
  },
  computed: {
    today() {
      return _.isEmpty(this.list_garapan[0])
    },
    nextThreeDays() {
      return _.isEmpty(this.list_garapan[1])
    },
    stillInLongTime() {
      return _.isEmpty(this.list_garapan[2])
    }
  },
}
</script>
<style lang="">
  
</style>