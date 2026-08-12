<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

const props = defineProps<Props>();
</script>

<template>
    <img
        src="/assets/registration/registration_logo.png"
        alt="HDWSI"
        :class="
            cn('mx-auto h-16 w-auto max-w-full object-contain', props.className)
        "
        v-bind="$attrs"
    />
</template>
