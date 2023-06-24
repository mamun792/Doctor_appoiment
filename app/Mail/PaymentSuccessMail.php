<?php

namespace App\Mail;

use App\Models\Invoice_Deatiels as Appointment;
use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $doctor;

    /**
     * Create a new message instance.
     *
     * @param Appointment $appointment
     * @param Doctor $doctor
     */
    public function __construct(Appointment $appointment, Doctor $doctor)
    {
        $this->appointment = $appointment;
        $this->doctor = $doctor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@dplcm.com', 'DPLCMS')
            ->subject('Payment Successful DPLCMS')
            ->view('email.payment_success');
    }
}
