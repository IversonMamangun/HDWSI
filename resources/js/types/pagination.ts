export interface PaginationLink {
    url: string | null;
    label: string;
    page: number | null;
    active: boolean;
}

export interface PaginationMeta {
    current_page: number;

    from: number | null;

    last_page: number;

    links: PaginationLink[];

    path: string;

    per_page: number;

    to: number | null;

    total: number;
}

export interface PaginationUrls {
    first: string | null;
    last: string |null;
    prev: string | null;
    next: string | null;
}

export interface Paginated<T> {
    data: T[];

    links: PaginationUrls;

    meta: PaginationMeta;
}
