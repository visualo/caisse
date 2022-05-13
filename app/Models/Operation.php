<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'operations';

    protected $fillable = [
        'operation_date', 'amount', 'comment', 'typeoperation_id', 'caisseday_id'
    ];

    public function type()
    {
        return $this->belongsTo(TypeOperation::class,'typeoperation_id','id');
    }

    public function numeraries()
    {
        return $this->belongsToMany(Numerary::class, 'numeraries_operations','operation_id','numerary_id')->withPivot('qte');
    }

}
