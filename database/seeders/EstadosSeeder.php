<?php

namespace Database\Seeders;

//use App\Models\Permission;
use App\Models\Estado;
//use App\Models\RolePermission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [

            ['estado' => 'Aguascalientes', 'abreviatura' => 'AGU'],
            ['estado' => 'Baja California', 'abreviatura' => 'BC'],
            ['estado' => 'Baja California Sur', 'abreviatura' => 'BCS'],
            ['estado' => 'Campeche', 'abreviatura' => 'CAMP'],
            ['estado' => 'Chiapas', 'abreviatura' => 'CHIS'],
            ['estado' => 'Chihuahua', 'abreviatura' => 'CHIH'],
            ['estado' => 'Coahuila', 'abreviatura' => 'COAH'],
            ['estado' => 'Colima', 'abreviatura' => 'COL'],
            ['estado' => 'Durango', 'abreviatura' => 'DGO'],
            ['estado' => 'Guanajuato', 'abreviatura' => 'GTO'],
            ['estado' => 'Guerrero', 'abreviatura' => 'GRO'],
            ['estado' => 'Hidalgo', 'abreviatura' => 'HGO'],
            ['estado' => 'Jalisco', 'abreviatura' => 'JAL'],
            ['estado' => 'Mexico', 'abreviatura' => 'MEX'],
            ['estado' => 'Michoacán', 'abreviatura' => 'MICH'],
            ['estado' => 'Morelos', 'abreviatura' => 'MOR'],
            ['estado' => 'Nayarit', 'abreviatura' => 'NAY'],
            ['estado' => 'Nuevo León', 'abreviatura' => 'NL'],
            ['estado' => 'Oaxaca', 'abreviatura' => 'OAX'],
            ['estado' => 'Puebla', 'abreviatura' => 'PUE'],
            ['estado' => 'Querétaro', 'abreviatura' => 'QRO'],
            ['estado' => 'Quintana Roo', 'abreviatura' => 'QR'],
            ['estado' => 'San Luis Potosí', 'abreviatura' => 'SLP'],
            ['estado' => 'Sinaloa', 'abreviatura' => 'SIN'],
            ['estado' => 'Sonora', 'abreviatura' => 'SON'],
            ['estado' => 'Tabasco', 'abreviatura' => 'TAB'],
            ['estado' => 'Tamaulipas', 'abreviatura' => 'TAMPS'],
            ['estado' => 'Tlaxcala', 'abreviatura' => 'TLAX'],
            ['estado' => 'Veracruz', 'abreviatura' => 'VER'],
            ['estado' => 'Yucatán', 'abreviatura' => 'YUC'],
            ['estado' => 'Zacatecas', 'abreviatura' => 'ZAC']
        
        ];

        collect($data)->each(function ($v) { Estado::create($v); });


    }
}


