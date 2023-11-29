<?

namespace Username\Vowels\Rest;

use \Username\Vowels\UserNameHandler;

const PARAMS_USER = array(
    'user_id',
    'user_ID',
    'userid',
    'userID',
    'id',
    'ID'
);

class UserNameVowels extends \IRestService {

    public static function OnRestServiceBuildDescription() {
        return array(
            'username.vowels' => array(
                'get.username.vowels' => array(
                    'callback' => array(__CLASS__, 'getUserNameVowelsHandler'),
                    'options' => array(),
                ),
            )
        );
    }

    public static function getUserNameVowelsHandler($query, $n, \CRestServer $server) {
        return self::getUserNameVowels($query);
    }

    private static function checkParamByName(?string $param){
        if(isset($param)) {
            if (intval($param) > 0) {
                return UserNameHandler::getUserVowelsLetters(intval($param));
            } else {
                throw new \Bitrix\Rest\RestException(
                    GetMessage("NOT_POSITIVE"),
                    "NOT_POSITIVE"
                );
            }
        } else {
            return false;
        }
    }

    public static function getUserNameVowels(array $query) {
        $result = array();

        foreach (PARAMS_USER as $paramUser){
            if(($resultByParam=self::checkParamByName($query[$paramUser])) !== false){
                $result = $resultByParam;
                break;
            }
        }

        if (empty($result)) {
            throw new \Bitrix\Rest\RestException(
                GetMessage("NO_PARAM"),
                "NO_PARAM"
            );
        }
        return $result;
    }
}
