<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caisse extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'caisses';

    protected $fillable = [
        'title','address','status'];

    public function caisseday()
    {
        return $this->hasMany(CaisseDay::class);
    }

}
