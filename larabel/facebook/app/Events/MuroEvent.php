<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Muro;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MuroEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensaje = null;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Muro $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //PrivateChannel -> para que sea privado. CAMBIAR TAMBIEN EN EL JS ECHO
        //Channel -> para que sea publico, CAMBIAR TAMBIEN EL JS EN EL ECHO
        return new PrivateChannel('Muro');
    }
}
