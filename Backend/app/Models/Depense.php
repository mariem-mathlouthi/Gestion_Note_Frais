<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function paiement(){
        return $this->belongsTo(Paiement::class);
    }

    public function devise(){
        return $this->belongsTo(Devise::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
