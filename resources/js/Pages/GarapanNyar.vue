<template>
  <Layout>
    <article class="w-5/6 flex flex-col">
      <div class="px-10 pt-10 shadow-lg">
        <div class="head-content">
          <h1 class="text-2xl font-bold font-sans">Garapan Nyar</h1>
          <h6 class="text-sm text-slate-400 font-sans dark:text-slate-900">Nok kene nggone gawe nambah garapan</h6>
        </div>
        <div class="head-menu pt-10">
          <ul class="flex">
            <li class="py-3 mr-3 hover:cursor-not-allowed"
              :class="step === 1 ? 'border-b-4 border-blue-500' : ''">Langkah 1</li>
            <li class="py-3 mx-3 hover:cursor-not-allowed"
              :class="step === 2 ? 'border-b-4 border-blue-500' : ''">Langkah 2</li>
            <li class="py-3 mx-3 hover:cursor-not-allowed"
              :class="step === 3 ? 'border-b-4 border-blue-500' : ''">Langkah 3</li>
          </ul>
        </div>
      </div>
      <div class="content grow bg-slate-100 p-10 overflow-x-scroll">
        <div v-show="step === 1">
          <div class="form-control">
            <label class="label">
              <span class="label-text">Airdrop Name</span>
            </label> 
            <input type="text" placeholder="16Sol for First 500 Participant" class="input input-bordered">
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Project Url</span>
            </label> 
            <input type="text" placeholder="https://indoartproject.solana.com/" class="input input-bordered">
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Distribution Date</span>
            </label> 
            <input type="date" class="input input-bordered">
          </div>
          <div class="flex mt-4 justify-end">
            <button @click="stepHandler(2)" class="btn">Nerusake&nbsp; <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <div v-show="step === 2">
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-twitter"></i>&nbsp;
                Twitter Task
              </span> 
              <input type="radio" name="opt" class="radio" value="1">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-facebook"></i>&nbsp;
                Facebook Task
              </span> 
              <input type="radio" name="opt" class="radio" disabled="disabled" value="2">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-instagram"></i>&nbsp;
                Instagram Task
              </span> 
              <input type="radio" name="opt" class="radio" disabled="disabled" value="3">
            </label>
          </div>
          <div class="btn-group mt-4 justify-end">
            <button @click="stepHandler(1)" class="btn"><i class="fas fa-arrow-circle-left"></i>&nbsp; Mbalek</button>
            <button @click="stepHandler(3)" class="btn">Nerusake&nbsp; <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <div v-show="step === 3">
          <div class="form-control">
            <label class="label">
              <span class="label-text">Target Url</span>
            </label> 
            <input type="text" placeholder="https://twitter.com/yuza1337/status/179539111655374848" class="input input-bordered">
          </div>
          <div class="form-control flex-col">
            <label class="label">
              <span class="label-text">Aksi</span>
            </label> 
            <div>
              <button class="btn"><i class="fas fa-user-plus"></i>&nbsp; Follow</button>
              <button class="btn ml-3"><i class="fas fa-heart"></i>&nbsp; Love</button>
              <button class="btn ml-3"><i class="fas fa-retweet"></i>&nbsp; Retweet</button>
              <button class="btn ml-3"><i class="fas fa-quote-left"></i>&nbsp; Quote Tweet</button>
            </div>
          </div>
          <div class="flex mt-4 justify-end">
            <button @click="stepHandler(2)" class="btn"><i class="fas fa-arrow-circle-left"></i>&nbsp; Mbalek</button>
          </div>
        </div>
      </div>
    </article>
  </Layout>
</template>
<script>
import { ref } from 'vue'
import Layout from '../Shared/Layout.vue'

export default {
  setup() {
    const step = ref(1);
    
    function stepHandler(currentStep) {
      this.step = currentStep;
    }
    return {
      step,
      stepHandler
    };
  },
  components: { Layout }
}
</script>
<style>
  
</style>