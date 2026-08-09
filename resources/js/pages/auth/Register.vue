<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {
    DateFormatter,
    getLocalTimeZone,
    parseDate,
    today,
} from '@internationalized/date';
import type { CalendarDate } from '@internationalized/date';
import { CalendarIcon } from '@lucide/vue';
import { computed, ref } from 'vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
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
import AuthBase from '@/layouts/AuthLayout.vue';
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

const steps = [
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
        label: 'Security',
        shortLabel: 'Security',
        fields: ['password', 'password_confirmation'],
    },
] as const;

function initialStepFromErrors(): number {
    const erroredFields = Object.keys(page.props.errors ?? {});

    if (erroredFields.length === 0) {
        return 0;
    }

    const stepIndex = steps.findIndex((step) =>
        step.fields.some((field) => erroredFields.includes(field)),
    );

    return stepIndex === -1 ? 0 : stepIndex;
}

const currentStep = ref(initialStepFromErrors());
const isLastStep = computed(() => currentStep.value === steps.length - 1);

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
    password: '',
    password_confirmation: '',
}).withPrecognition('post', '/register/validate');

const showValidatingSpinner = ref(false);

function next() {
    showValidatingSpinner.value = true;

    form.validate({
        only: steps[currentStep.value].fields,
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
            const stepIndex = steps.findIndex((step) =>
                step.fields.some((field) => erroredFields.includes(field)),
            );

            if (stepIndex !== -1) {
                currentStep.value = stepIndex;
            }
        },
    });
}
</script>

<template>
    <AuthBase
        title="Create an account"
        description="Enter your details below to create your account"
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
                                    ? 'bg-primary text-primary-foreground'
                                    : 'bg-muted text-muted-foreground'
                            "
                        >
                            {{ index + 1 }}
                        </div>
                        <span
                            class="max-w-18 truncate text-center text-[11px] leading-tight sm:max-w-none sm:text-xs sm:whitespace-nowrap"
                            :class="
                                index === currentStep
                                    ? 'font-medium text-foreground'
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
                        :class="index < currentStep ? 'bg-primary' : 'bg-muted'"
                    />
                </template>
            </div>

            <div class="grid gap-6">
                <!-- Step 1: Personal info -->
                <div v-show="currentStep === 0" class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="first_name">First name</Label>
                        <Input
                            id="first_name"
                            v-model="form.first_name"
                            type="text"
                            required
                            autofocus
                            autocomplete="given-name"
                            placeholder="Juan"
                            :aria-invalid="form.invalid('first_name')"
                            @blur="form.validate('first_name')"
                        />
                        <InputError
                            v-if="form.invalid('first_name')"
                            :message="form.errors.first_name"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="middle_name">Middle name</Label>
                        <Input
                            id="middle_name"
                            v-model="form.middle_name"
                            type="text"
                            autocomplete="additional-name"
                            placeholder="Santos"
                            :aria-invalid="form.invalid('middle_name')"
                            @blur="form.validate('middle_name')"
                        />
                        <InputError
                            v-if="form.invalid('middle_name')"
                            :message="form.errors.middle_name"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="last_name">Last name</Label>
                        <Input
                            id="last_name"
                            v-model="form.last_name"
                            type="text"
                            required
                            autocomplete="family-name"
                            placeholder="Dela Cruz"
                            :aria-invalid="form.invalid('last_name')"
                            @blur="form.validate('last_name')"
                        />
                        <InputError
                            v-if="form.invalid('last_name')"
                            :message="form.errors.last_name"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="email@example.com"
                            :aria-invalid="form.invalid('email')"
                            @blur="form.validate('email')"
                        />
                        <InputError
                            v-if="form.invalid('email')"
                            :message="form.errors.email"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone_number">Phone number</Label>
                        <Input
                            id="phone_number"
                            v-model="form.phone_number"
                            type="tel"
                            required
                            autocomplete="tel"
                            placeholder="09XX XXX XXXX"
                            :aria-invalid="form.invalid('phone_number')"
                            @blur="form.validate('phone_number')"
                        />
                        <InputError
                            v-if="form.invalid('phone_number')"
                            :message="form.errors.phone_number"
                        />
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-[1fr_auto]">
                        <div class="grid gap-2">
                            <Label for="date_of_birth">Date of birth</Label>
                            <Popover v-slot="{ close }">
                                <PopoverTrigger as-child>
                                    <Button
                                        id="date_of_birth"
                                        type="button"
                                        variant="outline"
                                        :class="
                                            cn(
                                                'w-full justify-start text-left font-normal',
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

                        <div class="grid gap-2">
                            <Label for="age">Age</Label>
                            <Input
                                id="age"
                                :model-value="age"
                                type="text"
                                readonly
                                disabled
                                placeholder="—"
                                class="sm:w-20"
                            />
                        </div>
                    </div>
                </div>

                <!-- Step 2: Address & employment -->
                <div v-show="currentStep === 1" class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="address">Home address</Label>
                        <Input
                            id="address"
                            v-model="form.address"
                            type="text"
                            required
                            autocomplete="street-address"
                            placeholder="House no., street, barangay, city/municipality"
                            :aria-invalid="form.invalid('address')"
                            @blur="form.validate('address')"
                        />
                        <InputError
                            v-if="form.invalid('address')"
                            :message="form.errors.address"
                        />
                    </div>
                </div>

                <!-- Step 3: Identity verification -->
                <div v-show="currentStep === 2" class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="id_type">Government ID type</Label>
                        <Select
                            v-model="form.id_type"
                            required
                            @update:model-value="form.validate('id_type')"
                        >
                            <SelectTrigger
                                id="id_type"
                                class="w-full"
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

                    <div class="grid gap-2">
                        <Label for="id_number">ID number</Label>
                        <Input
                            id="id_number"
                            v-model="form.id_number"
                            type="text"
                            required
                            placeholder="Enter ID number"
                            :aria-invalid="form.invalid('id_number')"
                            @blur="form.validate('id_number')"
                        />
                        <InputError
                            v-if="form.invalid('id_number')"
                            :message="form.errors.id_number"
                        />
                    </div>
                </div>

                <!-- Step 4: Security -->
                <div v-show="currentStep === 3" class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <PasswordInput
                            id="password"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            :aria-invalid="form.invalid('password')"
                            @blur="form.validate('password')"
                        />
                        <InputError
                            v-if="form.invalid('password')"
                            :message="form.errors.password"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation"
                            >Confirm password</Label
                        >
                        <PasswordInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
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
                        class="w-full sm:flex-1"
                        @click="currentStep -= 1"
                    >
                        Back
                    </Button>

                    <Button
                        v-if="!isLastStep"
                        type="button"
                        class="w-full sm:flex-1"
                        :disabled="form.validating"
                        @click="next"
                    >
                        <Spinner v-if="showValidatingSpinner" />
                        Next
                    </Button>

                    <Button
                        v-else
                        type="submit"
                        class="w-full sm:flex-1"
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
                    class="underline underline-offset-4"
                    :tabindex="6"
                    >Log in</TextLink
                >
            </div>
        </form>
    </AuthBase>
</template>
