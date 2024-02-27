<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function GetAll(){
        $users=User::where("IsAdmin",0)->get();
        return response()->json(["data"=>$users],200);
   }



   public function singUp(Request $request){
      $file_name = time() . '_' . $request->photo->getClientOriginalName();
      $image = $request->file('photo')->storeAs('images', $file_name, 'public');

      $user=User::create([
         "name"=>$request->name,
         "email"=>$request->email,
         "password"=>bcrypt($request->password),
         "isAdmin"=>0,
         "photo"=>'/storage/' . $image,
      ]);
      return response()->json(["data"=>$user],201);
   }


   public function LoginUser(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;
            $respnose = [
                'token' => $token,
                'user' => $user,
                'isAdmin' => $user->isAdmin
            ];
            return response()->json(['data' => $respnose], 200);
        } else {
            return response()->json(['data' => "Utilisateur non trouvé", 'status' => "user"], 401);
        }
    }

   public function deleteOne($id){
      $users=User::find($id);
      if($users){
         $users->delete();
         return response()->json(["success"=>"Deleted withy succcess"],200);
      }else{
         return response()->json(["message"=>"Not Found"],404);
      }
   }
   public function updateOne(Request $request, $id){
    $user = User::find($id);
    if($user){
        $user->update([
            "name" => $request->input('name', $user->name),
            "email" => $request->input('email', $user->email),
            "password" => bcrypt($request->input('password', $user->password)),
            "isAdmin" => $request->input('isAdmin', $user->isAdmin),
            "photo" => $request->has('photo') ? '/storage/' . $request->file('photo')->store('images', 'public') : $user->photo
        ]);
        return response()->json(["success" => "Mise à jour réussie"], 200);
    } else {
        return response()->json(["message" => "Utilisateur non trouvé"], 404);
    }
}




   public function forgot_password(Request $request)
   {
           $token= mt_rand(100000, 999999);
           $user_forgot_password=User::where('email','=',$request->email)->firstOrFail();
           $user_forgot_password->password_token=$token;
           $user_forgot_password->password_token_send_at=now();
           $user_forgot_password->save();
           Mail::to($request->email)->send(new ResetPassword($token));
           return response()->json(['message'=>"Code Envoyer A votre email avec success"],200);
   }
   
    public function changer_password(Request $request){

        $checkCode=User::where('password_token',$request->code)->where('email',$request->email)->first();
        if(!$checkCode){
            return response(['message' => 'E-mail ou code incorrect'], 404);
        }

        $checkCode->password=bcrypt($request->password);
        $checkCode->password_token=Null;
        $checkCode->password_token_send_at=Null;
        $checkCode->save();
        return response(['message' =>'votre mot de passe a été changé'], 200);
    }




}

   

