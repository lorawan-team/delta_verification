<?php namespace Delta\DeltaVerification\Users;

use Delta\DeltaVerification\Users\User;
use Illuminate\Events\Dispatcher;

class UserRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    /**
     * Bind instances to the class.
     *
     * @param  \Illuminate\Events\Dispatcher  $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * fund user by id
     *
     * @param  int $accountId
     * @return User          
     */
    public function findById($accountId)
    {
        $this->createModel()->
            where('id', $accountId)->
            first();
    }

    /**
     * Returns the model.
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Runtime override of the model.
     *
     * @param  string  $model
     * @return self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }
}
