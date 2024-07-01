<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function forum(){
        return $this->belongsTo(forum::class)->with('user');
    }
    public function komen(){
        return $this->belongsTo(komentar::class)->with('user');
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

}
