<?php

namespace App\Repositories;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\CustomerContract;
use App\Models\Customer;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CustomerRepository
 *
 * @package \App\Repositories
 */
class CustomerRepository extends BaseRepository implements CustomerContract
{
    /**
     * CustomerRepository constructor.
     * @param AttributeGroup $model
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListCustomers(string $order = 'id_customer', string $sort = 'desc', array $columns = ['*'])
    {
        $customers = $this->all($columns, $order, $sort);

        return $customers;    
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function FindCustomerById(int $id)
    {
        try {
            $customer = $this->findOneOrFail($id);
            
            return $customer;

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Group|mixed
     */
    public function CreateCustomer(array $params)
    {
        try {
            $customer = new Customer;
            $customer->company_name = e($params['company_name']);
            $customer->company_code = e($params['company_code']);
            $customer->company_number = e($params['company_number']);
            $customer->status = (array_key_exists('status', $params) ? 1 : 0);            
            $customer->save();            

            return $customer;   
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateCustomer(int $id, array $params)
    {
        try {
            $customer = $this->FindCustomerById($id);
            
            if ($customer != null) {
                $customer->company_name = e($params['company_name']);
                $customer->company_code = e($params['company_code']);
                $customer->company_number = e($params['company_number']);
                $customer->status = (array_key_exists('status', $params) ? 1 : 0);
                $customer->update();
            }

            return $customer;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());        
        }        
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function DeleteCustomer($id)
    {
        $customer = $this->FindCustomerById($id);
        $customer->delete();

        return $customer;
    }
}
