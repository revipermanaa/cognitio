<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat beberapa role
        // membuat default user untuk superadmin

        $ownerRole = Role::create([
            'name' => 'owner',
        ]);

        $studentRole = Role::create([
            'name' => 'student',
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher',
        ]);

        // akun superadmin untuk mengelola data awal
        // data kategori, kelas, dsb
        $userOwner = User::create([
            'name' => 'Revi Permana',
            'occupation' => 'Educator',
            'avatar' => 'images/default-avatar.png',
            'email' => 'revi@owner.com',
            'password' => bcrypt('asdasd')
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
