<?php

namespace App\Contracts\Catalog;

/**
 * Interface AttributeGroupContract
 * @package App\Contracts
 */
interface AttributeGroupContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListAttributeGroups(string $order = 'id_attribute_group', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function FindAttributeGroupById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function CreateAttributeGroup(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateAttributeGroup(int $id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function DeleteAttributeGroup($id);

    /**
     * @param $slug
     * @return mixed
     */
    public function FindBySlug($slug);
}
