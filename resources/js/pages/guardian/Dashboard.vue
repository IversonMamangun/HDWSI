<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, User } from '@/types';

defineProps<{
    applicants: User[];
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: 'My Applicants', href: '#' }];
</script>

<template>
    <Head title="My Applicants" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 p-4">
            <h1 class="text-2xl font-semibold">My Applicants</h1>

            <Card v-for="applicant in applicants" :key="applicant.id">
                <CardHeader class="flex-row items-center justify-between">
                    <CardTitle>{{ applicant.full_name }}</CardTitle>
                    <Badge
                        :variant="
                            applicant.approved_at
                                ? 'default'
                                : applicant.rejected_at
                                  ? 'destructive'
                                  : 'secondary'
                        "
                    >
                        {{
                            applicant.approved_at
                                ? 'Approved'
                                : applicant.rejected_at
                                  ? 'Rejected'
                                  : 'Pending'
                        }}
                    </Badge>
                </CardHeader>
                <CardContent class="text-sm text-muted-foreground">
                    {{ applicant.email ?? applicant.phone_number }}
                </CardContent>
            </Card>

            <p v-if="!applicants.length" class="text-sm text-muted-foreground">
                No linked applicants yet.
            </p>
        </div>
    </AppLayout>
</template>
