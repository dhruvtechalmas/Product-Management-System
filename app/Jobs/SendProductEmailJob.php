<?php

namespace App\Jobs;

use App\Mail\ProductCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Log;


class SendProductEmailJob implements ShouldQueue
{
    use Queueable , Dispatchable;

    public $product;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($product, $user)
    {
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("". $this->user->email);
        Mail::to($this->user->email)
            ->send(new ProductCreatedMail($this->product)); 
        
    }
}
