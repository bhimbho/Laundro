<?php

namespace App\Traits\Administrator;

trait AdministratorQuery {

    /**
     * Undocumented function
     *
     * @return object
     */
    public function getloggedInAdmin() {
        return request()->guard('users')->user();
    }
}
