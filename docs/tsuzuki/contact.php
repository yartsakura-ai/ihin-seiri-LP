<?php
declare(strict_types=1);

/**
 * 都筑区LP お問い合わせフォーム送信処理
 * エックスサーバー等のPHP動作環境にアップロードしてご利用ください。
 * GitHub Pagesなど静的ホスティングではPHPが動作しないため、このファイルは実行されません。
 */

// ここに送信先メールアドレスを設定してください
define('MAIL_TO', 'info@example.com');
define('MAIL_SUBJECT', '【都筑区LP】お問い合わせがありました');
define('THANKS_PAGE', 'thanks.html');
define('FORM_PAGE', 'index.html');

mb_language('Japanese');
mb_internal_encoding('UTF-8');

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function has_header_injection(string $value): bool
{
    return (bool) preg_match('/[\r\n]/', $value);
}

function render_error_page(array $errors): void
{
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html><html lang="ja"><head><meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>入力内容をご確認ください｜株式会社アートさくら</title></head><body style="font-family:sans-serif;padding:40px 20px;max-width:520px;margin:0 auto;line-height:1.8;">';
    echo '<h1 style="font-size:1.2rem;">入力内容をご確認ください</h1><ul>';
    foreach ($errors as $error) {
        echo '<li>' . h($error) . '</li>';
    }
    echo '</ul><p><a href="' . h(FORM_PAGE) . '#contact-form">フォームに戻る</a></p>';
    echo '</body></html>';
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . FORM_PAGE);
    exit;
}

// 簡易スパム対策（ハニーポット項目に値が入っていたら送信しない）
if (trim($_POST['website'] ?? '') !== '') {
    header('Location: ' . THANKS_PAGE);
    exit;
}

$name          = trim((string) ($_POST['name'] ?? ''));
$tel           = trim((string) ($_POST['tel'] ?? ''));
$email         = trim((string) ($_POST['email'] ?? ''));
$contactMethod = trim((string) ($_POST['contact_method'] ?? ''));
$message       = trim((string) ($_POST['message'] ?? ''));

$errors = [];

if ($name === '') {
    $errors[] = 'お名前を入力してください。';
}
if ($tel === '') {
    $errors[] = '電話番号を入力してください。';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = '正しいメールアドレスを入力してください。';
}
if ($contactMethod === '') {
    $errors[] = '希望連絡方法を選択してください。';
}
if ($message === '') {
    $errors[] = 'ご相談内容を入力してください。';
}

foreach ([$name, $tel, $email, $contactMethod, $message] as $value) {
    if (has_header_injection($value)) {
        $errors[] = '不正な入力が検出されました。';
        break;
    }
}

if (!empty($errors)) {
    http_response_code(400);
    render_error_page($errors);
    exit;
}

$body = "都筑区LPよりお問い合わせがありました。\n\n";
$body .= "お名前: {$name}\n";
$body .= "電話番号: {$tel}\n";
$body .= "メールアドレス: {$email}\n";
$body .= "希望連絡方法: {$contactMethod}\n";
$body .= "ご相談内容:\n{$message}\n";

$headers = 'Reply-To: ' . $email;

$sent = mb_send_mail(MAIL_TO, MAIL_SUBJECT, $body, $headers);

if ($sent) {
    header('Location: ' . THANKS_PAGE);
    exit;
}

http_response_code(500);
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html lang="ja"><head><meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>送信エラー｜株式会社アートさくら</title></head><body style="font-family:sans-serif;padding:40px 20px;max-width:520px;margin:0 auto;line-height:1.8;">';
echo '<h1 style="font-size:1.2rem;">送信に失敗しました</h1>';
echo '<p>恐れ入りますが、お電話（045-482-6608）にてご連絡ください。</p>';
echo '</body></html>';
