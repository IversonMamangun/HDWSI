<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import Autoplay from 'embla-carousel-autoplay'
import { ref } from 'vue'
import {
  Carousel,
  CarouselContent,
  CarouselItem,
} from '@/components/ui/carousel'

const plugin = Autoplay({
  delay: 3000,
  stopOnInteraction: true,
})

const carouselItems = ref([
  {
    id: 1,
    title: 'Human Wellness',
    icon: '/assets/front-page/ICONS/Human Wellness1.png', 
    text: 'Healthy body, mind and emotions.'
  },
  {
    id: 2,
    title: 'Artificial Intelligence',
    icon: '/assets/front-page/ICONS/Artificial Intelligence.png',
    text: 'AI is collaborative intelligence.'
  },
  {
    id: 3,
    title: 'Digital Wellness',
    icon: '/assets/front-page/ICONS/Digital Wellness.png',
    text: 'Healthy relationship with technology.'
  },
  {
    id: 4,
    title: 'Social Intelligence',
    icon: '/assets/front-page/ICONS/Social Intelligence.png',
    text: 'Building better connections and communities.'
  },
  {
    id: 5,
    title: 'Human Behavior',
    icon: '/assets/front-page/ICONS/Human Behavior.png',
    text: 'Understanding how people think and act.'
  },
  {
    id: 6,
    title: 'Digital Ethics',
    icon: '/assets/front-page/ICONS/Digital Ethics.png',
    text: 'Ethical technology use.'
  },
  {
    id: 7,
    title: 'Future Economy',
    icon: '/assets/front-page/ICONS/Future Economy.png',
    text: 'Preparing for the digital and AI-driven economy.'
  },
  {
    id: 8,
    title: 'Human-Centered Innovation',
    icon: '/assets/front-page/ICONS/Human-Centered Innovation.png',
    text: "Creating solutions focused on people's needs."
  },
  {
    id: 9,
    title: 'Leadership',
    icon: '/assets/front-page/ICONS/Leadership.png',
    text: 'Developing responsible and visionary leaders.'
  },
  {
    id: 10,
    title: 'Sustainability',
    icon: '/assets/front-page/ICONS/Sustainability.png',
    text: 'Building a greener and more resilient future.'
  }
])
</script>

<template>
  <Head title="Events" />

  <section class="relative flex min-h-screen w-full items-start overflow-hidden pt-36 md:pt-40 lg:pt-48 pb-24">
    
    <img
      src="/assets/front-page/BACKGROUND/1.jpg"
      alt="Futuristic City Background"
      class="absolute inset-0 h-full w-full object-cover"
    />

    <div class="relative z-10 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col text-left text-white mb-20">
        
        <h2 class="mb-1 text-[1.4rem] font-bold uppercase leading-none tracking-[0.1em] text-gray-100 sm:text-[2rem] md:text-[2.6rem] lg:text-[34px]">
          BUILDING THE NEXT GENERATION OF
        </h2>
        
        <h1 class="mb-1 text-[3rem] font-extrabold uppercase leading-[0.85] tracking-tighter sm:text-[4.5rem] md:text-[5.8rem] lg:text-[80px]">
          HUMAN-CENTERED
        </h1>
        
        <span class="block text-[4.3rem] font-black uppercase leading-[0.85] tracking-tight bg-gradient-to-r from-[#2095E0] to-[#289F7F] bg-clip-text text-transparent sm:text-[6.3rem] md:text-[8rem] lg:text-[114px]">
          AI LEADERS
        </span>
        
        <p class="mt-8 max-w-xl text-base font-medium leading-relaxed text-gray-200 sm:text-lg md:text-xl">
          The Human-Centered Digital Wellness and Social Intelligence (HDWSI) Framework is an innovative educational discipline designed to prepare individuals, organizations, educators, governments, and future professionals to thrive in the Artificial Intelligence Economy.
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
          <button class="flex items-center gap-2 rounded-md bg-gradient-to-r from-[#2095E0] to-[#289F7F] px-6 py-3 font-bold text-white transition hover:opacity-90">
            Explore HDWSI
            <img src="assets/front-page/ICONS/arrow.png" alt="Arrow Right" class="h-4 w-4">
          </button>

         <Link href="/register" class="flex items-center gap-2 rounded-md bg-gradient-to-r from-[#2095E0] to-[#289F7F] px-6 py-3 font-bold text-white transition hover:opacity-90">
            Be a Member
            <img src="assets/front-page/ICONS/arrow.png" alt="Arrow Right" class="h-4 w-4">
          </Link>

          <Link href="/register" class="flex items-center gap-2 rounded-md border-2 border-white px-6 py-3 font-bold text-white transition hover:bg-white/10">
            Enroll Soon
            <img src="assets/front-page/ICONS/arrow.png" alt="Arrow Right" class="h-4 w-4">
          </Link>
        </div>
      </div>

      <div class="w-full relative px-2">
        <Carousel 
          class="w-full" 
          :opts="{ loop: true, align: 'start' }" 
          :plugins="[plugin]" 
          @mouseenter="plugin.stop" 
          @mouseleave="plugin.reset"
        >
          <CarouselContent class="-ml-4 items-stretch">
            <CarouselItem 
              v-for="item in carouselItems" 
              :key="item.id" 
              class="pl-4 basis-full md:basis-1/2 lg:basis-1/3 xl:basis-1/4 flex"
            >
              
              <div class="flex h-full w-full flex-col justify-start rounded-xl bg-[#2095E0] px-5 py-5 shadow-lg">
                
                <div class="w-full">
                  <h3 class="text-xl sm:text-2xl font-bold leading-tight text-white tracking-wide">
                    {{ item.title }}
                  </h3>
                  <div class="mt-2.5 h-[2px] w-full bg-gradient-to-r from-white to-transparent"></div>
                </div>

                <div class="flex items-center gap-4 xl:gap-4 mt-2">
                  
                  <div class="flex-shrink-0">
                    <img 
                      :src="item.icon" 
                      :alt="item.title + ' Icon'" 
                      class="h-12 w-12 object-contain xl:h-14 xl:w-14"
                    />
                  </div>

                  <div>
                    <p class="text-lg font-medium leading-snug text-white">
                      {{ item.text }}
                    </p>
                  </div>
                  
                </div>

              </div>
              
            </CarouselItem>
          </CarouselContent>
        </Carousel>
      </div>

    </div>
  </section>
</template>