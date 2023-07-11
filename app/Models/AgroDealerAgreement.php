<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgroDealerAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'agro_dealer_agreement_number',
        'first_name',
        'last_name',
        'other_name',
        'legal_business_name',
        'contact_person',
        'contact_phone_number',
        'email_address',
        'physical_address',
        'agreement_effective_date',
        'date_of_agreement',
        'signed_by',
        'agreement_term_or_duration',
        'termination_clauses_and_conditions',
        'confidentiality_obligations',
        'non_disclosure_agreements',
    ];
}
