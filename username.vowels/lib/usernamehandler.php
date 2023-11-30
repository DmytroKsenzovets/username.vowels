<?

namespace Username\Vowels;

class UserNameHandler {
    const VOWELS = 'аиоуюяiїєеёыaioeyu';

    public static function getUserVowelsLetters(int $userID) {
        $cache = \Bitrix\Main\Data\Cache::createInstance();
        $cacheTime = 30*60;
        $cacheID = $userID;
        $cacheDir = '/' . get_class();

        if ($cache->initCache($cacheTime, $cacheID, $cacheDir)) {
            return $cache->getVars();
        } elseif ($cache->startDataCache()) {
            $user = \Bitrix\Main\UserTable::getList(array(
                'filter' => array(
                    '=ID' => $userID,
                ),
                'limit'=>1,
                'select' => array('NAME', 'LAST_NAME', 'SECOND_NAME'),
            ));
            if ($arUser = $user->fetch()) {
                $result = self::getVowelsLetters($arUser['NAME'] . $arUser['LAST_NAME'] . $arUser['SECOND_NAME']);
            } else {
                $cache->abortDataCache();
                throw new \Bitrix\Rest\RestException(
                    GetMessage("NO_USER", Array ("#USER_ID#" => $userID)),
                    'NO_USER'
                );
            }
            $cache->endDataCache($result);
        }
        return $result;
    }

    private static function getVowelsLetters(string $string){
        $pattern = '~(?<vowels>[' . self::VOWELS . '])~iu';
        preg_match_all($pattern, mb_strtolower($string), $a);
        return $a["vowels"];
    }

}