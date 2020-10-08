<?php

namespace App\Contracts\Catalog;

/**
 * Interface AttributeContract
 * @package App\Contracts
 */
interface AttributeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListAttributes(string $order = 'id_attribute', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function FindAttributeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function CreateAttribute(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateAttribute(int $id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function DeleteAttribute($id);

    /**
     * @param $slug
     * @return mixed
     */
    public function FindBySlug($slug);
}
