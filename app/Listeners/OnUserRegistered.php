<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ActivateAccount;
use App\Repositories\ActivationRepository;
use Mail;

class OnUserRegistered
{

    protected $activationRepository;

    protected $resendAfter = 24;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ActivationRepository $activationRepository)
    {
        $this->activationRepository = $activationRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (!is_null($event->user->activated_at) || !$this->shouldSend($event->user)) {
            return;
        }

        Mail::to($event->user->email)
            ->send(
                new ActivateAccount(
                    $event->user,
                    $this->activationRepository->createActivation($event->user)
                )
            );
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepository->getActivation($user);
        return $activation === null ||
            strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}
