<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeOperation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'type_operations';

    protected $fillable = ['title','status','action'];

    public function operation()
    {
        return $this->hasMany(Operation::class);
    }

}
