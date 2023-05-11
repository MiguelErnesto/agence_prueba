<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\footer;

include('InitialValues.php');

class FootersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footer = footer::find($id);
        return view('admin.footer.edit', ['footer' => $footer]);
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
        $request->validate([
            'symbol' => 'required',
            'year' => 'required',
            'owner' => 'required'
        ]);

        $footer = footer::find($id);

        if ($request->hasFile("url_img")) {
            $file = $request->file("url_img");
            $file_name =  $file->getClientOriginalName();
            $ruta = public_path("images/" . $file_name);
            $ext = $file->guessExtension();

            if (($ext == "jpeg") or ($ext == "png") or ($ext == "jpg") or ($ext == "gif") or ($ext == "svg")) {
                if (file_exists($ruta)) {
                    !unlink($ruta);
                }
                copy($file, $ruta);
                $footer->image = $file_name;
            } else {
                return redirect()->route('footer.edit', ['footer' => 1])->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $footer->symbol = $request->symbol;
        $footer->year = $request->year;
        $footer->owner = $request->owner;
        $footer->other_details = $request->other_details;
        $footer->name_link = $request->name_link;
        $footer->link = $request->link;

        $footer->save();
        return redirect()->route('home')->with('success', 'Footer actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
