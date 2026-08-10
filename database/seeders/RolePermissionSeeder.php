<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionEnum::cases() as $permission) {
            Permission::firstOrCreate(['name' => $permission->value]);
        }

        foreach (RoleEnum::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value]);
        }

        $this->assignPermissions();
    }

    private function assignPermissions(): void
    {
        $map = [
            RoleEnum::SUPER_ADMIN->value => PermissionEnum::values(),

            RoleEnum::ADMIN->value => array_filter(
                PermissionEnum::values(),
                fn($p) => !in_array($p, [
                    PermissionEnum::ROLES_MANAGE->value,
                    PermissionEnum::PERMISSIONS_MANAGE->value,
                    PermissionEnum::SETTINGS_MANAGE->value,
                ], true)
            ),

            RoleEnum::CONTENT_EDITOR->value => [
                PermissionEnum::PAGES_VIEW,
                PermissionEnum::PAGES_CREATE,
                PermissionEnum::PAGES_EDIT,
                PermissionEnum::PAGES_PUBLISH,
                PermissionEnum::NEWS_VIEW,
                PermissionEnum::NEWS_CREATE,
                PermissionEnum::NEWS_EDIT,
                PermissionEnum::NEWS_PUBLISH,
                PermissionEnum::EVENTS_VIEW,
                PermissionEnum::EVENTS_CREATE,
                PermissionEnum::EVENTS_EDIT,
                PermissionEnum::PUBLICATIONS_VIEW,
                PermissionEnum::PUBLICATIONS_CREATE,
                PermissionEnum::PUBLICATIONS_EDIT,
                PermissionEnum::PUBLICATIONS_PUBLISH,
            ],

            RoleEnum::ACADEMIC_STAFF->value => [
                PermissionEnum::ACADEMIC_VIEW,
                PermissionEnum::ACADEMIC_CREATE,
                PermissionEnum::ACADEMIC_EDIT,
                PermissionEnum::PROGRAMS_VIEW,
                PermissionEnum::PROGRAMS_CREATE,
                PermissionEnum::PROGRAMS_EDIT,
                PermissionEnum::RESEARCH_VIEW,
                PermissionEnum::RESEARCH_CREATE,
                PermissionEnum::RESEARCH_EDIT,
                PermissionEnum::RESEARCH_PUBLISH,
            ],

            RoleEnum::ADMISSIONS_OFFICER->value => [
                PermissionEnum::ADMISSION_VIEW,
                PermissionEnum::ADMISSION_MANAGE_APPLICATIONS,
                PermissionEnum::ADMISSION_EXPORT_APPLICATIONS,
                PermissionEnum::CONTACT_VIEW_MESSAGES,
                PermissionEnum::CONTACT_REPLY,
            ],

            RoleEnum::MEMBER->value => [
                PermissionEnum::PAGES_VIEW,
                PermissionEnum::NEWS_VIEW,
                PermissionEnum::EVENTS_VIEW,
                PermissionEnum::PUBLICATIONS_VIEW,
                PermissionEnum::RESEARCH_VIEW,
            ],

            RoleEnum::APPLICANT->value => [
                PermissionEnum::APPLICATIONS_VIEW_OWN,
                PermissionEnum::APPLICATIONS_SUBMIT,
                PermissionEnum::APPLICATIONS_UPLOAD_DOCUMENTS,
                PermissionEnum::APPLICATIONS_MESSAGE_ADMISSIONS,
            ],

            RoleEnum::GUARDIAN->value => [
                PermissionEnum::GUARDIAN_VIEW_CHILD_APPLICATION,
                PermissionEnum::GUARDIAN_CONSENT,
                PermissionEnum::GUARDIAN_MESSAGE_ADMISSIONS,
            ],
        ];

        foreach ($map as $roleValue => $permissions) {
            $permissionNames = array_map(
                fn($p) => $p instanceof PermissionEnum ? $p->value : $p,
                $permissions
            );

            Role::findByName($roleValue)->syncPermissions($permissionNames);
        }
    }
}
