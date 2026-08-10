<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Footer from '@/components/landing/Footer.vue';
</script>

<template>
  <Head title="Academic School" />

  <div class="min-h-screen bg-gradient-to-bl from-[#104C7D] via-[#2095E0] to-[#104C7D] flex flex-col">
    
    <main class="flex-grow w-full">
      
      <div class="mx-auto relative w-full flex items-center justify-center h-[180px] sm:h-[150px] overflow-hidden shadow-lg">
        <img 
          src="/assets/academic school assets/1.jpg" 
          alt="Academic Schools Background" 
          class="absolute py-2 inset-0 bg-[#2095E0] w-full h-full object-cover z-0" 
        />

        <div class="relative z-20 px-4 text-center">
          <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-white leading-tight uppercase tracking-wider drop-shadow-xl">
            Academic Schools
          </h1>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 py-16">
        
        <div class="flex flex-col lg:flex-row gap-12 items-center">
          
          <div class="w-full lg:w-2/3">
            <div class="mb-10">
              <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-2">
                School of Human Wellness
              </h1>
              <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">
                Building Healthy AI Citizens
              </h2>
              <h3 class="text-xl sm:text-2xl font-semibold text-white">
                Subjects include:
              </h3>
            </div>
            
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              
              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Physical Wellness
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Mental Wellness
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Emotional Wellness
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Cognitive Wellness
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Lifestyle Medicine
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Sleep Science
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Stress Management
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Mindfulness
                </div>
              </li>

              <li class="rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-lg">
                <div class="h-full rounded-2xl p-6 sm:p-8 text-white font-bold text-xl sm:text-2xl bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
                  <span class="w-4 h-4 bg-white rounded-full mr-5 flex-shrink-0"></span>
                  Digital Detox
                </div>
              </li>
            </ul>
          </div>

          <div class="w-full lg:w-1/3 flex justify-center mt-8 lg:mt-0">
            <div class="w-full max-w-[400px] aspect-square rounded-2xl p-[3px] bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-2xl">
              <div class="w-full h-full rounded-2xl overflow-hidden bg-gray-200">
                <img 
                  src="/assets/academic school assets/2.jpg" 
                  alt="School of Human Wellness" 
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>

    <Footer />
  </div>
</template>