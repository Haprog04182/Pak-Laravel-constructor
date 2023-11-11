<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Row;
use App\Models\Text;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function row(){
        return $this->belongsTo(Row::class);
    }

    public function texts(){
        return $this->hasMany(Text::class);
    }
}
