<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CreateAdminRequest;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Traits\QuickResponseTrait;

class AccountsManagerController extends Controller
{
    use QuickResponseTrait;

    /**
    * list all administrator, if withDeleted is passed deleted admins are also retrieved
    * @param boolean $withDeleted
    *
    * @return json
    */
    public function list_admintrators($withDeleted = false) {
        if ($withDeleted) {
            $admins = Administrator::withTrashed()->get();
        } else {
            $admins = Administrator::get();
        }
        return $this->makeJsonResponse([
            'data' => $admins,
        ], 201);
    }

    /**
     * Single Administrator Retrieval
     * @param mixed $id
     * @return json
     */
    public function get_profile($adminId) {
        $administrator = Administrator::withTrashed()->where('id', $adminId)->firstOrFail();
        return $this->makeJsonResponse([
            'data' => $administrator,
        ], 201);
       
    }

    /**
     * Single Administrator Retrieval
     * @param mixed $id
     * @return json
     */
    public function get_admin_with_relations($adminId) {
        $admin = Administrator::with('transactions')->withTrashed()->where('id', $adminId)->firstOrFail();
        return $this->makeJsonResponse([
            'data' => $admin,
        ], 201);
    }

     /**
     * @param Request $request
     * @return json
     */
    public function update_profile(CreateAdminRequest $request, Administrator $administrator) {
        $administrator->update($request->validated());
        return $this->makeJsonResponse([
            'data' => $administrator,
            'message' => 'Account Updated successfully',
        ], 201);
    }

    public function delete_profile(Administrator $administrator) {
        $administrator->delete();
        return $this->makeJsonResponse([
            'message' => 'Account Deleted successfully',
        ], 201);
    }
}
