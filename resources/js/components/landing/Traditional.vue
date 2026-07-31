<script setup lang="ts">
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
    title: 'Technology',
    image: '/assets/front-page/IMAGE/Technology.jpg',
  },
  {
    id: 2,
    title: 'Programming',
    image: '/assets/front-page/IMAGE/Programming.jpg',
  },
  {
    id: 3,
    title: 'Business',
    image: '/assets/front-page/IMAGE/Business.jpg',
  },
  {
    id: 4,
    title: 'Technical Skills',
    image: '/assets/front-page/IMAGE/Technical Skills.jpg',
  }
])
</script>

<template>
    <div id="program-services" class="overflow-x-hidden">
        
        <div class="relative transition-colors duration-500 bg-[linear-gradient(to_bottom,#FFFFFF_0_50%,#289F7F_50%_100%)] pt-12">
            
            <!-- Centered Header Section -->
            <div class="max-w-7xl mx-auto px-4 md:px-8 flex flex-col items-center text-center">
                <h2 class="text-2xl md:text-3xl font-black text-[#289F7F]">Why HDWSI?</h2>
                <h1 class="text-4xl md:text-5xl font-black text-[#2095E0] mt-2">Traditional Education</h1>
                <p class="text-lg text-[#2095E0] mt-2 font-medium">Focuses mainly on:</p>
            </div>
            
            <div class="relative z-30 pt-10 pb-16 w-full max-w-7xl mx-auto px-2 md:px-8">
                
                <Carousel 
                  class="w-full" 
                  :opts="{ loop: true, align: 'start' }" 
                  :plugins="[plugin]" 
                  @mouseenter="plugin.stop" 
                  @mouseleave="plugin.reset"
                >
                  <CarouselContent class="-ml-4 items-stretch">
                    
                    <!-- Adjusted basis to ensure 4 fit cleanly, and reduced card height -->
                    <CarouselItem 
                      v-for="item in carouselItems" 
                      :key="item.id" 
                      class="pl-4 basis-full md:basis-1/2 lg:basis-1/4 flex"
                    >
                      
                      <!-- Reduced height from 380px to 280px for a more compact, fitting size -->
                      <div class="flex h-[280px] w-full flex-col overflow-hidden rounded-xl bg-white shadow-xl">
                        
                        <!-- Top Image (70%) -->
                        <div class="h-[70%] w-full">
                          <img 
                            :src="item.image" 
                            :alt="item.title" 
                            class="h-full w-full object-cover" 
                          />
                        </div>
                        
                        <!-- Bottom Content (30%) -->
                        <div class="flex h-[30%] w-full flex-col justify-center px-5">
                          <!-- Green fade line -->
                          <div class="mb-2 h-[3px] w-full bg-gradient-to-r from-[#289F7F] to-transparent"></div>
                          
                          <h2 class="text-lg sm:text-xl font-bold tracking-wide text-[#289F7F]">
                            {{ item.title }}
                          </h2>
                        </div>

                      </div>
                      
                    </CarouselItem>
                  </CarouselContent>
                </Carousel>
                
            </div>

        </div>
    </div>
</template>