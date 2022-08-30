<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bootcamp;
use File;


class BootcampSeeder extends Seeder
{
    
    public function run()
    {
        
        $json=File::get('database/_database/bootcamps.json');
       
        $arreglo_bootcamps=json_decode($json);
    
        foreach($arreglo_bootcamps as $bootcamp){
            
            Bootcamp::Create([
                "name"         =>$bootcamp->name,
                "description"  =>$bootcamp->description,
                "website"       =>$bootcamp->website,
                "phone"         =>$bootcamp->phone,
                "user_id"       =>$bootcamp->user_id         
            ]);
        }
     
    }
  
}
