<?php 

use yii\helpers\Url;

class HellCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function loginAndLogoutTest(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->see('Login', 'h1');
	$I->see('Login', 'button');

        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'demo');
        $I->fillField('input[name="LoginForm[password]"]', 'demo');
        $I->click('login-button');
        $I->expectTo('see user info');
  	$I->see('Images');
        $I->see('Logout');
	$I->click('Logout');
    }
    
}
