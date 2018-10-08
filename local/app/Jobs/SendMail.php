<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;
    protected $email;
    protected $cus_info;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->cus_info = $order->cus_info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $info_payment_ol = json_decode($this->order->info_payment_ol,true);

        $this->order->price = number_format(intval((float)$this->order->price));
        $data = [
            'order' => $this->order,
            'info_payment_ol' => $info_payment_ol != null && count($info_payment_ol) ? $info_payment_ol : [],
            'cus_info' => $this->cus_info
        ];

        Mail::send('mail_book',$data, function($message){
            $message->to($this->cus_info['email'], '[CTOGO] HƯỚNG DẪN THANH TOÁN')->subject('[CTOGO] HƯỚNG DẪN THANH TOÁN');
        });
    }
}
