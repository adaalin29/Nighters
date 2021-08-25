<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Storage;
use App\Models\Order;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
    public $order = false;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
      
        $order = Order::with('order_products')->where('id_order', $order_id)->first();
//       dd($order);
        foreach($order->order_products as &$prod){
          $prod->options = json_decode($prod->options, true);
        }
        $order->delivery_address = json_decode($order->delivery_address, true);
        if($order->billing_address != 'aceleasi'){
          $order->billing_address = json_decode($order->billing_address, true);
        }
        $order->formated_date = date('d-m-Y', strtotime($order->created_at));
        $this->order = $order;
//       dd($order);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function showInvoicePdf(Request $request, $user_id, $invoice_path){
      if (! $request->hasValidSignature()) {
          abort(401);
      } 
      $invoice_path = base64_decode($invoice_path);
      return response()->file(Storage::disk('local')->path($invoice_path));
    }
  
    public function build()
    {
      if($this->order->invoice){
        $pathToFile = json_decode($this->order->invoice, true)[0]['download_link'];
        $originalName = json_decode($this->order->invoice, true)[0]['original_name'];
        
        $file = storage_path('app/'.$pathToFile);
//         dd($file);
        return $this->view('emails.comanda')->subject('Comanda Nighters')->subject('Email comanda noua')
                ->attach($file,
                [
                    'as' => $originalName,
                    'mime' => 'application/pdf',
                ]);
      } else{
        return $this->view('emails.comanda')->subject('Comanda Nighters');
      }
    }
}
