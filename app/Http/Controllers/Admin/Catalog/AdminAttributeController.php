<?php

namespace App\Http\Controllers\Admin\Catalog;

use Illuminate\Http\Request;
use Auth, Config, Validator, Str;
use App\Http\Controllers\BaseController;
use App\Contracts\Catalog\AttributeGroupContract;
use App\Contracts\Catalog\AttributeContract;

class AdminAttributeController extends BaseController
{    
	public function __construct(AttributeGroupContract $groupRepository, AttributeContract $attributeRepository) {
		$this->middleware('auth');
		$this->middleware('validate.admin');
		$this->groupRepository = $groupRepository;
		$this->attributeRepository = $attributeRepository;
	}

	public function ListAttributeGroups(Request $request) {
    	$groups = $this->groupRepository->ListAttributeGroups();
		return view('Admin.Catalog.ListAttributeGroups', ['groups' => $groups]);
    }

    public function AddAttributeGroup(Request $request) {
    	if ($request->method() == 'GET') {
			return view('Admin.Catalog.AddAttributeGroup');
    	}

    	$rules = array();    	
    	$rules['sort_order'] = 'required|numeric';
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el grupo.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $group = $this->groupRepository->CreateAttributeGroup($params);

		if (!$group) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el grupo.', 'error', true, true);
		}
        
        return $this->responseRedirect('/admin/catalog/attributegroup/add', 'Grupo guardada con éxito.' ,'success', false, false);
    }

    public function EditAttributeGroup(Request $request, $id) {
    	if ($request->method() == 'GET') {	
    		$groupEdit = $this->groupRepository->FindAttributeGroupById($id);    		

			return view('Admin.Catalog.EditAttributeGroup', [
				'group' => $groupEdit
			]);
    	}

    	$rules = array();    	
    	$rules['sort_order'] = 'required|numeric';
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el grupo.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $group = $this->groupRepository->UpdateAttributeGroup($id, $params);		    	

		if (!$group) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el grupo.', 'error', true, true);
		}        
        return $this->responseRedirect('/admin/catalog/attributegroup/edit/', 'Grupo guardado con éxito.' ,'success', false, false, [$id]);
    }

    public function DeleteAttributeGroup(Request $request, $id) {        
        $groupDel = $this->groupRepository->DeleteAttributeGroup($id);

        return $this->responseRedirect('/admin/catalog/attributegroup', 'Grupo eliminado con éxito.' ,'success', false, false);
    }

    public function ListAttributes(Request $request) {
    	$attributes = $this->attributeRepository->ListAttributes();
		return view('Admin.Catalog.ListAttributes', ['attributes' => $attributes]);
    }

    public function AddAttribute(Request $request) {
    	if ($request->method() == 'GET') {
    		$groups = $this->groupRepository->ListAttributeGroups('id_attribute_group', 'asc', ['id_attribute_group']);
    		
    		$comboGroups = array();
    		$comboGroups[''] =  'Seleccione grupo';
    		foreach ($groups as $group) {
    			$comboGroups[$group->id_attribute_group] =  $group->name;
    		}

			return view('Admin.Catalog.AddAttribute', ['comboGroups' => $comboGroups]);
    	}

    	$rules = array();    	
    	$rules['group'] = 'required';
    	$rules['sort_order'] = 'required|numeric';
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el atributo.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $attribute = $this->attributeRepository->CreateAttribute($params);

		if (!$attribute) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el atributo.', 'error', true, true);
		}
        
        return $this->responseRedirect('/admin/catalog/attribute/add', 'Grupo guardada con éxito.' ,'success', false, false);
    }

    public function EditAttribute(Request $request, $id) {
    	if ($request->method() == 'GET') {	
    		$attributeEdit = $this->attributeRepository->FindAttributeById($id);    		

    		$groups = $this->groupRepository->ListAttributeGroups('id_attribute_group', 'asc', ['id_attribute_group']);
    		
    		$comboGroups = array();
    		$comboGroups[''] =  'Seleccione grupo';
    		foreach ($groups as $group) {
    			$comboGroups[$group->id_attribute_group] =  $group->name;
    		}

			return view('Admin.Catalog.EditAttribute', [
				'attribute' => $attributeEdit,
				'comboGroups' => $comboGroups
			]);
    	}

    	$rules = array();
    	$rules['group'] = 'required';
    	$rules['sort_order'] = 'required|numeric';    	
    	foreach(array_keys(Config::get('languages')) as $key) {
			$rules['name-' . $key] = 'required';
		}

		$validator = Validator::make($request->all(), $rules);
    
	    if ($validator->fails()) {	    	
	    	return $this->responseRedirectBack('Ocurrio un problema al guardar el atributo.', 'error', true, true, $validator->errors());
	    }
	    
	    $params = $request->except('_token');
	    $attribute = $this->attributeRepository->UpdateAttribute($id, $params);		    	

		if (!$attribute) {
           	return $this->responseRedirectBack('Ocurrio un problema al guardar el atributo.', 'error', true, true);
		}        
        return $this->responseRedirect('/admin/catalog/attribute/edit/', 'Atributo guardado con éxito.' ,'success', false, false, [$id]);
    }

    public function DeleteAttribute(Request $request, $id) {        
        $attributeDel = $this->attributeRepository->DeleteAttribute($id);

        return $this->responseRedirect('/admin/catalog/attribute', 'Atributo eliminado con éxito.' ,'success', false, false);
    }
}
