<script setup lang="ts">
import { Head, Form } from '@inertiajs/vue3'
import { ShieldCheck, User, Mail, Phone, Calendar } from 'lucide-vue-next'
import { store } from '@/actions/App/Http/Controllers/GuardianConsentController'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'

interface Applicant {
  id: number
  name: string
  email: string | null
  phone_number: string | null
  date_of_birth: string | null
}

const { applicant } = defineProps<{
  applicant: Applicant
}>()
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
          Review the applicant's details below before giving consent for their
          HDWSI admission application.
        </CardDescription>
      </CardHeader>

      <CardContent class="space-y-4">
        <div class="rounded-lg border p-4 space-y-3">
          <div class="flex items-center gap-3 text-sm">
            <User class="h-4 w-4 text-muted-foreground" />
            <span class="font-medium">{{ applicant.name }}</span>
          </div>

          <div v-if="applicant.email" class="flex items-center gap-3 text-sm">
            <Mail class="h-4 w-4 text-muted-foreground" />
            <span>{{ applicant.email }}</span>
          </div>

          <div v-if="applicant.phone_number" class="flex items-center gap-3 text-sm">
            <Phone class="h-4 w-4 text-muted-foreground" />
            <span>{{ applicant.phone_number }}</span>
          </div>

          <div v-if="applicant.date_of_birth" class="flex items-center gap-3 text-sm">
            <Calendar class="h-4 w-4 text-muted-foreground" />
            <span>{{ applicant.date_of_birth }}</span>
          </div>
        </div>

        <Separator />

        <Alert>
          <ShieldCheck class="h-4 w-4" />
          <AlertTitle>What consenting means</AlertTitle>
          <AlertDescription>
            By giving consent, you confirm you are this applicant's parent or
            legal guardian and authorize them to submit an admission
            application to HDWSI. You'll be able to view their application
            status at any time from your dashboard.
          </AlertDescription>
        </Alert>
      </CardContent>

      <Form
        v-bind="store.form(applicant.id)"
        v-slot="{ errors, processing }"
      >
        <CardContent v-if="errors && Object.keys(errors).length" class="pt-0">
          <p class="text-sm text-destructive">
            {{ Object.values(errors)[0] }}
          </p>
        </CardContent>

        <CardFooter class="flex justify-end gap-2">
          <Button variant="outline" as-child>
            <a :href="applicant.id ? '/dashboard' : '#'">Cancel</a>
          </Button>
          <Button type="submit" :disabled="processing">
            {{ processing ? 'Recording consent...' : 'Give Consent' }}
          </Button>
        </CardFooter>
      </Form>
    </Card>
  </div>
</template>
