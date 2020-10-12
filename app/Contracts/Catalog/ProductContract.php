<?php

namespace App\Contracts\Catalog;

/**
 * Interface ProductContract
 * @package App\Contracts
 */
interface ProductContract
{
	/**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListProducts(string $order = 'id_product', string $sort = 'desc', array $columns = ['*']);

    public function CreateProduct(array $params);
    public function FindProductById(int $id);
    //public function UpdateProduct(int $id, array $params);
}
