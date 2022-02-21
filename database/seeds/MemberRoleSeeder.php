<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('member_role')->insert([
            [
                'id'    => 1,
                'name' => 'admin'
            ],
            [
                'id'    => 2,
                'name' => 'manager'
            ],
            [
                'id'    => 3,
                'name' => 'kaki tangan'
            ]
        ]);
    }
}
