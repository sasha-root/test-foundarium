<?php declare(strict_types=1);

namespace Api\UI\User\Http\Controllers;

use Api\UI\Common\Http\Controllers\Controller;

class CreateUserController extends Controller
{
    public function __invoke()
    {
        echo "<pre>"; print_r('Create'); die;
    }
}
