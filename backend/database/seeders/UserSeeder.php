<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1.Lee el archivo de datos 
        $json=File::get('database/_database/users.json');
        //2.convertir los datos de json en arreglo 
        $arreglo_usuarios=json_decode($json);
        //3.recorrer el arreglo
        //var_dump($arreglo_usuarios);
        //4.registrar el usuario en bd
        //Se utiliza el create::

        foreach($arreglo_usuarios as $usuario){
            User::Create([
                "name"       =>$usuario->name,
                "email"      =>$usuario->email,
                "password"   => Hash::make($usuario->password)
                
            ]);
        }
        //5.un <<entity>>
    }
}
