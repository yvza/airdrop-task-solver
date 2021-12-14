<template>
  <section class="flex">
    <aside class="w-1/6 p-6 h-screen origin-bg-color text-slate-400">
      <div class="">
        <img src="../../img/airdrop_task_solver.png" alt="Airdrop Task Solver">
      </div>
      <div class="mt-12">
        <ul class="w-52 flex flex-col">
          <li class="p-5 my-1 w-full shadow-md bg-cyan-900 rounded text-slate-200 hover:cursor-pointer">
            <i class="fas fa-plus-square"></i>
            <a class="ml-3" href="">Garapan Nyar</a>
          </li>
          <li class="p-5 my-1 w-full hover:shadow-md hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="fas fa-list"></i>
            <a class="ml-3" href="">List Garapan</a>
          </li>
          <li class="p-5 my-1 w-full hover:shadow-md hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="fas fa-users-cog"></i>
            <a class="ml-3" href="">Ngatur Akun</a>
          </li>
          <li class="p-5 my-1 w-full hover:shadow-md hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="fas fa-file-alt"></i>
            <a class="ml-3" href="">Ngatur Kata-Kata</a>
          </li>
          <li class="p-5 my-1 w-full hover:shadow-md hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="far fa-lightbulb"></i>
            <a class="ml-3" href="">Basis Kawruh</a>
          </li>
          <li class="p-5 my-1 w-full hover:shadow-md hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="fas fa-info-circle"></i>
            <a class="ml-3" href="">Kridit</a>
          </li>
        </ul>
      </div>
    </aside>
    <article class="w-5/6 flex flex-col">
      <div class="px-10 pt-10 shadow-lg">
        <div class="head-content">
          <h1 class="text-2xl font-bold font-sans">Garapan Nyar</h1>
          <h6 class="text-sm text-slate-400 font-sans">Nok kene nggone gawe nambah garapan</h6>
        </div>
        <div class="head-menu pt-10">
          <ul class="flex">
            <li class="py-3 mr-3 border-b-4 border-blue-500 hover:cursor-pointer">Langkah 1</li>
            <li class="py-3 mx-3 hover:border-b-4 hover:border-blue-500 hover:cursor-pointer">Langkah 2</li>
            <li class="py-3 mx-3 hover:border-b-4 hover:border-blue-500 hover:cursor-pointer">Langkah 3</li>
          </ul>
        </div>
      </div>
      <div class="content grow bg-slate-100 p-10 overflow-x-scroll">
        Konten

        tes
        <div class="form-control">
          <label class="label">
            <span class="label-text">Username</span>
          </label> 
          <input type="text" placeholder="username" class="input input-bordered">
        </div>
      </div>
    </article>
  </section>
</template>
<script>
export default {
  
}
</script>
<style>
  .origin-bg-color {
    background: #0F2133;
  }
</style>