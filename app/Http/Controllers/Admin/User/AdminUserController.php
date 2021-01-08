<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\BaseController;
use App\Contracts\UserContract;
use App\Contracts\CustomerContract;

class AdminUserController extends BaseController
{    
	public function __construct(UserContract $userRepository, CustomerContract $customerRepository) {
		$this->middleware('auth');
		$this->middleware('validate.admin');
		$this->userRepository = $userRepository;
		$this->customerRepository = $customerRepository;
	}

	public function ListUsers(Request $request) {
    	$users = $this->userRepository->ListUsers();
		return view('Admin.User.ListUsers', ['users' => $users]);
    }

    public function EditUser(Request $request, $id) {
    	if ($request->method() == 'GET') {	
    		$userEdit = $this->userRepository->FindUserById($id);

    		$customers = $this->customerRepository->ListCustomers('id_customer', 'asc', ['id_customer', 'company_name']);
    		
    		$comboCustomers = array();
    		$comboCustomers[''] =  'Seleccione cliente';
    		foreach ($customers as $customer) {
    			$comboCustomers[$customer->id_customer] =  $customer->company_name;
    		}		

			return view('Admin.User.EditUser', [
				'user' => $userEdit,
				'comboCustomers' => $comboCustomers
			]);
    	}

    	$rules = array();
    	$rules['firstname'] = 'required';
    	$rules['lastname'] = 'required';
    	
		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el usuario.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $user = $this->userRepository->UpdateUser($id, $params);

		if (!$user) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el usuario.', 'error', true, true);
		}        
        return $this->responseRedirect('/admin/user/edit', 'Usuario guardado con éxito.' ,'success', false, false, [$id]);
    }
}