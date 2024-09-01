<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = ['transaction_code', 'type', 'amount', 'file', 'remark', 'created_at', 'updated_at', 'user_by'];
}
