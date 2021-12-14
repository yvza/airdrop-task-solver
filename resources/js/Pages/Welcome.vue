<template>
  <section class="flex">
    <aside class="w-1/6 p-6 h-screen origin-bg-color text-slate-400">
      <div class="">
        <img src="../../img/airdrop_task_solver.png" alt="Airdrop Task Solver">
      </div>
      <div class="mt-12">
        <ul class="w-52 flex flex-col">
          <li class="p-5 my-3 w-full bg-cyan-900 rounded text-slate-200 hover:cursor-pointer">
            <i class="fas fa-plus-square"></i>
            &nbsp;
            <a href="">Garapan Nyar</a>
          </li>
          <li class="p-5 my-3 w-full hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="fas fa-list"></i>
            &nbsp;
            <a href="">List Garapan</a>
          </li>
          <li class="p-5 my-3 w-full hover:bg-cyan-900 hover:rounded hover:text-slate-200 hover:cursor-pointer">
            <i class="fas fa-file-alt"></i>
            &nbsp;
            <a href="">List Kata-kata</a>
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