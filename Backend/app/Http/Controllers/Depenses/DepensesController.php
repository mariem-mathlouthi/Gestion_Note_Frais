<?php

namespace App\Http\Controllers\Depenses;

use App\Http\Controllers\Controller;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepensesController extends Controller
{
    public function GetAllDepenses(Request $request)
    {
        if(isset($request->montant) && isset($request->date)){
              $depenses = Depense::where("status","=",$request->status)->where("montant",'=',$request->montant)->WhereDate("date",$request->date)->get();
              return response()->json(["data" => $depenses], 200);
        }else if(isset($request->montant) && !isset($request->date)){
            $depenses = Depense::where("status","=",$request->status)->where("montant",'=',$request->montant)->get();
            return response()->json(["data" => $depenses], 200);
        }else if(!isset($request->montant) && isset($request->date)){
            $depenses = Depense::where("status","=",$request->status)->WhereDate("date",$request->date)->get();
            return response()->json(["data" => $depenses], 200);
        }else{
            $depenses = Depense::where("status","=",$request->status)->get();
            return response()->json(["data" => $depenses], 200);
        }
    }

    public function MyLatestDepenses(Request $request){
        $depenses = Depense::where("user_id","=",$request->user_id)->with('category')->with('devise')->orderBy('date', 'desc')->limit(5)->get();
        return response()->json(["data" => $depenses], 200);
    }

    public function AddDepense(Request $request)
    {
        $file_name = time() . '_' . $request->file('file')->getClientOriginalName();
        $image = $request->file('file')->storeAs('images', $file_name, 'public');

        $depense = Depense::create([
            'date' => $request->date,
            'montant' => $request->montant,
            'description' => $request->description,
            'status' => "0",
            'pays' => $request->pays,
            'file' => '/storage/' . $image,
            'user_id' => $request->user_id,
            'paiement_id' => $request->paiement_id,
            'devise_id' => $request->devise_id,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['data' => $depense], 200);
    }

    public function UpdateDepense(Request $request, int $id)
    {
        $depense = Depense::find($id);
        if ($depense) {
            if ($request->hasFile('file')) {
                $file_name = time() . '_' . $request->file('file')->getClientOriginalName();
                $image = $request->file('file')->storeAs('images', $file_name, 'public');
                $depense->update([
                    'date' => $request->date,
                    'montant' => $request->montant,
                    'description' => $request->description,
                    'pays' => $request->pays,
                    'file' => '/storage/' . $image,
                    'paiement_id' => $request->paiement_id,
                    'devise_id' => $request->devise_id,
                    'category_id' => $request->category_id,
                ]);
            } else {
                $depense->update([
                    'date' => $request->date,
                    'montant' => $request->montant,
                    'description' => $request->description,
                    'pays' => $request->pays,
                    'paiement_id' => $request->paiement_id,
                    'devise_id' => $request->devise_id,
                    'category_id' => $request->category_id,
                ]);
            }

            return response()->json(["message" => "Depense Updated"], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function DeleteDepense($id)
    {
        $depense = Depense::find($id);
        if ($depense) {
            $depense->delete();
            return response()->json(["message" => "Depense Deleted"], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function GetDepenseById($id)
    {
        $depense = Depense::find($id);
        if ($depense) {
            return response()->json(["data" => $depense], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }


    public function accpetDepenses($id){
        $depense = Depense::find($id);
        if ($depense) {
            $depense->update([
                "status"=> "1"
            ]);
            return response()->json(["data" => $depense], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }

    public function RejectDepenses($id){
        $depense = Depense::find($id);
        if ($depense) {
            $depense->update([
                "status"=> "2"
            ]);
            return response()->json(["data" => $depense], 200);
        } else {
            return response()->json(["message" => "Not Found"], 404);
        }
    }
}
