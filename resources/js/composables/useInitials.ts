export type UseInitialsReturn = {
    getInitials: (firstName?: string, lastName?: string) => string;
};

function getInitial(name?: string): string {
    return Array.from(name?.trim() ?? '')[0] ?? '';
}

export function getInitials(
    firstName?: string,
    lastName?: string,
): string {
    const firstInitial = getInitial(firstName);
    const lastInitial = getInitial(lastName);

    return `${firstInitial}${lastInitial}`.toUpperCase();
}

export function useInitials(): UseInitialsReturn {
    return { getInitials };
}
