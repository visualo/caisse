<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Numerary extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'numeraries';

    protected $fillable = [
        'value','type','status'];

    public function operations()
    {
        return $this->belongsToMany(Operation::class, 'numeraries_operations','operation_id','numerary_id')->withPivot('qte');
    }
    
}
