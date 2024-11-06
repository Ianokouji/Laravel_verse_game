<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleChapter extends Model
{
    //
    use HasFactory;
    protected $fillable = ['book_id','chapter_number','verse_count'];

    public function book(){
        return $this->belongsTo(BibleBook::class);
    }


}
