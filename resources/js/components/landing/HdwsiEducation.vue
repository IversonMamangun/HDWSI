<script setup lang="ts">
import { ref, computed } from 'vue'

const items = ref([
  {
    id: 1,
    title: 'Human Wellness',
    icon: '/assets/front-page/ICONS/Human Wellness.png',
  },
  {
    id: 2,
    title: 'Emotional Intelligence',
    icon: '/assets/front-page/ICONS/Emotional.png',
  },
  {
    id: 3,
    title: 'AI Literacy',
    icon: '/assets/front-page/ICONS/AI Literacy.png',
  },
  {
    id: 4,
    title: 'Digital Ethics',
    icon: '/assets/front-page/ICONS/Digital Ethics.png',
  },
  {
    id: 5,
    title: 'Leadership',
    icon: '/assets/front-page/ICONS/Leadership.png',
  },
  {
    id: 6,
    title: 'Social Intelligence',
    icon: '/assets/front-page/ICONS/Social Intelligence.png',
  },
  {
    id: 7,
    title: 'Human Behavior',
    icon: '/assets/front-page/ICONS/Human Behavior.png',
  },
  {
    id: 8,
    title: 'Sustainable Innovation',
    icon: '/assets/front-page/ICONS/Sustainable.png',
  },
  {
    id: 9,
    title: 'Future Economy',
    icon: '/assets/front-page/ICONS/Future Economy.png',
  },
  {
    id: 10,
    title: 'Digital Wellness', 
    icon: '/assets/front-page/ICONS/Digital Wellness.png',
  }
])

const showAll = ref(false)

const visibleItems = computed(() => {
  return showAll.value ? items.value : items.value.slice(0, 8)
})
</script>

<template>
  <section class="relative w-full bg-gradient-to-bl from-[#104C7D] via-[#2095E0] to-[#104C7D] py-20 overflow-x-hidden">
    
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col items-center text-center text-white mb-14">
        <h2 class="text-3xl md:text-5xl font-black uppercase tracking-wide">
          HDWSI Education
        </h2>
        <p class="mt-3 text-lg md:text-xl font-medium text-gray-200">
          Integrates:
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div 
          v-for="item in visibleItems" 
          :key="item.id"
          class="aspect-[4/3] flex flex-col items-start justify-start rounded-xl border-2 border-gray-300 g-gradient-to-r from-blue-300 to-[#104C7D p-6 sm:p-8 shadow-lg transition-transform duration-300 hover:-translate-y-1"
        >
          <div class="mb-5 flex-shrink-0">
            <img 
              :src="item.icon" 
              :alt="item.title + ' Icon'" 
              class="h-14 w-14 object-contain sm:h-16 sm:w-16"
            />
          </div>
          
          <h3 class="text-xl sm:text-2xl font-bold leading-tight text-white mt-auto pb-4">
            {{ item.title }}
          </h3>
        </div>

      </div>

      <div class="mt-12 flex justify-center">
        <button 
          @click="showAll = !showAll"
          class="rounded-md border-2 border-white bg-transparent px-8 py-3 font-bold text-white transition hover:bg-white hover:text-[#104C7D]"
        >
          {{ showAll ? 'See Less' : 'See More' }}
        </button>
      </div>

    </div>
  </section>
</template>