<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $order;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->order = $this->data['order_object'];
        $this->replaceTag();
        unset($this->data['order_object']);
    }

    public function replaceTag()
    {
        $this->data['body_message'] = str_replace('{WORKSHOP_NAME}', $this->order->workshop->description, $this->data['body_message']);
        $this->data['body_message'] = str_replace('{WORKSHOP_ADDRESS}', $this->order->workshop->address, $this->data['body_message']);
        $this->data['body_message'] = str_replace('{WORKSHOP_CONTACT}', trans('workshops.contact_name').': '.$this->order->workshop->contact_name, $this->data['body_message']);
        $this->data['body_message'] = str_replace('{WORKSHOP_PHONE}', trans('workshops.officephone_number').': '.$this->order->workshop->officephone_number, $this->data['body_message']);
        $this->data['body_message'] = str_replace('{WORKSHOP_SCHEDULE}', trans('workshops.work_schedule').': '.$this->order->workshop->work_schedule, $this->data['body_message']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.issued_case')
                    ->attach($this->data['order_pdf_url'], [
                        'as' => trans('email.orders.order_created.filename', ['order_number' => $this->order->order_number]),
                        'mime' => 'application/pdf',
                    ]);
    }
}
