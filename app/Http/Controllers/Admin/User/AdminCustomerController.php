<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\BaseController;
use App\Contracts\CustomerContract;

class AdminCustomerController extends BaseController
{    
	public function __construct(CustomerContract $customerRepository) {
		$this->middleware('auth');
		$this->middleware('validate.admin');
		$this->customerRepository = $customerRepository;
	}

	public function ListCustomers(Request $request) {
    	$customers = $this->customerRepository->ListCustomers();
		return view('Admin.User.ListCustomers', ['customers' => $customers]);
    }

    public function AddCustomer(Request $request) {
    	if ($request->method() == 'GET') {	
			return view('Admin.User.AddCustomer');
    	}

    	$rules = array();
    	$rules['company_name'] = 'required';
    	$rules['company_code'] = 'required';
    	$rules['company_number'] = 'required';
    	
		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el cliente.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $customer = $this->customerRepository->CreateCustomer($params);

		if (!$customer) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el cliente.', 'error', true, true);
		}        
        return $this->responseRedirect('/admin/customer/add', 'Cliente guardado con éxito.' ,'success', false, false);
    }

    public function EditCustomer(Request $request, $id) {
    	if ($request->method() == 'GET') {	
    		$customerEdit = $this->customerRepository->FindCustomerById($id);    		

			return view('Admin.User.EditCustomer', [
				'customer' => $customerEdit
			]);
    	}

    	$rules = array();
    	$rules['company_name'] = 'required';
    	$rules['company_code'] = 'required';
    	$rules['company_number'] = 'required';
    	
		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el cliente.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $customer = $this->customerRepository->UpdateCustomer($id, $params);

		if (!$customer) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el cliente.', 'error', true, true);
		}        
        return $this->responseRedirect('/admin/customer/edit', 'Cliente guardado con éxito.' ,'success', false, false, [$id]);
    }
}