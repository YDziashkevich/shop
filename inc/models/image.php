<?php
class ImageModel extends Model {
    const FONTS_DIR = 'fonts/';

    protected $font = "corbel.ttf";
    protected $fontSize = 15;
    protected $imgWidth = 60;
    protected $imgHeight = 32;
    protected $length;


    public function __construct($text = '') {
        $this->text = $text;
    }

    public function setText($text){
        $this->text = str_split($text);
        $this->length = strlen($text);
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

        for($i = 0; $i < ($this->length); $i++)
        {
            imagettftext(
                $img,   // холст
                $this->fontSize, // ращмер шрифта
                rand(0, 20),  // угол наклона
                $i*10+5,  // сдвиг по горизонтали
                ($this->imgHeight - rand(0, 20) + $this->fontSize)/2, // сдвиг по вертикали
                $textColor, // цвет текста
                self::FONTS_DIR.$this->font,    // имя шрифта
                $this->text[$i]
            );   // текст
        }


        // заголовк для указания типа
        header('Content-Type: image/png');
        // выводим картинку в поток
        imagepng($img);
        // Очищаем память
        imagedestroy($img);
    }
}