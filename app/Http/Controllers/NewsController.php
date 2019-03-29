<?php

namespace App\Http\Controllers;

use App\News;
use Validator;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        
        return response()->json($news);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);

        if(!$news) {
            return response()->json([
                'message'   => 'Registro não encontrado',
            ], 404);
        }

        return response()->json($news);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:100'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha na validação',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $news = new News();
        $news->fill($data);
        $news->save();

        return response()->json($news, 201);
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
        $news = News::find($id);

        if(!$news) {
            return response()->json([
                'message'   => 'Registro não encontrado',
            ], 404);
        }

        $validator = Validator::make($data, [
            'title' => 'max:100'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha na validação',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $news->fill($request->all());
        $news->save();

        return response()->json($news);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        if(!$news) {
            return response()->json([
                'message'   => 'Registro não encontrado',
            ], 404);
        }

        $news->delete();
    }

}