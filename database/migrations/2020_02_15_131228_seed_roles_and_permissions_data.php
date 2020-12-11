<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 创建权限 Persisson::create(['name' => '权限名'])
        Permission::create(['name' => 'material-management']);

        // 创建角色 Role::create(['name' => '角色名'])
        $founder = Role::create(['name' => 'Founder']); //站长
        // 赋予权限 $角色->givePermessionTo('权限名')
        $founder->givePermissionTo('material-management');

//        // 创建管理员角色
       $maintainer = Role::create(['name' => 'Maintainer']);
//        $maintainer->givePermissionTo('manage_contents');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        Model::unguard(); //记得解除模型保护
        DB::table('role_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        Model::reguard(); //最后重新开启模型保护
    }
}
