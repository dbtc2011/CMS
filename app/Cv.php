<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mem_code', 'acc_code', 'credit', 'debit', 'chk_no', 'doc_date'
    ];
}
