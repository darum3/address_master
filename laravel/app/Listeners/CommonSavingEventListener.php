<?php

namespace App\Listeners;

use App\Events\CommonSavingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class CommonSavingEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommonSavingEvent $event)
    {
        $model = $event->model;

        $trace = debug_backtrace();
        for ($i = count($trace) - 1; $i >= 0; --$i) {
            if (isset($trace[$i]['class'])
                && (Str::startsWith($trace[$i]['class'], 'App\\Console')
                    || Str::startsWith($trace[$i]['class'], 'App\\Http'))
            ) {
                break;
            }
        }
        if (!isset($trace[$i])) {
            $model->sysinfo = 'Unknown';
            return;
        }
        $classArray = explode('\\', $trace[$i]['class']);
        $info = end($classArray) . '::' . $trace[$i]['function'];
        $model->sysinfo = $info;
    }
}
