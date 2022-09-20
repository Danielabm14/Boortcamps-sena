<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Review::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, $id)
    {
         //crear el curso 
         $review =new Review();
         $review ->title= $request->title;
         $review ->text= $request ->text;
         $review-> amount= $request ->amount;
         $review->bootcamp_id = $id;
         $review->user_id = $request->user_id;
         $review->save();
 
         //enviar responsee
 
         return response()->json( [
                 "succes" => true,
                 "data" =>$review
         ], 201);
     
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
        "data" => (Review::find($id))
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
       // 1. SELECCIONAR EL CURSO POR ID
       $review = Review::find($id);

       // 2. ACTUALIZARLO
       $review->update(
           $request->all()
       );

       // 3. HACER EL RESPONSE RESPECTIVO
       return response()->json(["success" => true , 
                               "data" => $review
                               ] ,200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 1. SELECCIONAS EL CURSO
        $review = Review::find($id);
        
        // 2. ELIMINAR ESE CURSO
        $review->delete();

        // 3. RESPONSE:
        return response()->json( [  "success" => true,
                                    "messege" => "Review eliminada",
                                    "data" => $review->id
                                ], 200 );
    }
}
