<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { CheckCircle2, XCircle } from '@lucide/vue';
import { computed, ref } from 'vue';

import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';

import { approve, reject } from '@/routes/admin/applicants';
import { index as applicantsIndex } from '@/routes/admin/applicants';
import type { BreadcrumbItem, User } from '@/types';
import { Textarea } from '@/components/ui/textarea';

const props = defineProps<{
    applicant: User;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Applicants', href: applicantsIndex() },
    { title: props.applicant.full_name, href: '#' },
];

const rejectDialogOpen = ref(false);

const approveForm = useForm({});
const rejectForm = useForm({
    reason: '',
});

function submitApprove() {
    approveForm.post(approve(props.applicant.id).url);
}

function submitReject() {
    rejectForm.post(reject(props.applicant.id).url, {
        onSuccess: () => {
            rejectDialogOpen.value = false;
        },
    });
}

const isBlockedByConsent = computed(() => {
    if (!props.applicant.is_minor) return false;
    return !props.applicant.guardians?.some((g) => g.consented);
});
</script>

<template>
    <Head :title="applicant.full_name" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">
                        {{ applicant.full_name }}
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Application #{{ applicant.id }}
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <Badge v-if="applicant.approved_at" variant="default">
                        Approved {{ applicant.approved_at }}
                    </Badge>
                    <Badge
                        v-else-if="applicant.rejected_at"
                        variant="destructive"
                    >
                        Rejected {{ applicant.rejected_at }}
                    </Badge>
                    <Badge v-else variant="secondary">Pending</Badge>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="space-y-6 lg:col-span-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>Personal information</CardTitle>
                        </CardHeader>
                        <CardContent class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <Label class="text-muted-foreground"
                                    >Email</Label
                                >
                                <p>{{ applicant.email ?? '—' }}</p>
                            </div>
                            <div>
                                <Label class="text-muted-foreground"
                                    >Phone</Label
                                >
                                <p>{{ applicant.phone_number ?? '—' }}</p>
                            </div>
                            <div>
                                <Label class="text-muted-foreground"
                                    >Date of birth</Label
                                >
                                <p>
                                    {{ applicant.date_of_birth }}
                                    <Badge
                                        v-if="applicant.is_minor"
                                        variant="outline"
                                        class="ml-2"
                                    >
                                        Minor
                                    </Badge>
                                </p>
                            </div>
                            <div>
                                <Label class="text-muted-foreground"
                                    >Address</Label
                                >
                                <p>{{ applicant.address ?? '—' }}</p>
                            </div>
                        </CardContent>
                    </Card>

                    <Card v-if="applicant.can?.view">
                        <CardHeader>
                            <CardTitle>Identity verification</CardTitle>
                            <CardDescription v-if="applicant.is_minor">
                                ID is optional for minors.
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <Label class="text-muted-foreground"
                                    >ID type</Label
                                >
                                <p>{{ applicant.id_type ?? '—' }}</p>
                            </div>
                            <div>
                                <Label class="text-muted-foreground"
                                    >ID number</Label
                                >
                                <p>{{ applicant.id_number ?? '—' }}</p>
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
                                    <p class="font-medium">
                                        {{ guardian.name }}
                                    </p>
                                    <p class="text-muted-foreground">
                                        {{ guardian.relationship }} ·
                                        {{ guardian.email }}
                                    </p>
                                </div>
                                <Badge
                                    :variant="
                                        guardian.consented
                                            ? 'default'
                                            : 'secondary'
                                    "
                                >
                                    {{
                                        guardian.consented
                                            ? `Consented ${guardian.consent_given_at}`
                                            : 'Awaiting consent'
                                    }}
                                </Badge>
                            </div>

                            <p
                                v-if="!applicant.guardians?.length"
                                class="text-sm text-muted-foreground"
                            >
                                No guardian linked yet.
                            </p>
                        </CardContent>
                    </Card>

                    <Card v-if="applicant.rejected_at">
                        <CardHeader>
                            <CardTitle class="text-destructive"
                                >Rejection reason</CardTitle
                            >
                        </CardHeader>
                        <CardContent>
                            <p class="text-sm">
                                {{ applicant.rejection_reason }}
                            </p>
                        </CardContent>
                    </Card>
                </div>

                <div class="space-y-4">
                    <Card>
                        <CardHeader>
                            <CardTitle>Decision</CardTitle>
                        </CardHeader>
                        <CardContent class="flex flex-col gap-2">
                            <Button
                                v-if="
                                    applicant.can?.approve &&
                                    !applicant.approved_at
                                "
                                :disabled="
                                    approveForm.processing || isBlockedByConsent
                                "
                                @click="submitApprove"
                            >
                                <CheckCircle2 class="mr-2 size-4" />
                                Approve applicant
                            </Button>

                            <Button
                                v-if="
                                    applicant.can?.reject &&
                                    !applicant.rejected_at
                                "
                                variant="outline"
                                class="text-destructive"
                                :disabled="rejectForm.processing"
                                @click="rejectDialogOpen = true"
                            >
                                <XCircle class="mr-2 size-4" />
                                Reject applicant
                            </Button>

                            <p
                                v-if="isBlockedByConsent"
                                class="text-xs text-muted-foreground"
                            >
                                Approval is blocked until the guardian gives
                                consent.
                            </p>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>

        <Dialog v-model:open="rejectDialogOpen">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Reject applicant</DialogTitle>
                    <DialogDescription>
                        Provide a reason. This will be recorded on the
                        applicant's record.
                    </DialogDescription>
                </DialogHeader>

                <div class="grid gap-2">
                    <Label for="reason">Reason</Label>
                    <Textarea
                        id="reason"
                        v-model="rejectForm.reason"
                        rows="4"
                        placeholder="e.g. Incomplete documentation"
                    />
                </div>

                <DialogFooter>
                    <Button variant="outline" @click="rejectDialogOpen = false">
                        Cancel
                    </Button>
                    <Button
                        variant="destructive"
                        :disabled="rejectForm.processing"
                        @click="submitReject"
                    >
                        Confirm rejection
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
