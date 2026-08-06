<?php
declare(strict_types=1);

define('MAIL_TO', 'info@artsakura1183.com');
define('MAIL_FROM', 'info@artsakura1183.com');
define('MAIL_SUBJECT', '【ARTさくら】青葉区広告LPから無料相談がありました');
define('THANKS_PAGE', 'thanks.html');
define('FORM_PAGE', 'index.html');

mb_language('Japanese');
mb_internal_encoding('UTF-8');

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function field(string $key): string
{
    return trim((string) ($_POST[$key] ?? ''));
}

function has_header_injection(string $value): bool
{
    return (bool) preg_match('/[\r\n]/', $value);
}

function render_error_page(array $errors): void
{
    http_response_code(400);
    header('Content-Type: text/html; charset=UTF-8');

    echo '<!DOCTYPE html><html lang="ja"><head><meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>入力内容をご確認ください｜アートさくら</title>';
    echo '<style>body{font-family:sans-serif;line-height:1.8;padding:40px 20px;max-width:640px;margin:0 auto;color:#26313F}a{color:#132A47;font-weight:700}</style>';
    echo '</head><body>';
    echo '<h1>入力内容をご確認ください</h1><ul>';

    foreach ($errors as $error) {
        echo '<li>' . h($error) . '</li>';
    }

    echo '</ul><p><a href="' . h(FORM_PAGE) . '#contact-form">フォームに戻る</a></p>';
    echo '<p>お急ぎの場合は、0120-007-368 へお電話ください。</p>';
    echo '</body></html>';
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . FORM_PAGE);
    exit;
}

if (field('website') !== '') {
    header('Location: ' . THANKS_PAGE);
    exit;
}

$name = field('name');
$kana = field('kana');
$tel = field('tel');
$email = field('email');
$area = field('area');
$contactMethod = field('contact_method');
$message = field('message');

$errors = [];

if ($name === '') {
    $errors[] = 'お名前を入力してください。';
}

if ($kana === '') {
    $errors[] = 'フリガナを入力してください。';
} elseif (!preg_match('/^[ァ-ヶーｦ-ﾟ\s　]+$/u', $kana)) {
    $errors[] = 'フリガナはカタカナで入力してください。';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'メールアドレスの形式をご確認ください。';
}

if ($contactMethod === '') {
    $errors[] = '希望する連絡方法を選択してください。';
} elseif ($contactMethod === '電話' && $tel === '') {
    $errors[] = '電話での連絡をご希望の場合は、電話番号を入力してください。';
} elseif ($contactMethod === 'メール' && $email === '') {
    $errors[] = 'メールでの連絡をご希望の場合は、メールアドレスを入力してください。';
} elseif ($contactMethod === 'LINE' && $tel === '' && $email === '') {
    $errors[] = 'LINE希望の場合も、電話番号またはメールアドレスのどちらかを入力してください。';
}

if ($message === '') {
    $errors[] = 'ご相談内容を入力してください。';
}

foreach ([$name, $kana, $tel, $email, $area, $contactMethod] as $value) {
    if (has_header_injection($value)) {
        $errors[] = '入力内容に使用できない文字が含まれています。';
        break;
    }
}

if ($errors !== []) {
    render_error_page($errors);
    exit;
}

$submittedAt = date('Y-m-d H:i:s');
$remoteAddr = (string) ($_SERVER['REMOTE_ADDR'] ?? '');
$referer = (string) ($_SERVER['HTTP_REFERER'] ?? '');

$body = "青葉区広告LPより無料相談フォームが送信されました。\n\n";
$body .= "送信日時: {$submittedAt}\n";
$body .= "お名前: {$name}\n";
$body .= "フリガナ: {$kana}\n";
$body .= "電話番号: {$tel}\n";
$body .= "メールアドレス: " . ($email !== '' ? $email : '未入力') . "\n";
$body .= "ご住所または対応エリア: " . ($area !== '' ? $area : '未入力') . "\n";
$body .= "希望する連絡方法: {$contactMethod}\n\n";
$body .= "ご相談内容:\n{$message}\n\n";
$body .= "----\n";
$body .= "送信元IP: {$remoteAddr}\n";
$body .= "参照元: {$referer}\n";

$headers = [];
$headers[] = 'From: ' . MAIL_FROM;
$headers[] = 'Reply-To: ' . ($email !== '' ? $email : MAIL_FROM);
$headers[] = 'Content-Type: text/plain; charset=ISO-2022-JP';
$headers[] = 'Content-Transfer-Encoding: 7bit';

$sent = mb_send_mail(
    MAIL_TO,
    MAIL_SUBJECT,
    $body,
    implode("\r\n", $headers),
    '-f ' . MAIL_FROM
);

if ($sent) {
    header('Location: ' . THANKS_PAGE);
    exit;
}

http_response_code(500);
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html lang="ja"><head><meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>送信エラー｜アートさくら</title>';
echo '<style>body{font-family:sans-serif;line-height:1.8;padding:40px 20px;max-width:640px;margin:0 auto;color:#26313F}a{color:#132A47;font-weight:700}</style>';
echo '</head><body>';
echo '<h1>送信に失敗しました</h1>';
echo '<p>恐れ入りますが、時間をおいて再度お試しいただくか、お電話（0120-007-368）またはLINEでご相談ください。</p>';
echo '<p><a href="' . h(FORM_PAGE) . '#contact-form">フォームに戻る</a></p>';
echo '</body></html>';
