<?php

namespace App\Http\Controllers\Paiements;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementsController extends Controller
{
    public function GetAllPaiements()
    {
        $paiements = Paiement::all();
        return response()->json(["data" => $paiements], 200);
    }

    public function AddPaiement(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
        ]);

        $paiement = Paiement::create([
            'nom' => $request->nom,
        ]);

        return response()->json(['data' => $paiement], 201);
    }

    public function UpdatePaiement(Request $request, int $id)
    {
        $request->validate([
            'nom' => 'required|string',
        ]);

        $paiement = Paiement::find($id);

        if ($paiement) {
            $paiement->update([
                'nom' => $request->nom,
            ]);

            
            return response()->json(["data" => $paiement], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function DeletePaiement($id)
    {
        $paiement = Paiement::find($id);

        if ($paiement) {
            $paiement->delete();
            return response()->json(["message" => "Paiement Deleted"], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function GetPaiementById($id)
    {
        $paiement = Paiement::find($id);

        if ($paiement) {
            return response()->json(["data" => $paiement], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }
}
