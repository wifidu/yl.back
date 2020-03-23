<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugInformation extends Model
{
    protected $table = 'drug_information';

    public $timestamps = true;

    protected $fillable = [
        'drug_name',
        'type',
        'factory',
        'specification',
        'unit',
        'dosage_form'
    ];

}