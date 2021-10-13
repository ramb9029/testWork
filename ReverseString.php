<?php
//namespace App;


class ReverseString
{
    /**
     * @var string
     */
    public string $reverseString;


    /**
     * @return string
     */
    public function getReverseWordsString(): string
    {
        if (!isset($this->reverseString)){
            return 'fail';
        }
        $string = explode(' ', $this->reverseString);
        foreach ($string as &$item){
            $item = $this->getReverseWord($item);
        }
        unset($item);
        $string = implode(' ', $string);
        return $string;
    }

    /**
     * @param string $word
     * @return string
     */
    private function getReverseWord(string $word): string
    {
        $regx = '/[A-ZА-ЯЁ]/u';
        $word = mb_str_split($word);
        $count = count($word)-1;
        for ($i = 0; $i <= $count; $i++){
            if (!preg_match('/[a-zA-Zа-яёА-ЯЁ]/u', $word[$count])){
                $count--;
                $i--;
                continue;
            }
            if (preg_match($regx, $word[$count]) and preg_match($regx, $word[$i])) {
                $word = $this->getReverseCharOnArray($word, $i, $count);
                $count--;
                continue;
            }
            if (preg_match($regx, $word[$count])) {
                $word = $this->getReverseCharOnArray($word, $i, $count, true);
                $count--;
                continue;
            }
            if (preg_match($regx, $word[$i])) {
                $word = $this->getReverseCharOnArray($word, $count, $i, true);
                $count--;
                continue;
            }
            $word = $this->getReverseCharOnArray($word, $i, $count);
            $count--;
        }
        $word = implode($word);
        return $word;
    }

    /**
     * @return array
     */
    private function getReverseCharOnArray(): array
    {
        $string = func_get_arg(0);
        $firstPosition = func_get_arg(1);
        $secondPosition = func_get_arg(2);
        $reverse = $string[$firstPosition];
        $string[$firstPosition] = $string[$secondPosition];
        $string[$secondPosition] = $reverse;
        if (func_num_args() > 3 and func_get_arg(3)) {
            $string[$firstPosition] = mb_strtolower($string[$firstPosition]);
            $string[$secondPosition] = mb_strtoupper($string[$secondPosition]);
        }
        return $string;
    }
}
