<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendReportApprovalMail extends Mailable
{
    use Queueable, SerializesModels;
    public $nameofRecipient, $emailofRecipient,$phoneofRecipient,$accessCode,$reportDetails,$valuerdetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameofRecipient, $emailofRecipient,$phoneofRecipient,$accessCode,$reportDetails,$valuerdetails)
    {
        $this->nameofRecipient=$nameofRecipient; 
        $this->emailofRecipient=$emailofRecipient;
        $this->phoneofRecipient=$phoneofRecipient;
        $this->accessCode=$accessCode;
        $this->reportDetails=$reportDetails;
        $this->valuerdetails=$valuerdetails;
        //
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */    public function envelope()
    {
        return new Envelope(
            subject: 'Valuation Report Approval',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'Email.valuationfirms.reportapprovalalert',
            with: [
                'recipientname'=>$this->nameofRecipient,
                'recipientemail'=>$this->emailofRecipient,
                'recipientphone'=>$this->phoneofRecipient,
                'reportdetails'=>$this->reportDetails,
                'valuerdetails'=>$this->valuerdetails,
            ]
        );
    }
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
