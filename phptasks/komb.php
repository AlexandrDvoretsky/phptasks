<?php

//error_reporting(0);
class combinatoricErrorException extends Exception
{
    public function logError($e)
    {
        $date = date('Y-m-d H:i:s (T)');
        $file = __DIR__ . '\errors.txt';
        $strError = $date . "\n" . $e . "\r\n";
        if (file_exists($file))
            file_put_contents($file, $strError, FILE_APPEND);
    }

    public function getErrorList()
    {
        echo "\n Error.txt:";
        $file = __DIR__ . '\errors.txt';
        if (file_exists($file))
            return "<pre>" . file_get_contents($file) . "</pre>";
    }
}

class combinatoric
{
    public $chars = array();
    public $length = '';

    function __construct($chars, $length)
    {
        if ($this->checkLength($chars, $length)) {
            $this->chars = str_split($chars);
            $this->length = $length;
        }
    }

    public function checkLength($str, $len)
    {
        if (count(str_split($str)) < $len) {
            throw  new combinatoricErrorException('Длина слова больше числа символов в строке!');
        } else {
            return true;
        }
    }

    public function checkUniqueChars($chars, $key)
    {
        $arChars = str_split($chars);
        if (in_array($key, $arChars)) return false;
        else return true;
    }

    public function factorial($number)
    {
        if ($number <= 1) return 1;
        else return ($number * $this->factorial($number - 1));
    }

    public function getUniqueWordCnt()
    {
        $elementCnt = count($this->chars);
        return $this->factorial($elementCnt) / $this->factorial(($elementCnt - $this->length));
    }

    public function sampling($combinations = array(), $length = false)
    {
        $new_combinations = array();

        if (!$combinations) $combinations = $this->chars;
        if (!$length) $length = $this->length;
        if ($length == 1) return $combinations;

        foreach ($combinations as $key_comb => $val_comb) {
            foreach ($this->chars as $key_char => $val_char) {
                if ($this->checkUniqueChars($key_comb, $key_char))
                    $new_combinations[$key_comb . $key_char] = $val_comb . $val_char;
            }
        }
        return $this->sampling($new_combinations, $length - 1);
    }
}

try {
    $chars = new combinatoric('222', 3);
    $output = $chars->sampling();
    echo $chars->getUniqueWordCnt();

    echo "<pre>";
    var_dump($output);
    echo "</pre>";
} catch (combinatoricErrorException $e) {
    echo $e;
    $e->logError($e);
    echo $e->getErrorList();
}

?>