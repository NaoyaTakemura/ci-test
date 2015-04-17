<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('新規登録確認画面のテスト');

$I->amGoingTo('確認画面の表示');
$I->amOnPage('/companyMasters/createInput');
$I->fillField('name', 'テスト企業1');
$I->click('確認画面へ');

$I->expect('入力値を元に画面が表示されること');
$I->see('企業登録', 'h2');
$I->see('テスト企業1', '#company-create tr:nth-child(1) td:nth-child(2)');

$I->expect('入力値を元に画面が表示されること');
