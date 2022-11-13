<?php declare(strict_types=1);

namespace Api\UI\Car\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;

class CreateCarController extends Controller
{
    public function __invoke()
    {
        echo "<pre>"; print_r('Create'); die;
    }
}
