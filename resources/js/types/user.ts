export type User = {
    id: number;

    first_name: string;
    middle_name: string | null;
    last_name: string;

    full_name: string;
    initials: string;

    avatar?: string;

    email: string;
    email_verified: boolean;
    email_verified_at: string | null;

    phone_number: string | null;
    phone_number_verified_at: string | null;

    date_of_birth: string | null;
    address: string | null;

    id_type: string | null;
    id_number: string | null;

    roles: string[];
    primary_role: string | null;

    created_at: string;
    updated_at: string;

    can: {
        view: boolean;
        update: boolean;
        delete: boolean;
    };
};
