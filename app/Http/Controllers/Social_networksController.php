<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\social_network;

include('InitialValues.php');


class Social_networksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social_networks =  social_network::all();

        return view(
            'admin.social_network.index',
            compact('social_networks')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.social_network.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url_img' => 'required',
            'name' => 'required',
            'url' => 'required'
        ]);

        $social_network = new social_network;

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
                $social_network->image = $file_name;
            } else {
                return redirect()->route('social_network.create')->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $social_network->name = $request->name;
        $social_network->url = $request->url;

        $social_network->save();

        return redirect()->route('social_network.index')->with('success', 'La información de  ' . $social_network->name . '  fue creada correctamente.');
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
        $social_network = social_network::find($id);

        return view(
            'admin.social_network.edit',
            compact('social_network')
        );
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
            'name' => 'required',
            'url' => 'required'
        ]);

        $social_network = social_network::find($id);

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
                $social_network->image = $file_name;
            } else {
                return redirect()->route('social_network.edit', ['social_network' => 1])->with('success', 'Debe seleccionar un fichero de imagen válido (jpeg, png, jpg, gif, svg)');
            }
        }

        $social_network->name = $request->name;
        $social_network->url = $request->url;

        $social_network->save();
        //return redirect()->route('home')->with('success', 'La información de las Redes sociales fue actualizada correctamente.');
        return redirect()->route('social_network.index')->with('success', 'La información de las Redes sociales fue actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $social_network = social_network::find($id);
        $nombre_red = $social_network->name;

        $social_network->delete();
        return redirect()->route('social_network.index')->with('success', 'La Red Social  ' . $nombre_red . '  fue eliminada correctamente.');
    }
}
