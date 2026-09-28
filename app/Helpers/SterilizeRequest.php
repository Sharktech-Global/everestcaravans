<?php


namespace App\Helpers;

class SterilizeRequest
{
    public static function sterilize($request)
    {
        $post = $request->all();
        if (array_key_exists("password", $post)) {
            unset($post['password']);
        }
        if (array_key_exists("password_confirmation", $post)) {
            unset($post['password_confirmation']);
        }
        if (array_key_exists("old_password", $post)) {
            unset($post['old_password']);
        }
        if (array_key_exists("confirm_password", $post)) {
            unset($post['confirm_password']);
        }

        return $post;
    }
}
