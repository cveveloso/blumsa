<?php

namespace App\Contracts;

/**
 * Interface CustomerContract
 * @package App\Contracts
 */
interface CustomerContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListCustomers(string $order = 'id_customer', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function FindCustomerById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function CreateCustomer(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateCustomer(int $id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function DeleteCustomer($id);
}
