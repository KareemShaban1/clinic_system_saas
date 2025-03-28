<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Medicine extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $table = 'medicines';

    protected $fillable = [
        'drugbank_id',
        'name',
        'brand_name',
        'drug_dose',
        'type',
        'categories',
        'description',
        'side_effect'
    ];


    
}
