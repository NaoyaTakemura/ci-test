<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('プロジェクト新規作成のテスト');

$I->amGoingTo('新規登録ページの表示');
$I->amOnPage('/projectMasters/createInput');
$I->expect('入力欄が初期表示状態であること');
$I->see('プロジェクト登録', 'h2');
//selectedを付与されたoptionが存在しないことを確認するには？
$I->dontSeeOptionIsSelected('form select[name=company_id]', '');
$I->seeInField(['name' => 'name'], '');

$I->amGoingTo('何も入力しないでフォームを送信');
$I->click('確認画面へ');
$I->expect('入力画面へ戻り、プロジェクト名欄に必須エラーが表示されること');
$I->seeCurrentUrlEquals('/projectMasters/createInput');
$I->see('The name field is required.', '#project-create tr:nth-child(2) td');
$I->expect('入力値が保持されていること');
$I->seeOptionIsSelected('form select[name=company_id]', 'ユヒーロ');
$I->seeInField('name', '');

$I->amGoingTo('プロジェクト名を文字数オーバーにしてフォームを送信');
$I->fillField('name', '123456789012345678901234567890123456789012345678901234567890');
$I->click('確認画面へ');
$I->expect('入力画面へ戻り、プロジェクト名欄に文字数オーバーエラーが表示されること');
$I->seeCurrentUrlEquals('/projectMasters/createInput');
$I->see('The name must be between 1 and 50 characters.', '#project-create tr:nth-child(2) td');
$I->expect('入力値が保持されていること');
$I->seeOptionIsSelected('form select[name=company_id]', 'ユヒーロ');
$I->seeInField('name', '123456789012345678901234567890123456789012345678901234567890');

$I->amGoingTo('既に登録されているプロジェクトは重複エラーとなること');
$I->fillField('name', 'GA');
$I->click('確認画面へ');
$I->expect('入力画面へ戻り、プロジェクト名欄に重複エラーが表示されること');
$I->seeCurrentUrlEquals('/projectMasters/createInput');
$I->see('既に登録されています。', '#project-create tr:nth-child(2) td');
$I->expect('入力値が保持されていること');
$I->seeOptionIsSelected('form select[name=company_id]', 'ユヒーロ');
$I->seeInField('name', 'GA');

$I->amGoingTo('正しい値を入力して確認画面に遷移すること');
$I->selectOption('company_id', 'NGC');
$I->fillField('name', 'test1');
$I->click('確認画面へ');
$I->expect('確認画面が表示されること');
$I->seeCurrentUrlEquals('/projectMasters/createConfirm');


