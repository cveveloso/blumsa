<?php

namespace App\Contracts;

/**
 * Interface BaseContract
 * @package App\Contracts
 */
interface BaseContract
{
    /**
     * Create a model instance
     * @param array $attributes
     * @return mixed
     */
    public function Create(array $attributes);

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function Update(array $attributes, int $id);

    /**
     * Return all model rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function All($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    /**
     * Find one by ID
     * @param int $id
     * @return mixed
     */
    public function Find(int $id);

    /**
     * Find one by ID or throw exception
     * @param int $id
     * @return mixed
     */
    public function FindOneOrFail(int $id);

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */
    public function FindBy(array $data);

    /**
     * Find one based on a different column
     * @param array $data
     * @return mixed
     */
    public function FindOneBy(array $data);

    /**
     * Find one based on a different column or through exception
     * @param array $data
     * @return mixed
     */
    public function FindOneByOrFail(array $data);

    /**
     * Delete one by Id
     * @param int $id
     * @return mixed
     */
    public function Delete(int $id);
}
