<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category_aturan()
    {
        return $this->belongsTo(CategoryAturan::class);
    }
}
