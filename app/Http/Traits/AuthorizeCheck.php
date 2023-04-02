<?php

namespace App\Http\Traits;
use Auth;
trait AuthorizeCheck {

          public function authorizeCheck($permission){

                    if(!Auth::user()->can($permission)){

                              throw new \Illuminate\Auth\Access\AuthorizationException(__('You Are unauthorized '));
                    }

          }
}