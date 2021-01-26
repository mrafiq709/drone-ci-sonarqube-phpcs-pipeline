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
    private function _calculateInterest($percent)
    {
        for ($i = 0; $i < 10; $i++) { 
            $x = "Hello world!";
            $y = 'Hello world!';

            echo $x;
            echo "<br>"; 
            echo $y;
        }

        switch ($percent) {
            case 'value':
                $x = "Hello world!";
                $y = 'Hello world!';

                echo $x;
                echo "<br>"; 
                echo $y;
                break;
            
            default:
                # code...
                break;
        }

        $test = 1 + $percent;

        $x = "Hello world!";
        $y = 'Hello world!';

        echo $x;
        echo "<br>"; 
        echo $y;
        
        return 0;
    }
}
