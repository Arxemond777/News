<?php

$text = 'Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки. Если вызвана статически, возвращает объект класса DOMDocument или FALSE в случае возникновения ошибки.';

class MyClass {

    public $output = array();

    public function text($text, $stringLength) {
        $words = explode(' ', $text);

        $nextRow = '';
        foreach ($words as $word) {
            $calculatedRow = $nextRow . ' ' . $word;

            if (iconv_strlen($calculatedRow, 'utf-8') <= $stringLength) {
                $nextRow = $calculatedRow;
            } else {
                $this->output[] = trim($nextRow);
                $nextRow = $word;
            }
        }

        $this->output[] = trim($nextRow);

        print_r($this->output);
    }

}

$obj = new MyClass();
$obj->text($text, 20);