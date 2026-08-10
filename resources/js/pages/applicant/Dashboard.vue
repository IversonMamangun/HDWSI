<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { AlertTriangle, CheckCircle2, Clock, XCircle } from '@lucide/vue';

import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Badge } from '@/components/ui/badge';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, User } from '@/types';

const props = defineProps<{
    applicant: User;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: 'My Application', href: '#' }];

const status = props.applicant.approved_at
    ? 'approved'
    : props.applicant.rejected_at
      ? 'rejected'
      : 'pending';
</script>

<template>
    <Head title="My Application" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4">
            <div>
                <h1 class="text-2xl font-semibold">My Application</h1>
                <p class="text-sm text-muted-foreground">
                    Track the status of your HDWSI admission application.
                </p>
            </div>

            <Card>
                <CardHeader>
                    <div class="flex items-center justify-between">
                        <CardTitle>Application status</CardTitle>
                        <Badge v-if="status === 'approved'" variant="default">
                            <CheckCircle2 class="mr-1 size-3.5" />
                            Approved
                        </Badge>
                        <Badge
                            v-else-if="status === 'rejected'"
                            variant="destructive"
                        >
                            <XCircle class="mr-1 size-3.5" />
                            Rejected
                        </Badge>
                        <Badge v-else variant="secondary">
                            <Clock class="mr-1 size-3.5" />
                            Pending review
                        </Badge>
                    </div>
                    <CardDescription v-if="status === 'approved'">
                        Approved on {{ applicant.approved_at }}. Welcome to
                        HDWSI!
                    </CardDescription>
                    <CardDescription v-else-if="status === 'rejected'">
                        Reviewed on {{ applicant.rejected_at }}.
                    </CardDescription>
                    <CardDescription v-else>
                        Your application is being reviewed by our admissions
                        team. We'll notify you once a decision has been made.
                    </CardDescription>
                </CardHeader>

                <CardContent v-if="status === 'rejected'">
                    <Alert variant="destructive">
                        <XCircle class="size-4" />
                        <AlertTitle>Reason</AlertTitle>
                        <AlertDescription>
                            {{ applicant.rejection_reason }}
                        </AlertDescription>
                    </Alert>
                </CardContent>
            </Card>

            <Alert
                v-if="
                    applicant.is_minor &&
                    !applicant.guardians?.some((g) => g.consented)
                "
            >
                <AlertTriangle class="size-4" />
                <AlertTitle>Guardian consent required</AlertTitle>
                <AlertDescription>
                    We've emailed your guardian a consent link. Your application
                    can't be reviewed until they confirm.
                </AlertDescription>
            </Alert>

            <Card>
                <CardHeader>
                    <CardTitle>Your details</CardTitle>
                </CardHeader>
                <CardContent class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <Label class="text-muted-foreground">Full name</Label>
                        <p>{{ applicant.full_name }}</p>
                    </div>
                    <div>
                        <Label class="text-muted-foreground">Email</Label>
                        <p>{{ applicant.email ?? '—' }}</p>
                    </div>
                    <div>
                        <Label class="text-muted-foreground">Phone</Label>
                        <p>{{ applicant.phone_number ?? '—' }}</p>
                    </div>
                    <div>
                        <Label class="text-muted-foreground"
                            >Date of birth</Label
                        >
                        <p>{{ applicant.date_of_birth }}</p>
                    </div>
                </CardContent>
            </Card>

            <Card v-if="applicant.is_minor">
                <CardHeader>
                    <CardTitle>Guardian</CardTitle>
                </CardHeader>
                <CardContent class="space-y-3">
                    <div
                        v-for="guardian in applicant.guardians"
                        :key="guardian.id"
                        class="flex items-center justify-between rounded-lg border p-3 text-sm"
                    >
                        <div>
                            <p class="font-medium">{{ guardian.name }}</p>
                            <p class="text-muted-foreground">
                                {{ guardian.relationship }} ·
                                {{ guardian.email }}
                            </p>
                        </div>
                        <Badge
                            :variant="
                                guardian.consented ? 'default' : 'secondary'
                            "
                        >
                            {{
                                guardian.consented
                                    ? 'Consented'
                                    : 'Awaiting consent'
                            }}
                        </Badge>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
