<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('企業 新規作成のテスト');

$I->amGoingTo('新規登録ページの表示');
$I->amOnPage('/companyMasters/createInput');
$I->expect('入力欄が初期表示状態であること');
$I->see('企業登録', 'h2');
$I->seeInField(['name' => 'name'], '');

$I->amGoingTo('何も入力しないでフォームを送信');
$I->click('確認画面へ');
$I->expect('入力画面へ戻り、企業名欄に必須エラーが表示されること');
$I->seeCurrentUrlEquals('/companyMasters/createInput');
$I->see('The name field is required.', '#company-create tr:nth-child(1) td');
$I->expect('入力値が保持されていること');
$I->seeInField('name', '');

$I->amGoingTo('企業名を文字数オーバーにしてフォームを送信');
$I->fillField('name', '123456789012345678901234567890123456789012345678901234567890');
$I->click('確認画面へ');
$I->expect('入力画面へ戻り、企業名欄に文字数オーバーエラーが表示されること');
$I->seeCurrentUrlEquals('/companyMasters/createInput');
$I->see('The name must be between 1 and 50 characters.', '#company-create tr:nth-child(1) td');
$I->expect('入力値が保持されていること');
$I->seeInField('name', '123456789012345678901234567890123456789012345678901234567890');

$I->amGoingTo('既に登録されている企業は重複エラーとなること');
$I->fillField('name', 'NGC');
$I->click('確認画面へ');
$I->expect('入力画面へ戻り、企業名欄に重複エラーが表示されること');
$I->seeCurrentUrlEquals('/companyMasters/createInput');
$I->see('既に登録されています。', '#company-create tr:nth-child(1) td');
$I->expect('入力値が保持されていること');
$I->seeInField('name', 'NGC');

$I->amGoingTo('正しい値を入力して確認画面に遷移すること');
$I->fillField('name', 'test1');
$I->click('確認画面へ');
$I->expect('確認画面が表示されること');
$I->seeCurrentUrlEquals('/companyMasters/createConfirm');
