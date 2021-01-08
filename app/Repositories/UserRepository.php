<?php

namespace App\Repositories;

use Config, Str, Log;

use App\Repositories\BaseRepository;
use App\Contracts\UserContract;
use App\Models\User;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class UserRepository
 *
 * @package \App\Repositories
 */
class UserRepository extends BaseRepository implements UserContract
{
    /**
     * UserRepository constructor.
     * @param AttributeGroup $model
     */
    public function __construct(User $model)
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
    public function ListUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $users = $this->all($columns, $order, $sort);

        return $users;    
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function FindUserById(int $id)
    {
        try {
            $user = $this->findOneOrFail($id);
            
            return $user;

        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Group|mixed
     */
    public function CreateUser(array $params)
    {
        try {            

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function UpdateUser(int $id, array $params)
    {
        try {
            $user = $this->FindUserById($id);
            
            if ($user != null) {
                $user->firstname = e($params['firstname']);
                $user->lastname = e($params['lastname']);
                $user->status = (array_key_exists('status', $params) ? 1 : 0);
                $user->id_customer = (strlen($params['customer']) == 0) ? null : e($params['customer']);
                $user->update();
            }

            return $user;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());        
        }        
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function DeleteUser($id)
    {
        $user = $this->FindUserById($id);
        $user->delete();

        return $user;
    }
}
