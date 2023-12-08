<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_params extends Model
{
    use HasFactory;
    protected $table = 'account_params';
    protected $fillable = ['account_no', 'institution', 'remarks'];
}
