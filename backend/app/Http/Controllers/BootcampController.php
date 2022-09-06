<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\Validator;
use App\Http\requests\StoreBootcampRequest;
use App\Http\Resources\BootcampResource;
use App\Http\Resources\BootcampCollection;


class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "Aqui se va a mostrar todos los bootcamp";
      return response()->json( new BootcampCollection(Bootcamp::all()) ,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBootcampRequest $request)
    {
       
  
        // 2. crear el objeto validador 

        $v = validator::make($request->all(), $reglas);
        if($v->fails()){
          // Si la validacion falla
          //enviar response de error (postman)

          return response()->json([
                                "success" => false,
                                "errors" => $v->errors()
          ], 422); 

        }



      //registrar el bootcamp a partir de paylod
       

        $b = bootcamp::create(
          $request->all()
        );
        return response (["success" => true,
                            "data" => $b], 201);
    
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(["success"=> true,     
        "data" => new BootcampResource (Bootcamp::find($id))
      ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //1. seleccionar el bootcamp por id
        $bootcamp = Bootcamp::find($id);
        //2.actualizarlo
        $bootcamp->update(
            $request->all()
         );
        //3.hacer el response respectivo
         return response()->json(["success"=> true,
                                    "data"=> new BootcampResource($bootcamp)
                                 ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //1. selecciona el bootcamp
       $bootcamp = Bootcamp::find($id);
        //2.elminar bootcamp
        $bootcamp->delete();
        //3. response:
        return response()->json(["success" => true,
                                "message" => "Bootcamp Eliminado",
                                "data" => new BootcampResource($bootcamp)], 200);

    }
}
