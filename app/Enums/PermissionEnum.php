<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // Pages / General Content
    case PAGES_VIEW = 'pages.view';
    case PAGES_CREATE = 'pages.create';
    case PAGES_EDIT = 'pages.edit';
    case PAGES_DELETE = 'pages.delete';
    case PAGES_PUBLISH = 'pages.publish';

    // Academic School
    case ACADEMIC_VIEW = 'academic.view';
    case ACADEMIC_CREATE = 'academic.create';
    case ACADEMIC_EDIT = 'academic.edit';
    case ACADEMIC_DELETE = 'academic.delete';

    // Programs
    case PROGRAMS_VIEW = 'programs.view';
    case PROGRAMS_CREATE = 'programs.create';
    case PROGRAMS_EDIT = 'programs.edit';
    case PROGRAMS_DELETE = 'programs.delete';

    // Research
    case RESEARCH_VIEW = 'research.view';
    case RESEARCH_CREATE = 'research.create';
    case RESEARCH_EDIT = 'research.edit';
    case RESEARCH_DELETE = 'research.delete';
    case RESEARCH_PUBLISH = 'research.publish';

    // News & Insights
    case NEWS_VIEW = 'news.view';
    case NEWS_CREATE = 'news.create';
    case NEWS_EDIT = 'news.edit';
    case NEWS_DELETE = 'news.delete';
    case NEWS_PUBLISH = 'news.publish';

    // Events
    case EVENTS_VIEW = 'events.view';
    case EVENTS_CREATE = 'events.create';
    case EVENTS_EDIT = 'events.edit';
    case EVENTS_DELETE = 'events.delete';

    // Publications
    case PUBLICATIONS_VIEW = 'publications.view';
    case PUBLICATIONS_CREATE = 'publications.create';
    case PUBLICATIONS_EDIT = 'publications.edit';
    case PUBLICATIONS_DELETE = 'publications.delete';
    case PUBLICATIONS_PUBLISH = 'publications.publish';

    // Admission
    case ADMISSION_VIEW = 'admission.view';
    case ADMISSION_MANAGE_APPLICATIONS = 'admission.manage-applications';
    case ADMISSION_EXPORT_APPLICATIONS = 'admission.export-applications';

    // Applications (applicant-facing)
    case APPLICATIONS_VIEW_OWN = 'applications.view-own';
    case APPLICATIONS_SUBMIT = 'applications.submit';
    case APPLICATIONS_UPLOAD_DOCUMENTS = 'applications.upload-documents';
    case APPLICATIONS_MESSAGE_ADMISSIONS = 'applications.message-admissions';

    // Guardian
    case GUARDIAN_VIEW_CHILD_APPLICATION = 'guardian.view-child-application';
    case GUARDIAN_CONSENT = 'guardian.consent';
    case GUARDIAN_MESSAGE_ADMISSIONS = 'guardian.message-admissions';

    // Contact / Inquiries
    case CONTACT_VIEW_MESSAGES = 'contact.view-messages';
    case CONTACT_REPLY = 'contact.reply';
    case CONTACT_DELETE_MESSAGES = 'contact.delete-messages';

    // Members
    case MEMBERS_VIEW = 'members.view';
    case MEMBERS_MANAGE = 'members.manage';
    case MEMBERS_APPROVE = 'members.approve';

    // Users & Roles (system-level)
    case USERS_VIEW = 'users.view';
    case USERS_CREATE = 'users.create';
    case USERS_EDIT = 'users.edit';
    case USERS_DELETE = 'users.delete';
    case ROLES_MANAGE = 'roles.manage';
    case PERMISSIONS_MANAGE = 'permissions.manage';

    // Settings
    case SETTINGS_MANAGE = 'settings.manage';

    public function label(): string
    {
        return match ($this) {
            self::PAGES_VIEW => 'View Pages',
            self::PAGES_CREATE => 'Create Pages',
            self::PAGES_EDIT => 'Edit Pages',
            self::PAGES_DELETE => 'Delete Pages',
            self::PAGES_PUBLISH => 'Publish Pages',

            self::ACADEMIC_VIEW => 'View Academic School',
            self::ACADEMIC_CREATE => 'Create Academic School Content',
            self::ACADEMIC_EDIT => 'Edit Academic School Content',
            self::ACADEMIC_DELETE => 'Delete Academic School Content',

            self::PROGRAMS_VIEW => 'View Programs',
            self::PROGRAMS_CREATE => 'Create Programs',
            self::PROGRAMS_EDIT => 'Edit Programs',
            self::PROGRAMS_DELETE => 'Delete Programs',

            self::RESEARCH_VIEW => 'View Research',
            self::RESEARCH_CREATE => 'Create Research',
            self::RESEARCH_EDIT => 'Edit Research',
            self::RESEARCH_DELETE => 'Delete Research',
            self::RESEARCH_PUBLISH => 'Publish Research',

            self::NEWS_VIEW => 'View News & Insights',
            self::NEWS_CREATE => 'Create News & Insights',
            self::NEWS_EDIT => 'Edit News & Insights',
            self::NEWS_DELETE => 'Delete News & Insights',
            self::NEWS_PUBLISH => 'Publish News & Insights',

            self::EVENTS_VIEW => 'View Events',
            self::EVENTS_CREATE => 'Create Events',
            self::EVENTS_EDIT => 'Edit Events',
            self::EVENTS_DELETE => 'Delete Events',

            self::PUBLICATIONS_VIEW => 'View Publications',
            self::PUBLICATIONS_CREATE => 'Create Publications',
            self::PUBLICATIONS_EDIT => 'Edit Publications',
            self::PUBLICATIONS_DELETE => 'Delete Publications',
            self::PUBLICATIONS_PUBLISH => 'Publish Publications',

            self::ADMISSION_VIEW => 'View Admission Page',
            self::ADMISSION_MANAGE_APPLICATIONS => 'Manage Applications',
            self::ADMISSION_EXPORT_APPLICATIONS => 'Export Applications',

            self::APPLICATIONS_VIEW_OWN => 'View Own Application',
            self::APPLICATIONS_SUBMIT => 'Submit Application',
            self::APPLICATIONS_UPLOAD_DOCUMENTS => 'Upload Application Documents',
            self::APPLICATIONS_MESSAGE_ADMISSIONS => 'Message Admissions',

            self::GUARDIAN_VIEW_CHILD_APPLICATION => "View Child's Application",
            self::GUARDIAN_CONSENT => 'Give Guardian Consent',
            self::GUARDIAN_MESSAGE_ADMISSIONS => 'Message Admissions (Guardian)',

            self::CONTACT_VIEW_MESSAGES => 'View Contact Messages',
            self::CONTACT_REPLY => 'Reply to Contact Messages',
            self::CONTACT_DELETE_MESSAGES => 'Delete Contact Messages',

            self::MEMBERS_VIEW => 'View Members',
            self::MEMBERS_MANAGE => 'Manage Members',
            self::MEMBERS_APPROVE => 'Approve Members',

            self::USERS_VIEW => 'View Users',
            self::USERS_CREATE => 'Create Users',
            self::USERS_EDIT => 'Edit Users',
            self::USERS_DELETE => 'Delete Users',
            self::ROLES_MANAGE => 'Manage Roles',
            self::PERMISSIONS_MANAGE => 'Manage Permissions',

            self::SETTINGS_MANAGE => 'Manage Settings',
        };
    }

    /**
     * Group key, useful for building a permission matrix UI
     * e.g. "Academic", "Admission" as section headers.
     */
    public function group(): string
    {
        return match (true) {
            str_starts_with($this->value, 'pages.') => 'Pages',
            str_starts_with($this->value, 'academic.') => 'Academic School',
            str_starts_with($this->value, 'programs.') => 'Programs',
            str_starts_with($this->value, 'research.') => 'Research',
            str_starts_with($this->value, 'news.') => 'News & Insights',
            str_starts_with($this->value, 'events.') => 'Events',
            str_starts_with($this->value, 'publications.') => 'Publications',
            str_starts_with($this->value, 'admission.') => 'Admission',
            str_starts_with($this->value, 'applications.') => 'Applications',
            str_starts_with($this->value, 'guardian.') => 'Guardian',
            str_starts_with($this->value, 'contact.') => 'Contact',
            str_starts_with($this->value, 'members.') => 'Members',
            str_starts_with($this->value, 'users.'), str_starts_with($this->value, 'roles.'), str_starts_with($this->value, 'permissions.') => 'Users & Roles',
            default => 'Settings',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Cases grouped by section, ready to loop over in a Blade view.
     */
    public static function grouped(): array
    {
        $grouped = [];
        foreach (self::cases() as $case) {
            $grouped[$case->group()][] = $case;
        }
        return $grouped;
    }
}
