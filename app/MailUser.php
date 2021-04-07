<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailUser extends Model
{
    protected $fillable = [
        'asunto', 'destino', 'mensaje', 'user_id', 'status'
    ];

    
}
