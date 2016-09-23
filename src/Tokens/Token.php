<?php namespace Delta\DeltaVerification\Tokens;

use Delta\DeltaVerification\AbstractModel;
use Delta\DeltaVerification\Users\User;

class Token extends AbstractModel implements TokenInterface
{
    protected $table = 'oauth_access_tokens';

    public function getRevoked()
    {
        return $this->getAttribute('revoked');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->getResults();
    }
}
