<?

namespace Username\Vowels\Rest\Controllers;

use \Username\Vowels\Rest\UserNameVowels;

class UserNameVowelsController extends \Bitrix\Main\Engine\Controller {
    public function getUserNameVowelsAction(array $fields) {
        return UserNameVowels::getUserNameVowels($fields);
    }
}