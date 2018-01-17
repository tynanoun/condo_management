<?php

namespace App\Mail;

use App\Usage;
use App\Room;
use App\PriceSetting;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    protected $usageId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usageId)
    {
        $this->usageId = $usageId;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $usage = Usage::find($this->usageId);
        $room = Room::find($usage->room_id);
        $priceSetting = PriceSetting::all()->first();
        $user = User::all()->where('room_id', $room->id)->first();
        $date = date('d/m/Y');
        $time = strtotime($usage->start_date);
        $invoiceNumber = $room->room_number . '-' . date('m-y',$time);

        view()->share(compact(['usage', 'room', 'priceSetting', 'user', 'date', 'invoiceNumber']));
        $fileName = 'Invoice_' . 'Room' . $room->room_number . '_' . date('M_Y') . '.pdf';

        $pdf = PDF::loadView('admin.invoice.invoiceContent');
        $companyName = "Aura office";
        return $this->view('admin.usage.invoice', compact(['user','usage', 'companyName']))
            ->attachData($pdf->output(), $fileName, [
                'mime' => 'application/pdf',
            ]);
    }
}
