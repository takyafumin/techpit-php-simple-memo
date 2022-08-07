<?php

/**
 * 空チェック
 * @param array $errors エラー情報
 * @param mixed $check_value チェック値
 * @param string $message エラーメッセージ
 */
function emptyCheck(array &$errors, $check_value, string $message)
{
    if (empty(trim($check_value))) {
        array_push($errors, $message);
    }
}

/**
 * 最小文字数チェック
 * @param array $errors エラー情報
 * @param mixed $check_value チェック値
 * @param string $message エラーメッセージ
 * @param int $min_size 最小文字数
 */
function stringMinSizeCheck(array &$errors, $check_value, string $message, int $min_size = 8)
{
    if (mb_strlen($check_value) < $min_size) {
        array_push($errors, $message);
    }
}

/**
 * 最大文字数チェック
 * @param array $errors エラー情報
 * @param mixed $check_value チェック値
 * @param string $message エラーメッセージ
 * @param int $max_size 最大文字数
 */
function stringMaxSizeCheck(array &$errors, $check_value, string $message, int $max_size = 255)
{
    if ($max_size < mb_strlen($check_value)) {
        array_push($errors, $message);
    }
}

/**
 * メールアドレスチェック
 * @param array $errors エラー情報
 * @param mixed $check_value チェック値
 * @param string $message エラーメッセージ
 */
function mailAddressCheck(array &$errors, $check_value, string $message)
{
    if (filter_var($check_value, FILTER_VALIDATE_EMAIL) == false) {
        array_push($errors, $message);
    }
}

/**
 * 半角英数字チェック
 * @param array $errors エラー情報
 * @param mixed $check_value チェック値
 * @param string $message エラーメッセージ
 */
function halfAlphanumericCheck(array &$errors, $check_value, string $message)
{
    if (preg_match("/^[a-zA-Z0-9]+$/", $check_value) == false) {
        array_push($errors, $message);
    }
}

/**
 * メールアドレス重複チェック
 * @param array $errors エラー情報
 * @param mixed $check_value チェック値
 * @param string $message エラーメッセージ
 */
function mailAddressDuplicationCheck(array &$errors, $check_value, string $message)
{
    $database_handler = getDatabaseConnection();
    if ($statement = $database_handler->prepare('SELECT id FROM users WHERE email = :user_email')) {
        $statement->bindParam(':user_email', $check_value);
        $statement->execute();
    }

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        array_push($errors, $message);
    }
}
