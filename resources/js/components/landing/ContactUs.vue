<script setup lang="ts">
import { ref } from 'vue';

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: ''
});

const submitForm = () => {
  console.log('Message sent:', form.value);
};
</script>

<template>
  <section id="contact" class="relative w-full text-white overflow-hidden">
    <img 
      src="/assets/front-page/BACKGROUND/Contact  Us.jpg" 
      alt="Contact Us Background" 
      class="absolute inset-0 w-full h-full object-cover z-0"
    />
    
    <div class="relative z-20 max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-12">
        
        <!-- Left Content: Increased text size and boldness -->
        <div class="flex flex-col justify-center space-y-10">
          <div>
            <h2 class="text-3xl sm:text-4xl text-gray-100 font-black tracking-wider uppercase drop-shadow-md">
              HDWSI Global Center
            </h2>
            <h1 class="text-4xl sm:text-5xl font-black mt-4 leading-tight drop-shadow-lg">
              Human-Centered Digital Wellness & Social Intelligence
            </h1>
          </div>

          <div class="space-y-8">
            <div class="flex items-center space-x-6">
              <div class="flex-shrink-0 bg-[#2095E0] p-4 rounded-xl shadow-lg">
                <img src="/assets/front-page/ICONS/Phone.png" alt="Phone Icon" class="h-10 w-10 sm:h-12 sm:w-12 object-contain" />
              </div>
              <div>
                <p class="text-2xl sm:text-3xl font-black drop-shadow-sm">Phone</p>
                <p class="text-lg sm:text-xl font-bold text-gray-200 mt-1 drop-shadow-sm">+63 45 963 2025</p>
              </div>
            </div>

            <div class="flex items-center space-x-6">
              <div class="flex-shrink-0 bg-[#289F7F] p-4 rounded-xl shadow-lg">
                <img src="/assets/front-page/ICONS/Email.png" alt="Email Icon" class="h-10 w-10 sm:h-12 sm:w-12 object-contain" />
              </div>
              <div>
                <p class="text-2xl sm:text-3xl font-black drop-shadow-sm">Email</p>
                <p class="text-lg sm:text-xl font-bold text-gray-200 mt-1 drop-shadow-sm">info@hdwsi.org</p>
              </div>
            </div>

            <div class="flex items-center space-x-6">
              <div class="flex-shrink-0 bg-[#A4C52F] p-4 rounded-xl shadow-lg">
                <img src="/assets/front-page/ICONS/Location.png" alt="Location Icon" class="h-10 w-10 sm:h-12 sm:w-12 object-contain" />
              </div>
              <div>
                <p class="text-2xl sm:text-3xl font-black drop-shadow-sm">Location</p>
                <p class="text-lg sm:text-xl font-bold text-gray-200 mt-1 leading-snug drop-shadow-sm">
                  Unit D, 2nd Floor Plaza Victoria Bldg.,<br class="hidden sm:block"> 
                  Sto. Domingo St, Angeles City 2009 Philippines
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-2xl border border-[#2095E0]">
          <form @submit.prevent="submitForm" class="space-y-6">
            <div>
              <label for="name" class="block text-sm font-bold text-gray-600 mb-1">Name</label>
              <input 
                type="text" 
                id="name" 
                v-model="form.name" 
                class="w-full rounded-md border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 focus:border-[#2095E0] focus:ring-[#2095E0] focus:outline-none transition-colors" 
                placeholder="John Doe"
                required
              >
            </div>

            <div>
              <label for="email" class="block text-sm font-bold text-gray-600 mb-1">Email</label>
              <input 
                type="email" 
                id="email" 
                v-model="form.email" 
                class="w-full rounded-md border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 focus:border-[#2095E0] focus:ring-[#2095E0] focus:outline-none transition-colors" 
                placeholder="john@example.com"
                required
              >
            </div>

            <div>
              <label for="subject" class="block text-sm font-bold text-gray-600 mb-1">Subject</label>
              <input 
                type="text" 
                id="subject" 
                v-model="form.subject" 
                class="w-full rounded-md border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 focus:border-[#2095E0] focus:ring-[#2095E0] focus:outline-none transition-colors" 
                placeholder="How can we help?"
                required
              >
            </div>

            <div>
              <label for="message" class="block text-sm font-bold text-gray-600 mb-1">Message</label>
              <textarea 
                id="message" 
                v-model="form.message" 
                rows="5" 
                class="w-full rounded-md border border-gray-300 bg-gray-50 px-4 py-3 text-gray-800 placeholder-gray-400 focus:border-[#2095E0] focus:ring-[#2095E0] focus:outline-none transition-colors resize-none" 
                placeholder="Your message here..."
                required
              ></textarea>
            </div>

            <div class="flex justify-center w-full pt-4">
              <button 
                type="submit" 
                class="rounded-lg bg-gradient-to-r from-[#2095E0] to-[#104C7D] px-14 py-4 text-xl font-extrabold text-white shadow-md hover:opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#2095E0] transition-all transform hover:scale-105"
              >
                Send Message
              </button>
            </div>
            
          </form>
        </div>

      </div>
    </div>
  </section>
</template>