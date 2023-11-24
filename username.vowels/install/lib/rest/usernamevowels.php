<?

namespace Username\Vowels\Rest;

use \Username\Vowels\UserNameHandler;

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

    public static function getUserNameVowels(array $query) {
        $result = array();
        if(isset($query["user_id"])) {
            if(intval($query["user_id"]) > 0) {
                $result = UserNameHandler::getUserVowelsLetters(intval($query["user_id"]));
            } else {
                self::returnExeptionNotPositiveParam();
            }
        } elseif(isset($query["user_ID"])) {
            if(intval($query["user_ID"]) > 0) {
                $result = UserNameHandler::getUserVowelsLetters(intval($query["user_ID"]));
            } else {
                self::returnExeptionNotPositiveParam();
            }
        } elseif(isset($query["userid"])) {
            if(intval($query["userid"]) > 0) {
                $result = UserNameHandler::getUserVowelsLetters(intval($query["userid"]));
            } else {
                self::returnExeptionNotPositiveParam();
            }
        } elseif(isset($query["userID"])) {
            if(intval($query["userID"]) > 0) {
                $result = UserNameHandler::getUserVowelsLetters(intval($query["userID"]));
            } else {
                self::returnExeptionNotPositiveParam();
            }
        } elseif(isset($query["id"])) {
            if(intval($query["id"]) > 0) {
                $result = UserNameHandler::getUserVowelsLetters(intval($query["id"]));
            } else {
                self::returnExeptionNotPositiveParam();
            }
        } elseif(isset($query["ID"])) {
            if(intval($query["ID"]) > 0) {
                $result = UserNameHandler::getUserVowelsLetters(intval($query["ID"]));
            } else {
                self::returnExeptionNotPositiveParam();
            }
        } else {
            throw new \Bitrix\Rest\RestException(
                GetMessage("NO_PARAM"),
                "NO_PARAM"
			);
        }
        return $result;
    }

    private static function returnExeptionNotPositiveParam() {
        throw new \Bitrix\Rest\RestException(
            GetMessage("NOT_POSITIVE"),
            "NOT_POSITIVE"
		);
    }
}
