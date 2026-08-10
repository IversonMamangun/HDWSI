<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { Calendar, Mail, Phone, ShieldCheck, User } from '@lucide/vue';

import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Separator } from '@/components/ui/separator';
import { store } from '@/routes/guardian/consent';
import type { User as UserType } from '@/types';

const props = defineProps<{
    applicant: UserType;
}>();

const form = useForm({});

function submit() {
    form.post(store(props.applicant.id).url);
}
</script>

<template>
    <Head title="Guardian Consent" />

    <div class="flex min-h-screen items-center justify-center bg-muted/40 px-4">
        <Card class="w-full max-w-lg">
            <CardHeader>
                <div class="flex items-center gap-2">
                    <ShieldCheck class="h-5 w-5 text-primary" />
                    <CardTitle>Guardian Consent Required</CardTitle>
                </div>
                <CardDescription>
                    Review the applicant's details below before giving consent
                    for their HDWSI admission application.
                </CardDescription>
            </CardHeader>

            <CardContent class="space-y-4">
                <div class="space-y-3 rounded-lg border p-4">
                    <div class="flex items-center gap-3 text-sm">
                        <User class="h-4 w-4 text-muted-foreground" />
                        <span class="font-medium">{{
                            applicant.full_name
                        }}</span>
                    </div>

                    <div
                        v-if="applicant.email"
                        class="flex items-center gap-3 text-sm"
                    >
                        <Mail class="h-4 w-4 text-muted-foreground" />
                        <span>{{ applicant.email }}</span>
                    </div>

                    <div
                        v-if="applicant.phone_number"
                        class="flex items-center gap-3 text-sm"
                    >
                        <Phone class="h-4 w-4 text-muted-foreground" />
                        <span>{{ applicant.phone_number }}</span>
                    </div>

                    <div
                        v-if="applicant.date_of_birth"
                        class="flex items-center gap-3 text-sm"
                    >
                        <Calendar class="h-4 w-4 text-muted-foreground" />
                        <span>{{ applicant.date_of_birth }}</span>
                    </div>
                </div>

                <Separator />

                <Alert>
                    <ShieldCheck class="h-4 w-4" />
                    <AlertTitle>What consenting means</AlertTitle>
                    <AlertDescription>
                        By giving consent, you confirm you are this applicant's
                        parent or legal guardian and authorize them to submit an
                        admission application to HDWSI.
                    </AlertDescription>
                </Alert>
            </CardContent>

            <CardFooter class="flex justify-end gap-2">
                <Button :disabled="form.processing" @click="submit">
                    {{
                        form.processing
                            ? 'Recording consent...'
                            : 'Give Consent'
                    }}
                </Button>
            </CardFooter>
        </Card>
    </div>
</template>
