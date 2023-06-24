<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Deatiels extends Model
{
    use HasFactory;




    function relationInvoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'invoices_id');
    }

    function relationInvoiceList()
    {
        return $this->hasOne(User::class, 'id', 'patient_id');
    }
    function relationInvoiceDoctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }



}
