<?php

Class PaginatorModel extends Model{

    /**
 * Получаем общее количество страниц
 * @param $count количество строк в файле
 * @param $size сколько строк выводится за раз на странице
 * @return int сколько будет всего страниц
 */
    function getCountPage($count, $size = 3){
        $tmp = $count/$size;
        return ((int)$tmp == $tmp) ? $tmp : $tmp + 1;
    }

    /**
     * Возвращает срез сообщений
     * @param $pageNum номер требуемой страницы
     * @param $pageSize количество сообщений на странице
     * @return array выводит срез сообщений
     */
    function getNumPage($pageNum, $pageSize){
        $startIndex = ($pageNum - 1)*$pageSize;
        $lastPage = $startIndex + $pageSize;
        $st = self::getDbc()->prepare("SELECT * FROM ".APP_DB_PREFIX."messages ORDER BY id DESC LIMIT :startIndex, :lastPage");
        $st->bindValue(':startIndex', $startIndex, PDO::PARAM_INT);
        $st->bindValue(':lastPage', $lastPage, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Вывод пагинатора и переключения режим отображения страниц
     * @param $pages кол-во страниц в зависимости от режима
     * @return string вывод html разметки пагинатора и переключения режимов
     */
    function getPaginatorHtml($pages){
        $html = "";
        $html .= "<div><ul class='pagination'>";
        isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
        $pageActive = '';
        for($i = 1; $i <= $pages; $i++){
            if($page == $i){
                $pageActive = 'active';
            }else{
                $pageActive = 'disable';
            }
            $html .= "<li class='$pageActive'><a href='?page=$i'>$i</a></li>";
        }
        $html .= "</ul></div>";
        return $html;
    }

}