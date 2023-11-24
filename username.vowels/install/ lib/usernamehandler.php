<?

namespace Username\Vowels;

class UserNameHandler {
    const VOWELS = 'аиоуюяiїєеёыэ';

    public static function getUserVowelsLetters(int $userID) {
        $rsUser = \CUser::GetByID($userID);
        if($arUser = $rsUser->Fetch()){
            return self::getVowelsLetters($arUser['NAME'] . $arUser['LAST_NAME'] . $arUser['SECOND_NAME']);
        } else {
            throw new \Bitrix\Rest\RestException(
                GetMessage("NO_USER", Array ("#USER_ID#" => $userID)),
                'NO_USER'
			);
        }
    }

    private static function getVowelsLetters(string $string){
        $pattern = '~(?<vowels>[' . self::VOWELS . '])~iu';
        preg_match_all($pattern, mb_strtolower($string), $a);
        return $a["vowels"];
    }

}