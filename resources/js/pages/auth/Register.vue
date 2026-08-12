<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {
    DateFormatter,
    getLocalTimeZone,
    parseDate,
    today,
} from '@internationalized/date';
import type { CalendarDate } from '@internationalized/date';
import { CalendarIcon, FileTextIcon, XIcon, UploadIcon } from '@lucide/vue';
import { computed, ref, watch } from 'vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import {
    Attachment,
    AttachmentAction,
    AttachmentActions,
    AttachmentContent,
    AttachmentDescription,
    AttachmentMedia,
    AttachmentTitle,
} from '@/components/ui/attachment';
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth/AuthCardLayout.vue';
import { cn } from '@/lib/utils';
import { login } from '@/routes';
import { store } from '@/routes/register';

interface EnumOption {
    value: string;
    label: string;
}

defineProps<{
    idTypes: EnumOption[];
}>();

const page = usePage();

const baseSteps = [
    {
        label: 'Personal info',
        shortLabel: 'Personal',
        fields: [
            'first_name',
            'middle_name',
            'last_name',
            'email',
            'phone_number',
            'date_of_birth',
        ],
    },
    {
        label: 'Address',
        shortLabel: 'Address',
        fields: ['address'],
    },
    {
        label: 'Identity verification',
        shortLabel: 'Identity',
        fields: ['id_type', 'id_number'],
    },
    {
        label: 'Guardian details',
        shortLabel: 'Guardian',
        fields: [
            'guardian_email',
            'guardian_first_name',
            'guardian_last_name',
            'guardian_relationship',
        ],
    },
    {
        label: 'Security',
        shortLabel: 'Security',
        fields: ['password', 'password_confirmation'],
    },
] as const;

const form = useForm({
    first_name: '',
    middle_name: '',
    last_name: '',
    email: '',
    phone_number: '',
    date_of_birth: '',
    address: '',
    id_type: '',
    id_number: '',
    id_document: null as File | null,
    guardian_email: '',
    guardian_first_name: '',
    guardian_last_name: '',
    guardian_relationship: '',
    password: '',
    password_confirmation: '',
}).withPrecognition('post', '/register/validate');

// Date of birth handling
const df = new DateFormatter('en-US', { dateStyle: 'long' });
const maxDate = today(getLocalTimeZone());
const defaultPlaceholder = maxDate.subtract({ years: 14 });
const dateValue = computed({
    get: () => (form.date_of_birth ? parseDate(form.date_of_birth) : undefined),
    set: (value: CalendarDate | undefined) => {
        form.date_of_birth = value ? value.toString() : '';
        form.validate('date_of_birth');
    },
});
const age = computed(() => {
    if (!form.date_of_birth) return '';
    const dob = new Date(form.date_of_birth);
    if (Number.isNaN(dob.getTime())) return '';

    const now = new Date();
    let years = now.getFullYear() - dob.getFullYear();
    const hasHadBirthdayThisYear =
        now.getMonth() > dob.getMonth() ||
        (now.getMonth() === dob.getMonth() && now.getDate() >= dob.getDate());
    if (!hasHadBirthdayThisYear) years -= 1;

    return years >= 0 ? String(years) : '';
});

const isMinor = computed(() => age.value !== '' && Number(age.value) < 18);

// Steps list adapts to whether a guardian step is needed
const steps = computed(() =>
    isMinor.value
        ? baseSteps
        : baseSteps.filter((s) => s.label !== 'Guardian details'),
);

// Resolve each section's index dynamically instead of hardcoding numbers,
// since Guardian's presence shifts every index after it.
const personalStepIndex = computed(() =>
    steps.value.findIndex((s) => s.label === 'Personal info'),
);
const addressStepIndex = computed(() =>
    steps.value.findIndex((s) => s.label === 'Address'),
);
const identityStepIndex = computed(() =>
    steps.value.findIndex((s) => s.label === 'Identity verification'),
);
const guardianStepIndex = computed(() =>
    steps.value.findIndex((s) => s.label === 'Guardian details'),
);
const securityStepIndex = computed(() =>
    steps.value.findIndex((s) => s.label === 'Security'),
);

// If minor status flips, clear fields that no longer apply so stale
// data never travels with the submission.
watch(isMinor, (nowMinor, wasMinor) => {
    if (nowMinor === wasMinor) return;

    if (nowMinor) {
        // became a minor — adult-only ID fields no longer required/relevant
        form.id_type = '';
        form.id_number = '';
    } else {
        // became an adult — guardian fields no longer relevant
        form.guardian_email = '';
        form.guardian_first_name = '';
        form.guardian_last_name = '';
        form.guardian_relationship = '';
    }

    // Also drop the currentStep back to a valid index for the new step list,
    // in case the user was sitting on a step index that just shifted.
    if (currentStep.value >= steps.value.length) {
        currentStep.value = steps.value.length - 1;
    }
});

function initialStepFromErrors(): number {
    const erroredFields = Object.keys(page.props.errors ?? {});

    if (erroredFields.length === 0) {
        return 0;
    }

    const stepIndex = steps.value.findIndex((step) =>
        step.fields.some((field) => erroredFields.includes(field)),
    );

    return stepIndex === -1 ? 0 : stepIndex;
}

const currentStep = ref(initialStepFromErrors());
const isLastStep = computed(() => currentStep.value === steps.value.length - 1);

const showValidatingSpinner = ref(false);

function next() {
    showValidatingSpinner.value = true;

    form.validate({
        only: steps.value[currentStep.value].fields,
        onSuccess: () => (currentStep.value += 1),
        onFinish: () => {
            showValidatingSpinner.value = false;
        },
    });
}

function submit() {
    form.post(store().url, {
        onSuccess: () => form.reset('password', 'password_confirmation'),
        onError: (errors) => {
            const erroredFields = Object.keys(errors);
            const stepIndex = steps.value.findIndex((step) =>
                step.fields.some((field) => erroredFields.includes(field)),
            );

            if (stepIndex !== -1) {
                currentStep.value = stepIndex;
            }
        },
    });
}

const idDocumentInput = ref<HTMLInputElement | null>(null);

function selectIdDocument() {
    idDocumentInput.value?.click();
}

function onIdDocumentChange(e: Event) {
    const file = (e.target as HTMLInputElement).files?.[0] ?? null;
    form.id_document = file;
    if (file) {
        form.validate('id_document');
    }
}

function removeIdDocument() {
    form.id_document = null;
    if (idDocumentInput.value) idDocumentInput.value.value = '';
}

function formatFileSize(bytes: number): string {
    if (bytes < 1024) return `${bytes} B`;
    if (bytes < 1024 * 1024) return `${(bytes / 1024).toFixed(0)} KB`;
    return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
}

const idDocumentMeta = computed(() => {
    if (!form.id_document) return '';
    const ext = form.id_document.name.split('.').pop()?.toUpperCase() ?? '';
    return `${ext} · ${formatFileSize(form.id_document.size)}`;
});
</script>

<template>
    <AuthLayout
        title="Create an Account"
        description="Enter your details below to create your account"
        max-width="md"
    >
        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <!-- Step indicator -->
            <div class="flex items-start gap-1 sm:gap-2">
                <template v-for="(step, index) in steps" :key="step.label">
                    <div class="flex min-w-0 flex-col items-center gap-1.5">
                        <div
                            class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-medium"
                            :class="
                                index <= currentStep
                                    ? 'bg-hdwsi-blue text-white'
                                    : 'bg-muted text-muted-foreground'
                            "
                        >
                            {{ index + 1 }}
                        </div>
                        <span
                            class="max-w-18 truncate text-center text-[11px] leading-tight sm:max-w-none sm:text-xs sm:whitespace-nowrap"
                            :class="
                                index === currentStep
                                    ? 'font-semibold text-hdwsi-blue'
                                    : 'text-muted-foreground'
                            "
                        >
                            <span class="sm:hidden">{{ step.shortLabel }}</span>
                            <span class="hidden sm:inline">{{
                                step.label
                            }}</span>
                        </span>
                    </div>
                    <div
                        v-if="index < steps.length - 1"
                        class="mt-3 h-px flex-1"
                        :class="
                            index < currentStep ? 'bg-hdwsi-blue' : 'bg-muted'
                        "
                    />
                </template>
            </div>

            <div class="grid gap-6">
                <!-- Step: Personal info -->
                <div
                    v-show="currentStep === personalStepIndex"
                    class="grid gap-5"
                >
                    <div class="grid gap-1.5">
                        <Label
                            for="first_name"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            First name
                        </Label>
                        <Input
                            id="first_name"
                            v-model="form.first_name"
                            type="text"
                            required
                            autofocus
                            autocomplete="given-name"
                            placeholder="Juan"
                            class="h-11"
                            :aria-invalid="form.invalid('first_name')"
                            @blur="form.validate('first_name')"
                        />
                        <InputError
                            v-if="form.invalid('first_name')"
                            :message="form.errors.first_name"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="middle_name"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Middle name
                        </Label>
                        <Input
                            id="middle_name"
                            v-model="form.middle_name"
                            type="text"
                            autocomplete="additional-name"
                            placeholder="Santos"
                            class="h-11"
                            :aria-invalid="form.invalid('middle_name')"
                            @blur="form.validate('middle_name')"
                        />
                        <InputError
                            v-if="form.invalid('middle_name')"
                            :message="form.errors.middle_name"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="last_name"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Last name
                        </Label>
                        <Input
                            id="last_name"
                            v-model="form.last_name"
                            type="text"
                            required
                            autocomplete="family-name"
                            placeholder="Dela Cruz"
                            class="h-11"
                            :aria-invalid="form.invalid('last_name')"
                            @blur="form.validate('last_name')"
                        />
                        <InputError
                            v-if="form.invalid('last_name')"
                            :message="form.errors.last_name"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="email"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Email address
                        </Label>
                        <Input
                            id="email"
                            v-model="form.email"
                            type="email"
                            autocomplete="email"
                            placeholder="email@example.com"
                            class="h-11"
                            :aria-invalid="form.invalid('email')"
                            @blur="form.validate('email')"
                        />
                        <InputError
                            v-if="form.invalid('email')"
                            :message="form.errors.email"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="phone_number"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Phone number
                        </Label>
                        <Input
                            id="phone_number"
                            v-model="form.phone_number"
                            type="tel"
                            autocomplete="tel"
                            placeholder="09XX XXX XXXX"
                            class="h-11"
                            :aria-invalid="form.invalid('phone_number')"
                            @blur="form.validate('phone_number')"
                        />
                        <InputError
                            v-if="form.invalid('phone_number')"
                            :message="form.errors.phone_number"
                        />
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-[1fr_auto]">
                        <div class="grid gap-1.5">
                            <Label
                                for="date_of_birth"
                                class="text-sm font-semibold text-hdwsi-blue"
                            >
                                Date of birth
                            </Label>
                            <Popover v-slot="{ close }">
                                <PopoverTrigger as-child>
                                    <Button
                                        id="date_of_birth"
                                        type="button"
                                        variant="outline"
                                        :class="
                                            cn(
                                                'h-11 w-full justify-start text-left font-normal',
                                                !dateValue &&
                                                    'text-muted-foreground',
                                            )
                                        "
                                        :aria-invalid="
                                            form.invalid('date_of_birth')
                                        "
                                    >
                                        <CalendarIcon class="mr-2 h-4 w-4" />
                                        {{
                                            dateValue
                                                ? df.format(
                                                      dateValue.toDate(
                                                          getLocalTimeZone(),
                                                      ),
                                                  )
                                                : 'Pick a date'
                                        }}
                                    </Button>
                                </PopoverTrigger>
                                <PopoverContent
                                    class="w-auto p-0"
                                    align="start"
                                >
                                    <Calendar
                                        v-model="dateValue"
                                        :default-placeholder="
                                            defaultPlaceholder
                                        "
                                        :max-value="maxDate"
                                        layout="month-and-year"
                                        initial-focus
                                        @update:model-value="close"
                                    />
                                </PopoverContent>
                            </Popover>
                            <InputError
                                v-if="form.invalid('date_of_birth')"
                                :message="form.errors.date_of_birth"
                            />
                        </div>

                        <div class="grid gap-1.5">
                            <Label
                                for="age"
                                class="text-sm font-semibold text-hdwsi-blue"
                            >
                                Age
                            </Label>
                            <Input
                                id="age"
                                :model-value="age"
                                type="text"
                                readonly
                                disabled
                                placeholder="—"
                                class="h-11 sm:w-20"
                            />
                        </div>
                    </div>

                    <p v-if="isMinor" class="text-sm text-muted-foreground">
                        Since you're under 18, we'll also ask for a parent or
                        guardian's details later in this form.
                    </p>
                </div>

                <!-- Step: Address -->
                <div
                    v-show="currentStep === addressStepIndex"
                    class="grid gap-5"
                >
                    <div class="grid gap-1.5">
                        <Label
                            for="address"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Home address
                        </Label>
                        <Input
                            id="address"
                            v-model="form.address"
                            type="text"
                            required
                            autocomplete="street-address"
                            placeholder="House no., street, barangay, city/municipality"
                            class="h-11"
                            :aria-invalid="form.invalid('address')"
                            @blur="form.validate('address')"
                        />
                        <InputError
                            v-if="form.invalid('address')"
                            :message="form.errors.address"
                        />
                    </div>
                </div>

                <!-- Step: Identity verification -->
                <div
                    v-show="currentStep === identityStepIndex"
                    class="grid gap-5"
                >
                    <div class="grid gap-1.5">
                        <Label
                            for="id_type"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Government ID type
                            <span
                                v-if="isMinor"
                                class="font-normal text-muted-foreground"
                                >(optional)</span
                            >
                        </Label>
                        <Select
                            v-model="form.id_type"
                            :required="!isMinor"
                            @update:model-value="form.validate('id_type')"
                        >
                            <SelectTrigger
                                id="id_type"
                                class="h-11 w-full"
                                :aria-invalid="form.invalid('id_type')"
                            >
                                <SelectValue placeholder="Select ID type" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem
                                    v-for="option in idTypes"
                                    :key="option.value"
                                    :value="option.value"
                                >
                                    {{ option.label }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError
                            v-if="form.invalid('id_type')"
                            :message="form.errors.id_type"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="id_number"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            ID number
                        </Label>
                        <Input
                            id="id_number"
                            v-model="form.id_number"
                            type="text"
                            :required="!isMinor && !!form.id_type"
                            placeholder="Enter ID number"
                            class="h-11"
                            :aria-invalid="form.invalid('id_number')"
                            @blur="form.validate('id_number')"
                        />
                        <InputError
                            v-if="form.invalid('id_number')"
                            :message="form.errors.id_number"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="id_document"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Upload a photo or scan of your ID
                            <span
                                v-if="isMinor"
                                class="font-normal text-muted-foreground"
                                >(optional)</span
                            >
                        </Label>

                        <input
                            id="id_document"
                            ref="idDocumentInput"
                            type="file"
                            accept="image/jpeg,image/png,application/pdf"
                            class="hidden"
                            @change="onIdDocumentChange"
                        />

                        <button
                            v-if="!form.id_document"
                            type="button"
                            class="flex flex-col items-center justify-center gap-2 rounded-lg border border-dashed p-6 text-sm text-muted-foreground hover:border-hdwsi-blue hover:bg-hdwsi-blue/5 hover:text-hdwsi-blue"
                            :aria-invalid="form.invalid('id_document')"
                            @click="selectIdDocument"
                        >
                            <UploadIcon class="h-5 w-5" />
                            Click to select a file (JPG, PNG, or PDF, max 5MB)
                        </button>

                        <Attachment
                            v-else
                            :state="form.progress ? 'uploading' : 'idle'"
                            class="w-full"
                        >
                            <AttachmentMedia>
                                <FileTextIcon />
                            </AttachmentMedia>
                            <AttachmentContent>
                                <AttachmentTitle>{{
                                    form.id_document.name
                                }}</AttachmentTitle>
                                <AttachmentDescription>
                                    {{
                                        form.progress
                                            ? `Uploading · ${form.progress.percentage}%`
                                            : idDocumentMeta
                                    }}
                                </AttachmentDescription>
                            </AttachmentContent>
                            <AttachmentActions>
                                <AttachmentAction
                                    aria-label="Remove selected ID document"
                                    @click="removeIdDocument"
                                >
                                    <XIcon />
                                </AttachmentAction>
                            </AttachmentActions>
                        </Attachment>

                        <InputError
                            v-if="form.invalid('id_document')"
                            :message="form.errors.id_document"
                        />
                    </div>
                </div>

                <!-- Step: Guardian details (minors only) -->
                <div
                    v-if="isMinor"
                    v-show="currentStep === guardianStepIndex"
                    class="grid gap-5"
                >
                    <p class="text-sm text-muted-foreground">
                        Since you're under 18, we need a parent or legal
                        guardian's consent before your application can be
                        submitted.
                    </p>

                    <div class="grid gap-1.5">
                        <Label
                            for="guardian_first_name"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Guardian first name
                        </Label>
                        <Input
                            id="guardian_first_name"
                            v-model="form.guardian_first_name"
                            type="text"
                            required
                            class="h-11"
                            :aria-invalid="form.invalid('guardian_first_name')"
                            @blur="form.validate('guardian_first_name')"
                        />
                        <InputError
                            v-if="form.invalid('guardian_first_name')"
                            :message="form.errors.guardian_first_name"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="guardian_last_name"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Guardian last name
                        </Label>
                        <Input
                            id="guardian_last_name"
                            v-model="form.guardian_last_name"
                            type="text"
                            required
                            class="h-11"
                            :aria-invalid="form.invalid('guardian_last_name')"
                            @blur="form.validate('guardian_last_name')"
                        />
                        <InputError
                            v-if="form.invalid('guardian_last_name')"
                            :message="form.errors.guardian_last_name"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="guardian_email"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Guardian email
                        </Label>
                        <Input
                            id="guardian_email"
                            v-model="form.guardian_email"
                            type="email"
                            required
                            placeholder="guardian@example.com"
                            class="h-11"
                            :aria-invalid="form.invalid('guardian_email')"
                            @blur="form.validate('guardian_email')"
                        />
                        <InputError
                            v-if="form.invalid('guardian_email')"
                            :message="form.errors.guardian_email"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="guardian_relationship"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Relationship to applicant
                        </Label>
                        <Input
                            id="guardian_relationship"
                            v-model="form.guardian_relationship"
                            type="text"
                            required
                            placeholder="Mother, Father, Legal guardian, etc."
                            class="h-11"
                            :aria-invalid="
                                form.invalid('guardian_relationship')
                            "
                            @blur="form.validate('guardian_relationship')"
                        />
                        <InputError
                            v-if="form.invalid('guardian_relationship')"
                            :message="form.errors.guardian_relationship"
                        />
                    </div>
                </div>

                <!-- Step: Security -->
                <div
                    v-show="currentStep === securityStepIndex"
                    class="grid gap-5"
                >
                    <div class="grid gap-1.5">
                        <Label
                            for="password"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Password
                        </Label>
                        <PasswordInput
                            id="password"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            class="h-11"
                            :aria-invalid="form.invalid('password')"
                            @blur="form.validate('password')"
                        />
                        <InputError
                            v-if="form.invalid('password')"
                            :message="form.errors.password"
                        />
                    </div>

                    <div class="grid gap-1.5">
                        <Label
                            for="password_confirmation"
                            class="text-sm font-semibold text-hdwsi-blue"
                        >
                            Confirm password
                        </Label>
                        <PasswordInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            class="h-11"
                            :aria-invalid="
                                form.invalid('password_confirmation')
                            "
                            @blur="form.validate('password_confirmation')"
                        />
                        <InputError
                            v-if="form.invalid('password_confirmation')"
                            :message="form.errors.password_confirmation"
                        />
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex flex-col gap-3 sm:flex-row">
                    <Button
                        v-if="currentStep > 0"
                        type="button"
                        variant="outline"
                        class="h-11 w-full border-hdwsi-blue text-hdwsi-blue uppercase hover:bg-hdwsi-blue/5 sm:flex-1"
                        @click="currentStep -= 1"
                    >
                        Back
                    </Button>

                    <Button
                        v-if="!isLastStep"
                        type="button"
                        class="h-11 w-full bg-hdwsi-blue font-bold tracking-wide uppercase hover:bg-hdwsi-blue/90 sm:flex-1"
                        :disabled="form.validating"
                        @click="next"
                    >
                        <Spinner v-if="showValidatingSpinner" />
                        Next
                    </Button>

                    <Button
                        v-else
                        type="submit"
                        class="h-11 w-full bg-emerald-600 font-bold tracking-wide text-white uppercase hover:bg-emerald-600/90 sm:flex-1"
                        :disabled="form.processing"
                        data-test="register-user-button"
                    >
                        <Spinner v-if="form.processing" />
                        Create account
                    </Button>
                </div>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink
                    :href="login()"
                    class="text-hdwsi-blue underline underline-offset-4"
                    :tabindex="6"
                    >Log in</TextLink
                >
            </div>
        </form>
    </AuthLayout>
</template>
