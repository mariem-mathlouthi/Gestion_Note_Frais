<?php

namespace App\Http\Controllers\Devises;

use App\Http\Controllers\Controller;
use App\Models\Devise;
use Illuminate\Http\Request;

class DevisesController extends Controller
{
    public function GetAllDevises()
    {
        $devises = Devise::all();
        return response()->json(["data" => $devises], 200);
    }

    public function AddDevise(Request $request)
    {
        $devise = Devise::create([
            'titre' => $request->titre,
            'abreviation' => $request->abreviation,
        ]);

        return response()->json(['data' => $devise], 200);
    }

    public function UpdateDevise(Request $request, int $id)
    {
        $devise = Devise::find($id);

        if ($devise) {
            $devise->update([
                'titre' => $request->titre,
                'abreviation' => $request->abreviation,
            ]);

            return response()->json(["message" => "Devise Updated"], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function DeleteDevise($id)
    {
        $devise = Devise::find($id);

        if ($devise) {
            $devise->delete();
            return response()->json(["message" => "Devise Deleted"], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function GetDeviseById($id)
    {
        $devise = Devise::find($id);

        if ($devise) {
            return response()->json(["data" => $devise], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }
}
