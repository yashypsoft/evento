<?php

namespace App\Controllers\Admin;

use App\Models\Admin\Event as AdminEvent;
use Core\View;

class Event extends \Core\Controller
{   
    public function addAction()
    {
        # code...
    }

    public function viewAction()
    {
        $eventObj = new AdminEvent();
        $id = ($this->route_params['id']);
        $eventData = $eventObj->getEventData($id);

        View::renderTemplate('admin/event/view.html', ['eventData' => $eventData]);
    }
}