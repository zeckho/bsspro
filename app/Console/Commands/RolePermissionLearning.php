<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionLearning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel_api:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles and permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $roles = ["superadmin", "admin", "trainer", "user"];

        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'lesson-list',
            'lesson-create',
            'lesson-edit',
            'lesson-delete',
            'class-list',
            'class-create',
            'class-edit',
            'class-delete',
            'library-list',
            'library-create',
            'library-edit',
            'library-delete',
            'get-course',
        ];

        $this->line('---------------------------Setting Up Roles:');

        foreach ($roles as $role) {
            $role = Role::updateOrCreate(['name' => $role, 'guard_name' => 'api']);

            $this->info('Created '.$role->name." Role");
        }

        $this->line('---------------------------Setting Up Permissions:');

        $superAdminRole = Role::where('name', 'superadmin')->first();

        foreach ($permissions as $permission) {
            $permission = Permission::updateOrCreate(['name' => $permission, 'guard_name' => 'api']);

            $superAdminRole->givePermissionTo($permission);

            $this->info('Created '.$permission->name.' Permission');
        }

        $this->info('All permission are granted to Super Admin');
        $this->line('----------------------------Application Learning Is Complete: ');
    }
}
