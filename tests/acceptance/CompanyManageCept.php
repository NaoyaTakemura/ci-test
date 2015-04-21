<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('企業追加のシナリオテスト');

$I->amGoingTo('企業一覧を表示');
$I->amOnpage('/companyMasters');
$I->expect('初期データが表示されること');
$I->see('企業一覧', 'h2');
$I->see('ユヒーロ', '#company-list tr:nth-child(1) td:nth-child(2)');
$I->see('NGC', '#company-list tr:nth-child(2) td:nth-child(2)');
$I->see('お茶ゼミ', '#company-list tr:nth-child(3) td:nth-child(2)');

$I->amGoingTo('企業情報の入力');
$I->expect('入力画面が表示されること');
$I->click('新規登録');
$I->seeCurrentUrlEquals('/companyMasters/createInput');
$I->expect('入力欄が初期表示状態であること');
$I->see('企業登録', 'h2');
$I->seeInField(['name' => 'name'], '');
$I->fillField('name', 'テスト企業1');
$I->click('確認画面へ');

$I->amGoingTo('企業情報確認画面の表示');
$I->expect('確認画面が表示されること');
$I->seeCurrentUrlEquals('/companyMasters/createConfirm');
$I->expect('入力した値が表示されていること');
$I->see('テスト企業1', '#company-create tr td');
$I->click('登録');

$I->amGoingTo('企業詳細画面の表示');
$I->seeCurrentUrlEquals('/companyMasters/show/4');
$I->see('登録が完了しました');
$I->see('テスト企業1', '#company_table tr:nth-child(1) td:nth-child(2)');



