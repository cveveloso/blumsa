<?php

namespace App\Contracts\Catalog;

/**
 * Interface CategoryContract
 * @package App\Contracts
 */
interface CategoryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListCategories(string $order = 'id_category', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function FindCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function CreateCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateCategory(int $id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function DeleteCategory($id);

    /**
     * @param $slug
     * @return mixed
     */
    public function FindBySlug($slug);
}
