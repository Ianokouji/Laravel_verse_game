<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BibleBook extends Model
{
    //

    use HasFactory;

    protected $fillable = ['name','testament'];

    public function chapters(){
        return $this->hasMany(BibleChapter::class);
    }
}
