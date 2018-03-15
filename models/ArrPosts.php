<?php

namespace app\models;

class ArrPosts extends \yii\base\BaseObject
{
    public $arrTitleRu = array(
        "жесть",
        "удивительно",
        "снова",
        "совсем",
        "шок",
        "случай",
        "сразу",
        "событие",
        "начало",
        "вирус"
    );

    public $arrTitleEng = array(
        "currency",
        "amazing",
        "again",
        "absolutely",
        "shocking",
        "case",
        "immediately",
        "event",
        "beginning",
        "virus"
    );

    public $arrTextRu = array(
        "один", "еще", "бы", "такой", "только", "себя", "свое", "какой", "когда", "уже",
        "для", "вот", "кто", "да", "говорить", "год", "знать", "мой", "до", "или", "если", "время",
        "рука", "нет", "самый", "ни", "стать", "большой", "даже", "другой", "наш", "свой", "ну",
        "под", "где", "дело", "есть", "сам", "раз", "чтобы", "два", "там", "чем", "глаз", "жизнь",
        "первый", "день", "тута", "во", "ничто", "потом", "очень", "со", "хотеть", "ли", "при",
        "голова", "надо", "без", "видеть", "идти", "теперь", "тоже", "стоять", "друг", "дом",
        "сейчас", "можно", "после", "слово", "здесь", "думать", "место", "спросить", "через",
        "лицо", "что", "тогда", "ведь", "хороший", "каждый", "новый", "жить", "должный",
        "смотреть", "почему", "потому", "сторона", "просто", "нога", "сидеть", "понять", "иметь",
        "конечный", "делать", "вдруг", "над", "взять", "никто", "сделать"
    );

    public $arrTextEng = array(
        "one", "yet", "would", "such", "only", "yourself", "his", "what", "when", "already",
        "for", "behold", "Who", "yes", "speak", "year", "know", "my", "before", "or", "if", "time", "arm",
        "no", "most", "nor", "become", "big", "even", "other", "our", "his", "well", "under", "where",
        "a business", "there is", "himself", "time", "that", "two", "there", "than", "eye", "a life", "first",
        "day", "mulberry", "in", "nothing", "later", "highly", "with", "to want", "whether", "at", "head",
        "need", "without", "see", "go", "now", "also", "stand", "friend", "house", "now", "can", "after",
        "word", "here", "think", "a place", "ask", "across", "face", "what", "then", "after all", "good",
        "each", "new", "live", "due", "look", "why", "because", "side", "just", "leg", "sit", "understand",
        "have", "finite", "do", "all of a sudden", "above", "to take", "no one", "make"
    );

    public function getArrTitleRu()
    {
        return $this->arrTitleRu;
    }

    public function getArrTitleEng()
    {
        return $this->arrTitleEng;
    }

    public function getArrTextRu()
    {
        return $this->arrTextRu;
    }

    public function getArrTextEng()
    {
        return $this->arrTextEng;
    }

}
