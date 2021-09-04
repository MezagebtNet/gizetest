<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserPreferencesController extends Controller
{

    public static function changeLanguagePreference($user_id, $lang)
    {
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = User::find($user_id);
        if ($lang == 'en' || $lang == 'am') {
            $user->language_preference = $lang;
        }

        $user->save();

        return true;

    }

    public static function changeThemePreference($user_id, $theme)
    {
        abort_if(\Auth::user()->id != $user_id, Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = User::find($user_id);
        if ($theme == 'light-mode' || $theme == 'dark-mode') {
            $user->theme_preference = $theme;
        }

        $user->save();

        return $theme;

    }
}
