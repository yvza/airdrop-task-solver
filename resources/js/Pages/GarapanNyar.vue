<template>
  <AppHead title="Garapan Nyar">
    <meta name="description" content="Airdrop Task Solver" />
  </AppHead>
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
      <form @submit.prevent="submit" action="/" method="post" class="content grow bg-slate-100 p-10 overflow-x-scroll">
        <div v-show="step === 1">
          <div v-if="errors.airdrop_name || errors.project_url || errors.distribution_date" class="alert alert-warning">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>                         
              </svg> 
              <label>Ada yang kosong nih, isi dulu yg bner y ges y</label>
            </div>
          </div>
          <div class="alert">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#2196f3" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
              </svg> 
              <label>Isikan "Airdrop Name" yang sama jika mau mengerjakan task berbeda dari task yang sudah pernah dibuat.</label>
            </div>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Airdrop Name</span>
            </label> 
            <input v-model="form.airdrop_name" type="text" placeholder="16 Sol for First 500 Participant" class="input input-bordered">
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Project Url</span>
            </label> 
            <input v-model="form.project_url" type="text" placeholder="https://indoartproject.solana.com/" class="input input-bordered">
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Distribution Date</span>
            </label> 
            <input v-model="form.distribution_date" type="date" class="input input-bordered">
          </div>
          <div class="flex mt-4 justify-end">
            <button @click="stepHandler(2)" class="btn">Nerusake&nbsp; <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <div v-show="step === 2">
          <div v-if="errors.task_name" class="alert alert-warning">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>                         
              </svg> 
              <label>Ada yang kosong nih, isi dulu yg bner y ges y</label>
            </div>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-twitter"></i>&nbsp;
                Twitter Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" value="1">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-facebook"></i>&nbsp;
                Facebook Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" disabled="disabled" value="2">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-medium"></i>&nbsp;
                Medium Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" disabled="disabled" value="3">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-instagram"></i>&nbsp;
                Instagram Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" disabled="disabled" value="4">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-discord"></i>&nbsp;
                Discord Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" disabled="disabled" value="5">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-telegram"></i>&nbsp;
                Telegram Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" disabled="disabled" value="6">
            </label>
          </div>
          <div class="form-control">
            <label class="cursor-pointer label">
              <span class="label-text">
                <i class="fab fa-reddit"></i>&nbsp;
                Reddit Task
              </span> 
              <input v-model="form.task_name" type="radio" name="opt" class="radio" disabled="disabled" value="7">
            </label>
          </div>
          <div class="btn-group mt-4 justify-end">
            <button @click="stepHandler(1)" class="btn"><i class="fas fa-arrow-circle-left"></i>&nbsp; Mbalek</button>
            <button @click="stepHandler(3)" class="btn">Nerusake&nbsp; <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </div>
        <div v-show="step === 3">
          <div v-if="errors.target_url" class="alert alert-warning">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>                         
              </svg> 
              <label>Ada yang kosong nih, isi dulu yg bner y ges y 🤨</label>
            </div>
          </div>
          <div v-if="$page.props.twitter.success_message" class="alert alert-success">
            <div class="flex-1 items-center">
              <i class="fas fa-check-circle"></i>&nbsp;
              <label>{{ $page.props.twitter.success_message }}</label>
            </div>
          </div>
          <div v-if="$page.props.twitter.error_message" class="alert alert-error">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">    
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>                      
              </svg> 
              <label>{{ $page.props.twitter.error_message }}</label>
            </div>
          </div>
          <div v-if="$page.props.twitter_token" class="alert alert-warning">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>                         
              </svg> 
              <label>{{ $page.props.twitter_token }}</label>
            </div>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Target Url</span>
            </label> 
            <input v-model="form.target_url" type="text" placeholder="https://twitter.com/yuza1337/status/179539111655374848" class="input input-bordered">
          </div>
          <div class="form-control flex-col">
            <label class="label">
              <span class="label-text">Kon Kate Nyapo</span>
            </label> 
            <div>
              <button @click="send(1)" type="submit" class="btn"><i class="fas fa-user-plus"></i>&nbsp; Follow</button>
              <button @click="send(2)" type="submit" class="btn ml-3"><i class="fas fa-heart"></i>&nbsp; Love</button>
              <button @click="send(3)" type="submit" class="btn ml-3"><i class="fas fa-retweet"></i>&nbsp; Retweet</button>
              <button @click="send(4)" type="submit" class="btn ml-3"><i class="fas fa-quote-left"></i>&nbsp; Quote Tweet</button>
            </div>
          </div>
          <div class="flex mt-4 justify-end">
            <button @click="stepHandler(2)" class="btn"><i class="fas fa-arrow-circle-left"></i>&nbsp; Mbalek</button>
          </div>
        </div>
      </form>
    </article>
  </Layout>
</template>
<script>
import { Inertia } from '@inertiajs/inertia';
import { ref, reactive } from 'vue'
import Layout from '../Shared/Layout.vue'
import AppHead from '../Shared/AppHead.vue'

export default {
  props: {
    errors: Object,
    twitter_follow: Number,
    twitter_love: Number,
    twitter_retweet: Number,
    twitter_quotetweet: Number
  },
  setup() {
    const step = ref(1); // step controll handler
    const form = reactive({
      // 1st step - getting airdrop info
      airdrop_name: '',
      project_url: '',
      distribution_date: '',
      // 2nd step - getting task type
      task_name: '',
      target_url: ''
    })
    
    function stepHandler(currentStep) {
      this.step = currentStep;
    }

    function send(type) {
      let data = "airdrop_name=" + form.airdrop_name
        + "&project_url=" + form.project_url
        + "&distribution_date=" + form.distribution_date
        + "&task_name=" + form.task_name
        + "&target_url=" + form.target_url
        + "&type=" + type
      Inertia.post('/', data)
    }

    return {
      step,
      stepHandler,
      form,
      send
    };
  },
  components: { 
    Layout,
    AppHead
  }
}
</script>
<style>
  
</style>