<?php
/**
 * Template File Doc Comment
 * 
 * PHP version 7
 */
namespace ImportData;

/**
 *  You can use this class for importing Excel, words and text data.
 * 
 * @category This is a new import data category
 * @author   Md. Rafiqul Islam
 * @license  Scuti Ltd.
 * @link     https://scuti.asia.com
 */
class ImportData 
{
    const HHH = 'ok';
    /**
     *  Store the interest of the client
     *
     * @var integer $interest
     */
    private $newOk;

    /**
     *  Calculate the interest dfgdfg
     *
     * @param int $percent How many percentage of interest will be calculated 
     * 
     * @return int
     */
    public function calculateMe($percent)
    {
        return $percent;
    }
}

/**
 *  You can use this class for importing Excel, words and text data.
 * 
 * @category This is a new import data category
 * @author   Md. Rafiqul Islam
 * @license  Scuti Ltd.
 * @link     https://scuti.asia.com
 */
class Json
{
    /**
     *  Calculate the interest dfgdfg
     *
     * @param int $data How many percentage of interest will be calculated 
     * 
     * @return $mix
     */
    public static function from($data)
    {
        return json_encode($data);
    }
}

/**
 *  You can use this class for importing Excel, words and text data.
 * 
 * @category This is a new import data category
 * @author   Md. Rafiqul Islam
 * @license  Scuti Ltd.
 * @link     https://scuti.asia.com
 */
class UserRequest
{
    /**
     *  Store the interest of the client
     *
     * @var array $rules
     */
    protected static $rules = [
        'name' => 'string',
        'email' => 'string'
    ];

    /**
     *  Calculate the interest dfgdfg
     *
     * @param array $data How many percentage of interest will be calculated 
     * 
     * @return void
     */
    public static function validate($data)
    {
        foreach ($data as $property => $type) {
            if (gettype($data[$property]) !== $type) {
                throw new \Exception(
                    "User property {$property} must be Of type {$type}"
                );
            }
        }
        return;
    }
}

/**
 *  You can use this class for importing Excel, words and text data.
 * 
 * @category This is a new import data category
 * @author   Md. Rafiqul Islam
 * @license  Scuti Ltd.
 * @link     https://scuti.asia.com
 */
class User
{
    /**
     *  Store the interest of the client
     *
     * @var string $name
     */
    public $name;
    /**
     *  Store the interest of the client
     *
     * @var string $email
     */
    public $email;


    /**
     *  Calculate the interest dfgdfg
     * 
     * @param array $data How many percentage of interest will be calculated
     */
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    /**
     *  Calculate the interest dfgdfg
     * 
     * @return $mix
     */
    public function formatJson()
    {
        return json_encode(['name' => $this->name, 'email' => $this->email]);
    }

    /**
     *  Calculate the interest dfgdfg
     *
     * @param array $data How many percentage of interest will be calculated 
     * 
     * @return void
     */
    public function validate($data)
    {
        if (!isset($data['name'])) {
            throw new \Exception("Bad Request, User requires a name");
        }

        if (!isset($data['email'])) {
            throw new \Exception("Bad Request, User requires a email");
        }
        return;
    }
}
?>
