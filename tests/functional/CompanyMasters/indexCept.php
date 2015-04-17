<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('企業管理 一覧画面のテスト');

$I->amGoingTo('一覧の表示');
$I->amOnPage('/companyMasters');
$I->expect('初期データが表示されること');
$I->see('企業一覧', 'h2');
$I->see('ユヒーロ', '#company-list tr:nth-child(1) td:nth-child(2)');
$I->see('NGC', '#company-list tr:nth-child(2) td:nth-child(2)');
$I->see('お茶ゼミ', '#company-list tr:nth-child(3) td:nth-child(2)');

$I->amGoingTo('新規登録ページへ遷移');
$I->click('新規登録');
$I->expect('入力欄が初期表示状態であること');
$I->see('企業登録', 'h2');
$I->seeInField(['name' => 'name'], '');

$I->amGoingTo('企業詳細ページへ遷移');
$I->amOnpage('/companyMasters');
$I->click('ユヒーロ', '#company-list');
$I->expect('選択したプロジェクトの情報を元に初期化されていること');
$I->see('ユヒーロ', 'h2');

$I->amGoingTo('企業編集ページへ遷移');
$I->amOnpage('/companyMasters');
$I->click('編集', '#company-list tr:nth-child(2)');
$I->expect('選択したプロジェクトの情報を元に初期化されていること');
$I->see('企業編集', 'h2');
$I->seeInField(['name' => 'name'], 'NGC');

$I->amGoingTo('企業削除ページへ遷移');
$I->amOnpage('/companyMasters');
$I->click('削除', '#company-list tr:nth-child(2)');
$I->expect('選択したプロジェクトの情報を元に初期化されていること');
$I->see('企業削除確認', 'h2');
$I->see('NGC', '#company-detail tr:nth-child(1) td:nth-child(2)');

