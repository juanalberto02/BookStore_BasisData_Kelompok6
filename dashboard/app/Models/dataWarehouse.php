<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataWarehouse extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    protected $table = 'fact_sales';

    protected $guarded = [];
}
