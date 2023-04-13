<?php

namespace App\Models;

use App\Models\CustomerAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory;
    public function customer_acc(){
        return $this->belongsTo(CustomerAccount::class,'customer_acc_id');
    }
}
