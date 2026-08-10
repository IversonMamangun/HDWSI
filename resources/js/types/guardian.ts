export interface Guardian {
    id: number;
    name: string;
    email: string;
    relationship: string | null;
    consented: boolean;
    consent_given_at: string | null;
}
