<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Requests\MovieRequestEdit;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::get();
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $simpan = Movie::create($request->except('_token'));
      
        // simpan foto
        $smallThumbnail = $request->file('small_thumbnail');
        $largeThumbnail = $request->file('large_thumbnail');

        $pathSmallThumbnail = $smallThumbnail->storeAs('public/thumbnail/' , Str::random(10).$smallThumbnail->getClientOriginalName());
        $pathLargeThumbnail = $largeThumbnail->storeAs('public/thumbnail/' , Str::random(10).$largeThumbnail->getClientOriginalName());
        
        $simpan->update([
            'small_thumbnail'   => $pathSmallThumbnail,
            'large_thumbnail'   => $pathLargeThumbnail,
        ]);
        
        return back()->with(['status' => true, 'message' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequestEdit $request, Movie $movie)
    {
        // cek file small thumbnail
        if ($request->hasFile('small_thumbnail')){
            // kalo ada hapus foto lama 
            Storage::disk('local')->delete($movie->small_thumbnail);
        }
        else {
            $smallThumbnail = $request->file('small_thumbnail');
            $pathSmallThumbnail = $smallThumbnail->storeAs('public/thumbnail/' , Str::random(10).$smallThumbnail->getClientOriginalName());
        }

        // cek file large thumbnail
        if ($request->hasFile('large_thumbnail')){
            // kalo ada hapus foto lama 
            Storage::disk('local')->delete($movie->large_thumbnail);
        }
        else {
            $largeThumbnail = $request->file('small_thumbnail');
            $pathLargeThumbnail = $largeThumbnail->storeAs('public/thumbnail/' , Str::random(10).$largeThumbnail->getClientOriginalName());
        }
       
        // update data

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return back()->with(['status' => true, 'message' => 'Data Berhasil Dihapus']);
    }
}
