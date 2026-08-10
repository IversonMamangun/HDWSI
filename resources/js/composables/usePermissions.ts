import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

export function usePermissions() {
    const page = usePage<{ auth: { permissions: string[] } }>();

    const permissions = computed(() => page.props.auth.permissions ?? []);

    const can = (permission?: string) =>
        !permission || permissions.value.includes(permission);

    return { permissions, can };
}
