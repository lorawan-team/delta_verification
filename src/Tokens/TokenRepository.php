<?php namespace Delta\DeltaVerification\Tokens;

use Delta\DeltaVerification\Tokens\Token;
use Delta\DeltaVerification\AbstractRepository;
use Illuminate\Events\Dispatcher;

class TokenRepository extends AbstractRepository implements TokenRepositoryInterface
{
    protected $model = Token::class;

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
     * find the right auth token based on given vars
     *
     * @param  String $token
     * @param  int    $accountId [description]
     * @return boolean
     */
    public function verifyUserByTokenAndAccountId($token, $accountId)
    {
        $model = $this->createModel()->
            where('id', $token)->
            where('user_id', $accountId)->
            first();

        if ($model) {
            return $model->getRevoked();
        }
        return false;
    }

    /**
     * find the user based on given token
     *
     * @param  String $token
     * @return boolean
     */
    public function findUserByToken($token)
    {
        $token =  $this->createModel()->
            where('id', $token)->
            first();

        if (is_null($token)) {
            throw new \Exception("cant find token", 1);
        }

        return $token->user();
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
