<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EnvironmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('environments')->insert([
        	'type' => 'Departamento',
        	'area' => '45.50',
        	'flat' => '1',
        	'code' => 'A-1'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Departamento',
        	'area' => '67.50',
        	'flat' => '1',
        	'code' => 'A-2'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Departamento',
        	'area' => '95.50',
        	'flat' => '1',
        	'code' => 'A-3'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Departamento',
        	'area' => '45.50',
        	'flat' => '1',
        	'code' => 'A-4'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Departamento',
        	'area' => '94.50',
        	'flat' => '1',
        	'code' => 'A-5'
        ]);
        //Oficina
        DB::table('environments')->insert([
        	'type' => 'Oficina',
        	'area' => '45.50',
        	'flat' => '2',
        	'code' => 'B-1'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Oficina',
        	'area' => '60.50',
        	'flat' => '2',
        	'code' => 'B-2'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Oficina',
        	'area' => '75.50',
        	'flat' => '2',
        	'code' => 'B-3'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Oficina',
        	'area' => '55.50',
        	'flat' => '2',
        	'code' => 'B-4'
        ]);
        //Tiendas
        DB::table('environments')->insert([
        	'type' => 'Tienda',
        	'area' => '45.50',
        	'flat' => '0',
        	'code' => 'P-1'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Tienda',
        	'area' => '60.50',
        	'flat' => '0',
        	'code' => 'P-2'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Tienda',
        	'area' => '78.50',
        	'flat' => '0',
        	'code' => 'P-3'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Tienda',
        	'area' => '45.50',
        	'flat' => '0',
        	'code' => 'P-4'
        ]);
        //Depositos
        DB::table('environments')->insert([
        	'type' => 'Deposito',
        	'area' => '30.50',
        	'flat' => '0',
        	'code' => 'P-5'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Deposito',
        	'area' => '30.50',
        	'flat' => '-1',
        	'code' => 'S-1'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Deposito',
        	'area' => '40.50',
        	'flat' => '-1',
        	'code' => 'S-2'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Deposito',
        	'area' => '35.50',
        	'flat' => '-1',
        	'code' => 'S-2'
        ]);
        //Areas Sociales
        //Depositos
        DB::table('environments')->insert([
        	'type' => 'Area Social',
        	'area' => '100.50',
        	'flat' => '7',
        	'code' => 'I-1'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Area Social',
        	'area' => '100.50',
        	'flat' => '7',
        	'code' => 'I-2'
        ]);
        DB::table('environments')->insert([
        	'type' => 'Area Social',
        	'area' => '100.50',
        	'flat' => '7',
        	'code' => 'I-3'
        ]);
    }
}
