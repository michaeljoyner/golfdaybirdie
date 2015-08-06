<?php

namespace App\Misc;
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/5/15
 * Time: 10:40 AM
 */

trait AsLoggedInUserTrait {

    /**
     * @before
     */
    public function logIn()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user);
    }

}