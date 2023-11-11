<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Row;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function rows(){
        return $this->hasMany(Row::class);
    }
}
