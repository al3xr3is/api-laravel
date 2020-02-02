<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    protected $table = 'pecas';

    protected $fillable = ['name', 'description', 'user_id'];

    public function users() {
    	return $this->belongsTo(User::class);
    }

}
