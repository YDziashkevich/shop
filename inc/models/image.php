<?php
class ImageModel extends Model {
    const FONTS_DIR = 'fonts/';

    protected $font = "corbel.ttf";
    protected $fontSize = 15;
    protected $imgWidth = 60;
    protected $imgHeight = 32;
    protected $text1;
    protected $text2;
    protected $text3;



    public function __construct($text = '') {
        $this->text = $text;
    }

    public function setText($text){
        $text = str_split($text);
        $this->text1 = $text[0];
        $this->text2 = $text[1];
        $this->text3 = $text[2];
        return $this;
    }

    public function send(){
        // Создаем холст
        $img = imagecreate($this->imgWidth, $this->imgHeight);
        // Создаем цвет фона
        $backGroudColor = imagecolorallocate($img, rand(200,255), rand(200,255), rand(200,255));
        // заполняем фон
        imagefill($img, 0, 0, $backGroudColor);
        // Цвет текста
        $textColor = imagecolorallocate( $img, rand(0, 150), rand(0, 150), rand(0, 150) );
        // рисуем картинку
        imagettftext(
            $img,   // холст
            $this->fontSize, // ращмер шрифта
            rand(-30, 0),  // угол наклона
            10,  // сдвиг по горизонтали
            ($this->imgHeight - rand(0, 12) + $this->fontSize)/2, // сдвиг по вертикали
            $textColor, // цвет текста
            self::FONTS_DIR.$this->font,    // имя шрифта
            $this->text1
        );   // текст
        imagettftext(
            $img,   // холст
            $this->fontSize, // ращмер шрифта
            rand(0, 10),  // угол наклона
            25,  // сдвиг по горизонтали
            ($this->imgHeight - rand(0, 5) + $this->fontSize)/2, // сдвиг по вертикали
            $textColor, // цвет текста
            self::FONTS_DIR.$this->font,    // имя шрифта
            $this->text2
        );
        imagettftext(
            $img,   // холст
            $this->fontSize, // ращмер шрифта
            rand(10, 30),  // угол наклона
            40,  // сдвиг по горизонтали
            ($this->imgHeight + rand(0, 8) + $this->fontSize)/2, // сдвиг по вертикали
            $textColor, // цвет текста
            self::FONTS_DIR.$this->font,    // имя шрифта
            $this->text3
        );
        // заголовк для указания типа
        header('Content-Type: image/png');
        // выводим картинку в поток
        imagepng($img);
        // Очищаем память
        imagedestroy($img);
    }
}