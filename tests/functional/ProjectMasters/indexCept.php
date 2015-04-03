<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('プロジェクト管理 一覧画面のテスト');

$I->amGoingTo('一覧の表示');
$I->amOnPage('/projectMasters');
$I->expect('初期データが表示されること');
$I->see('プロジェクト一覧', 'h2');
$I->see('GA', '#project-list tr:nth-child(1) td:nth-child(2)');
$I->see('CSC', '#project-list tr:nth-child(2) td:nth-child(2)');
$I->see('navy', '#project-list tr:nth-child(3) td:nth-child(2)');
$I->see('サイトリニューアル', '#project-list tr:nth-child(4) td:nth-child(2)');

$I->amGoingTo('新規登録ページへ遷移');
$I->click('新規登録');
$I->expect('入力欄が初期表示状態であること');
$I->see('プロジェクト登録', 'h2');
//selectedを付与されたoptionが存在しないことを確認するには？
$I->dontSeeOptionIsSelected('form select[name=company_id]', '');
$I->seeInField(['name' => 'name'], '');

$I->amGoingTo('プロジェクト詳細ページへ遷移');
$I->amOnpage('/projectMasters');
$I->click('GA', '#project-list');
$I->expect('選択したプロジェクトの情報を元に初期化されていること');
$I->see('GA', 'h2');

$I->amGoingTo('プロジェクト編集ページへ遷移');
$I->amOnpage('/projectMasters');
$I->click('編集', '#project-list tr:nth-child(2)');
$I->expect('選択したプロジェクトの情報を元に初期化されていること');
$I->see('プロジェクト編集', 'h2');
$I->seeOptionIsSelected('form select[name=company_id]', 'NGC');
$I->seeInField(['name' => 'name'], 'CSC');

$I->amGoingTo('プロジェクト削除ページへ遷移');
$I->amOnpage('/projectMasters');
$I->click('削除', '#project-list tr:nth-child(2)');
$I->expect('選択したプロジェクトの情報を元に初期化されていること');
$I->see('プロジェクト削除確認', 'h2');
$I->see('CSC', '#project-detail tr:nth-child(1) td:nth-child(2)');
$I->see('NGC', '#project-detail tr:nth-child(1) td:nth-child(3)');
