<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $players = Player::all();
        return response()->json($players);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {

            //dd($request);
            $request->merge(['ip' => $request->ip()]);

            // Validar los datos entrantes
            $validatedData = $request->validate(Player::$rules);

            // Generar un UUID único
            $validatedData['token'] = (string) Str::uuid();

            // Crear el nuevo jugador
            $player = Player::create($validatedData);

            // Guardar el modelo con el token
            $player->save();

            // Crear una cookie con el token
            $cookie = cookie('token', $validatedData['token'], 60); // 60 minutos de expiración

            // Devolver la respuesta JSON con la cookie
            return response()->json($player, 201)->cookie($cookie);
        } catch (\Illuminate\Database\QueryException $e) {
            // Manejo de excepciones para errores de base de datos, como violaciones de unicidad
            return response()->json(['error' => 'Error en la base de datos.',$e], 400);
        } catch (\Exception $e) {
            // Manejo de excepciones generales
            return response()->json(['error' => 'Error inesperado: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
