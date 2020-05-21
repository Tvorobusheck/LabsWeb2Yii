<?php

use yii\helpers\Url;

class LoginCest
{
    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->see('Login', 'h1');
	$I->see('Login', 'button');

        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'klimenko');
        $I->fillField('input[name="LoginForm[password]"]', 'qwerty');
        $I->click('login-button');
  
        $I->expectTo('see user info');
        $I->see('Logout');
    }
}
