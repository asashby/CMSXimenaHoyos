<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addresses extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'alias',
        'address',
        'user_id',
        'nro',
        'province',
        'district'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
