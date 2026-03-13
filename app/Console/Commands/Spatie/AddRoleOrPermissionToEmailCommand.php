<?php

namespace App\Console\Commands\Spatie;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRoleOrPermissionToEmailCommand extends Command
{
    protected $signature = 'app:add-role-or-permission-to-email-command  {email} {--role=} {--permission=}';

    protected $description = 'Add Role or permission to email';

    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->option('role') ?? null;
        $permissionName = $this->option('permission') ?? null;

        $user = User::where('email', $email)->first();

        if ($roleName) {
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                $role = Role::create([
                    'name' => $roleName,
                ]);
            }

            if ($role) {
                $user->assignRole($roleName);
            }
        }

        if ($permissionName) {
            $permission = Permission::where('name', $permissionName)->first();

            if (!$permission) {
                $permission = Permission::create([
                    'name' => $permissionName,
                ]);
            }

            if ($permission) {
                $user->givePermissionTo($permissionName);
            }
        }
    }
}
