<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { Eye, EyeOff, Lock, Mail } from 'lucide-vue-next';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth/AuthCardLayout.vue';
import { register } from '@/routes';
import { home } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();

const showPassword = ref(false);
</script>

<template>
    <AuthLayout title="Account Login">
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-4"
        >
            <div class="grid gap-1.5">
                <Label
                    for="email"
                    class="text-sm font-semibold text-hdwsi-blue"
                >
                    Email address or Phone Number
                </Label>
                <div class="relative">
                    <Mail
                        class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-hdwsi-blue"
                    />
                    <Input
                        id="email"
                        type="text"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="Email or Phone Number"
                        class="h-11 pl-10"
                    />
                </div>
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-1.5">
                <Label
                    for="password"
                    class="text-sm font-semibold text-hdwsi-blue"
                >
                    Password
                </Label>
                <div class="relative">
                    <Lock
                        class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-hdwsi-blue"
                    />
                    <Input
                        id="password"
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                        class="h-11 px-10"
                    />
                    <button
                        type="button"
                        tabindex="-1"
                        class="absolute top-1/2 right-3 -translate-y-1/2 text-muted-foreground hover:text-hdwsi-blue"
                        @click="showPassword = !showPassword"
                    >
                        <EyeOff v-if="showPassword" class="size-4" />
                        <Eye v-else class="size-4" />
                    </button>
                </div>
                <InputError :message="errors.password" />
            </div>

            <div class="flex items-center justify-between pt-1">
                <Label
                    for="remember"
                    class="flex items-center gap-2 text-sm font-normal"
                >
                    <Checkbox id="remember" name="remember" :tabindex="3" />
                    <span>Remember me</span>
                </Label>

                <TextLink
                    v-if="canResetPassword"
                    :href="request()"
                    :tabindex="6"
                    class="text-sm"
                >
                    Forget Password?
                </TextLink>
            </div>

            <Button
                type="submit"
                :tabindex="4"
                :disabled="processing"
                class="h-11 w-full bg-hdwsi-blue font-bold tracking-wide uppercase hover:bg-hdwsi-blue/90"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                Log In
            </Button>

            <Button
                as-child
                :tabindex="5"
                class="h-11 w-full bg-emerald-600 font-bold tracking-wide text-white uppercase hover:bg-emerald-600/90"
            >
                <Link :href="home()">Return Home</Link>
            </Button>

            <div
                class="text-center text-sm text-muted-foreground"
                v-if="canRegister"
            >
                Don't have an account?
                <TextLink :href="register()" :tabindex="7">
                    Register Here
                </TextLink>
            </div>
        </Form>
    </AuthLayout>
</template>
