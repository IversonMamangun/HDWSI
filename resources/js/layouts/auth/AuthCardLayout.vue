<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AuthAppLogoIcon from '@/components/AuthAppLogoIcon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { home } from '@/routes';

withDefaults(
    defineProps<{
        title?: string;
        description?: string;
        maxWidth?: 'sm' | 'md' | 'lg' | 'xl';
    }>(),
    {
        maxWidth: 'sm',
    },
);

const maxWidthClass = {
    sm: 'max-w-sm',
    md: 'max-w-md',
    lg: 'max-w-lg',
    xl: 'max-w-xl',
};
</script>

<template>
    <div
        class="relative flex min-h-svh flex-col items-center justify-center overflow-hidden bg-hdwsi-blue p-6 md:p-10"
    >
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="
                background-image: url('/assets/registration/auth_background2.jpg');
            "
        />
        <div class="absolute inset-0 bg-hdwsi-blue/80" />

        <div
            class="relative z-10 flex w-full flex-col gap-6"
            :class="maxWidthClass[maxWidth]"
        >
            <Card class="overflow-hidden rounded-xl p-0 shadow-2xl">
                <Link
                    :href="home()"
                    class="flex w-full items-center justify-center px-8 py-2"
                >
                    <AuthAppLogoIcon class="h-16" />
                </Link>

                <CardHeader
                    class="gap-0 bg-hdwsi-blue px-8 py-2.5 text-center text-white"
                >
                    <CardTitle class="text-lg font-bold">
                        {{ title }}
                    </CardTitle>
                    <CardDescription v-if="description" class="text-white/90">
                        {{ description }}
                    </CardDescription>
                </CardHeader>

                <CardContent class="px-8 py-6">
                    <slot />
                </CardContent>
            </Card>
        </div>
    </div>
</template>
