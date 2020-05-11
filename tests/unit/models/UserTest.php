<?php

namespace tests\unit\models;

use app\models\User;
use app\models\UserIdentity;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserByUsername()
    {
        expect_that($user = UserIdentity::findByUsername('demo'));
        expect_not(UserIdentity::findByUsername('not-demo'));
    }


    

}
