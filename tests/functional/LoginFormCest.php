<?php
use app\tests\fixtures\UsersFixtures;

class LoginFormCest
{
    public function fixtures()
    {
        return [
            'profiles' => [
	    	'class' => UsersFixtures::className(),
		       
                // fixture data located in tests/_data/user.php
                'dataFile' => codecept_data_dir() . 'users.php'
	    ],
        ];
    }

    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');

    }


    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'demo',
            'LoginForm[password]' => 'demo',
        ]);
        $I->see('Logout (demo)');
        $I->dontSeeElement('form#login-form');              
    }

    
    public function loginFixtures(\FunctionalTester $I)
    {
	$this->fixtures();
    }
}