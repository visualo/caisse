<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaisseDay extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'caissedays';

    protected $fillable = [
        'open_time','close_time','open_amount','close_amount','caisse_id','user_id'];

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
    
    public function operations()
    {
        return $this->hasMany(Opeartion::class);
    }

}
