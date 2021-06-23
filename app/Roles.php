<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use SoftDeletes;
    protected $table = 'Roles';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = ['user_id','roleName','description'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
