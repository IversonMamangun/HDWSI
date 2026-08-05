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
  <section class="relative w-full text-white overflow-hidden">
    <img 
      src="assets/front-page/BACKGROUND/Contact  Us.jpg" 
      alt="Contact Us Background" 
      class="absolute inset-0 w-full h-full object-cover z-0"
    />
    
    <!-- <div class="absolute inset-0 bg-black/60 z-10"></div> -->

    <div class="relative z-20 max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <div class="flex flex-col justify-center space-y-8">
          <div>
            <h2 class="text-xl text-gray-300 uppercase tracking-wide">HDWSI Global Center</h2>
            <h1 class="text-3xl font-bold mt-2">Human-Centered Digital Wellness & Social Intelligence</h1>
          </div>

          <div class="space-y-6">
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <img src="assets/front-page/ICONS/Phone.png" alt="Phone Icon" class="h-6 w-6 object-contain" />
              </div>
              <div>
                <p class="text-lg font-medium">Phone</p>
                <p class="text-gray-300">+63 123 456 7890</p>
              </div>
            </div>

            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <img src="assets/front-page/ICONS/Email.png" alt="Email Icon" class="h-6 w-6 object-contain" />
              </div>
              <div>
                <p class="text-lg font-medium">Email</p>
                <p class="text-gray-300">contact@hdwsi.org</p>
              </div>
            </div>

            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <img src="assets/front-page/ICONS/Location.png" alt="Location Icon" class="h-6 w-6 object-contain" />
              </div>
              <div>
                <p class="text-lg font-medium">Location</p>
                <p class="text-gray-300">Global Center, Main Street, City</p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white/10 backdrop-blur-md p-8 rounded-xl shadow-lg border border-white/20">
          <form @submit.prevent="submitForm" class="space-y-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-200">Name</label>
              <input 
                type="text" 
                id="name" 
                v-model="form.name" 
                class="mt-1 w-full rounded-md border border-gray-500 bg-white/5 px-4 py-2 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500" 
                placeholder="John Doe"
                required
              >
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
              <input 
                type="email" 
                id="email" 
                v-model="form.email" 
                class="mt-1 w-full rounded-md border border-gray-500 bg-white/5 px-4 py-2 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500" 
                placeholder="john@example.com"
                required
              >
            </div>

            <div>
              <label for="subject" class="block text-sm font-medium text-gray-200">Subject</label>
              <input 
                type="text" 
                id="subject" 
                v-model="form.subject" 
                class="mt-1 w-full rounded-md border border-gray-500 bg-white/5 px-4 py-2 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500" 
                placeholder="How can we help?"
                required
              >
            </div>

            <div>
              <label for="message" class="block text-sm font-medium text-gray-200">Message</label>
              <textarea 
                id="message" 
                v-model="form.message" 
                rows="4" 
                class="mt-1 w-full rounded-md border border-gray-500 bg-white/5 px-4 py-2 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-blue-500" 
                placeholder="Your message here..."
                required
              ></textarea>
            </div>

            <button 
              type="submit" 
              class="w-full rounded-md bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors"
            >
              Send Message
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>
</template>