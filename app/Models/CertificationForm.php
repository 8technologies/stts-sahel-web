<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'other_name',
        'applicants_registration_number',
        'applicant_contact',
        'category',
        'certification_type',
        'validity_period',
        'application_details',
        'assessment_evaluation',
        'supporting_documents',
        'declaration_agreement',
        'signature',
        'date',
    ];
}
