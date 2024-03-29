<?php
namespace app\components;
 
class Utils{
    public static function ru2lat($str)
    { 
    // Русский алфавит
	$ru = array(
		'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
		'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
		'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
		'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
		'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
        'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 
        ' '
	);
	// Английская транслитерация
	$en = array(
		'A', 'B', 'V', 'G', 'D', 'E', 'IO', 'ZH', 'Z', 'I', 'I',
		'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
		'H', 'C', 'CH', 'SH', 'SH', '`', 'Y', '`', 'E', 'IU', 'IA',
		'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'i',
		'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
        'h', 'c', 'ch', 'sh', 'sh', '`', 'y', '`', 'e', 'iu', 'ia',
        '_'
	);
	
    $string = str_replace($ru, $en, $str);
    return($string);
}


public static function transliteration($string) {
	$replace = array(
		"а"=>"a", "А"=>"A",
		"б"=>"b", "Б"=>"B",
		"в"=>"v", "В"=>"V",
		"г"=>"g", "Г"=>"G",
		"д"=>"d", "Д"=>"D",
		"е"=>"e", "Е"=>"E",
		"ж"=>"zh", "Ж"=>"Zh",
		"з"=>"z", "З"=>"Z",
		"и"=>"i", "И"=>"I",
		"й"=>"y", "Й"=>"Y",
		"к"=>"k", "К"=>"K",
		"л"=>"l", "Л"=>"L",
		"м"=>"m", "М"=>"M",
		"н"=>"n", "Н"=>"N",
		"о"=>"o", "О"=>"O",
		"п"=>"p", "П"=>"P",
		"р"=>"r", "Р"=>"R",
		"с"=>"s", "С"=>"S",
		"т"=>"t", "Т"=>"T",
		"у"=>"u", "У"=>"U",
		"ф"=>"f", "Ф"=>"F",
		"х"=>"h", "Х"=>"H",
		"ц"=>"c", "Ц"=>"C",
		"ч"=>"ch", "Ч"=>"Ch",
		"ш"=>"sh", "Ш"=>"Sh",
		"щ"=>"sch", "Щ"=>"Sch",
		"ъ"=>"", "Ъ"=>"",
		"ы"=>"y", "Ы"=>"Y",
		"ь"=>"", "Ь"=>"",
		"э"=>"e", "Э"=>"E",
		"ю"=>"yu", "Ю"=>"Yu",
		"я"=>"ya", "Я"=>"Ya",
	);
	$str = iconv("UTF-8", "UTF-8//IGNORE", strtr($string, $replace));

	return str_replace(' ', '_', $str);
}


}