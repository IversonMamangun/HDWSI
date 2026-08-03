<script setup lang="ts">
import Autoplay from 'embla-carousel-autoplay'
import { ref } from 'vue'
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from '@/components/ui/carousel'

const plugin = Autoplay({
  delay: 3000,
  stopOnInteraction: true,
})

const pathways = ref([
  {
    id: 1,
    title: 'Certificate Programs',
    image: '/assets/front-page/IMAGE/Certificate.png'
  },
  {
    id: 2,
    title: 'Diploma Programs',
    image: '/assets/front-page/IMAGE/Diploma.png'
  },
  {
    id: 3,
    title: 'Undergraduate Degree Programs',
    image: '/assets/front-page/IMAGE/Undergraduate.png'
  },
  {
    id: 4,
    title: 'Graduate Studies',
    image: '/assets/front-page/IMAGE/Graduate.jpg'
  },
  {
    id: 5,
    title: 'Corporate Training',
    image: '/assets/front-page/IMAGE/Corporate.jpg'
  },
  {
    id: 6,
    title: 'Government Leadership Programs',
    image: '/assets/front-page/IMAGE/Government.jpg'
  },
  {
    id: 7,
    title: 'Professional Certification',
    image: '/assets/front-page/IMAGE/Professional.jpg'
  },
  {
    id: 8,
    title: 'Online Learning',
    image: '/assets/front-page/IMAGE/Online.jpg'
  },
  {
    id: 9,
    title: 'AI Learning Platform',
    image: '/assets/front-page/IMAGE/AI Learning.jpg'
  }
])
</script>

<template>
  <section class="w-full pb-20 overflow-x-hidden bg-gray-50 pt-10">
    
    <!-- Header Container: max-w-7xl with full-width image inside -->
    <div class="relative w-full max-w-7xl mx-auto overflow-hidden rounded-xl shadow-lg border border-gray-200 mb-10">
  <img 
    src="/assets/front-page/IMAGE/Learning Pathways.png" 
    alt="Learning Pathways" 
    class="w-full object-cover"
  />
  <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6  text-white">
    <h1 class="text-3xl font-extrabold uppercase md:text-5xl tracking-wide">
      Learning Pathways
    </h1>
    <h2 class="mt-2 text-lg font-medium md:text-2xl">
      HDWSI offers education through multiple formats:
    </h2>
  </div>
</div>

    
    <!-- Carousel Section -->
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-12 relative">
      <Carousel 
        class="w-full" 
        :opts="{ loop: true, align: 'start' }" 
        :plugins="[plugin]" 
        @mouseenter="plugin.stop" 
        @mouseleave="plugin.reset"
      >
        <CarouselContent class="-ml-6 items-stretch">
          
          <CarouselItem 
            v-for="item in pathways" 
            :key="item.id" 
            class="pl-6 basis-full md:basis-1/2 lg:basis-1/3 flex"
          >
            
            <!-- Card Container: Removed forced aspect ratio so it wraps tightly -->
            <div class="flex w-full flex-col overflow-hidden rounded-xl bg-white shadow-lg shadow-blue-300 border border-gray-200">
              
              <!-- Image Box (Maintains 1:1 square ratio for the image itself) -->
              <div class="aspect-square w-full">
                <img 
                  :src="item.image" 
                  :alt="item.title" 
                  class="h-full w-full object-cover" 
                />
              </div>
              
              <!-- Title Text Area (Tight padding, no extra empty space below) -->
              <div class="flex items-center justify-center px-4 py-5 text-center">
                <h3 class="text-xl sm:text-2xl font-extrabold text-[#2095E0] leading-tight">
                  {{ item.title }}
                </h3>
              </div>

            </div>
            
          </CarouselItem>
        </CarouselContent>
        
        <!-- Custom Navigation Arrows -->
        <CarouselPrevious class="h-10 w-10 sm:h-12 sm:w-12 border-0 bg-transparent hover:bg-transparent -left-4 sm:-left-12 shadow-none">
          <img src="/assets/front-page/ICONS/arrow1.png" alt="Previous" class="h-full w-full object-contain transition-transform hover:scale-105" />
        </CarouselPrevious>
        
        <CarouselNext class="h-10 w-10 sm:h-12 sm:w-12 border-0 bg-transparent hover:bg-transparent -right-4 sm:-right-12 shadow-none">
          <img src="/assets/front-page/ICONS/arrow2.png" alt="Next" class="h-full w-full object-contain transition-transform hover:scale-105" />
        </CarouselNext>

      </Carousel>
    </div>
    
  </section>
</template>