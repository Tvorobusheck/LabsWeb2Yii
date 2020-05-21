<?php

namespace tests\unit\models;

use app\models\User;
use app\models\UserIdentity;
use app\tests\fixtures\UsersFixture;


class UserTest extends \Codeception\Test\Unit
{

    public function fixtures()
    {
        return [
            'profiles' => [
	    	'class' => UsersFixture::className(),
		       
                // fixture data located in tests/_data/user.php
                'dataFile' => codecept_data_dir() . 'users.php'
	    ],
        ];
    }
    
    public function testFindUserByUsername()
    {
        expect_that($user = UserIdentity::findByUsername('demo'));
        expect_not(UserIdentity::findByUsername('not-demo'));
    }


    

}
