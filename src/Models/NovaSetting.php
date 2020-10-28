<?php

namespace Epigra\NovaSettings\Models;

use Illuminate\Database\Eloquent\Model;

class NovaSetting extends Model
{
    protected $table = "settings";

    protected $fillable = [
        'key',
        'value'
    ];
}
