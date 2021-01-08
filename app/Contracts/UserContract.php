<?php

namespace App\Contracts;

/**
 * Interface UserContract
 * @package App\Contracts
 */
interface UserContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function ListUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function FindUserById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function CreateUser(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateUser(int $id, array $params);

    /**
     * @param $id
     * @return bool
     */
    public function DeleteUser($id);
}
