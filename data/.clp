;***********************************************************************************
; Наименование базы знаний: База знаний 30483461991
;***********************************************************************************
; Описание: База знаний добавлена из файла
;***********************************************************************************
;**************Templates*********************************************************
(deftemplate Vneshniy-osmotr ;
(slot Vid (default "ВИДИМЫЕ НЕИСПРАВНОСТИ ОТСУТСТВУЮТ;НЕ РАБОТАЕТ ОТПАРИВАТЕЛЬ УТЮГА;ПОДОШВА НЕ НАГРЕВАЕТСЯ ДО НУЖНОЙ ТЕМПЕРАТУРЫ"));
)
(deftemplate Neispravnost ;
(slot Naimenovanie (default "НЕИСПРАВНОСТЬ В СЕТЕВОМ ШНУРЕ;СИСТЕМА ОТПАРИВАНИЯ;НАГРЕВАТЕЛЬНЫЙ ЭЛЕМЕНТ(ТЭН)"));
)
(deftemplate Diagnostika ;
(slot Rezultat (default "ШНУР ПЕРЕТЕРСЯ В МЕСТЕ ВХОДА В ЭЛЕКТРИЧЕСКУЮ ВИЛКУ;ЗАСОРИЛИСЬ ВНУТРЕННИЕ ПОЛОСТИ ПАРООБРАЗОВАНИЯ;ПОДГОРЕВШИЕ КОНТАКТЫ"));
)
(deftemplate Prichina-neispravnosti ;
(slot Prichina (default "ШНУР ВЫХОДИТ ИЗ СТРОЯ ИЗ-ЗА КОРОТКОГО СРОКА СЛУЖБЫ;НИЗКОЕ КАЧЕСТВО ВОДЫ;ВЫХОД ИЗ СТРОЯ КОНДЕНСАТОРА"));
)
(deftemplate Remont ;
(slot Metod (default "УКОРОТИТЕ ШНУР НА 10-15СМ ИЛИ ЗАМЕНИТЕ НА НОВЫЙ;ИСПОЛЬЗОВАТЬ СПЕЦИАЛЬНЫЕ СРЕДСТВА ОЧИСТКИ НАКИПИ;ЗАМЕНА КОНДЕНСАТОРА И ЗАЧИСТКА КОНТАКТОВ НАЖДАЧНОЙ БУМАГОЙ"));
)
;**************Facts*************************************************************
(deffacts initial-settings
(Vneshniy-osmotr ;
(Vid ВИДИМЫЕ НЕИСПРАВНОСТИ ОТСУТСТВУЮТ)
)
(Neispravnost ;
(Naimenovanie НЕИСПРАВНОСТЬ В СЕТЕВОМ ШНУРЕ)
)
)
;**************Rules*************************************************************
(defrule Vneshniy-osmotr+Neispravnost>Diagnostika-1 "Описание правила: Внешний осмотр+Неисправность>Диагностика_1"
(Vneshniy-osmotr ; 
(Vid ВИДИМЫЕ НЕИСПРАВНОСТИ ОТСУТСТВУЮТ)
)
(Neispravnost ; 
(Naimenovanie НЕИСПРАВНОСТЬ В СЕТЕВОМ ШНУРЕ)
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie НЕИСПРАВНОСТЬ В СЕТЕВОМ ШНУРЕ)
))
)
(defrule Diagnostika>Prichina-neispravnosti-1 "Описание правила: Диагностика>Причина неисправности_1"
(Diagnostika ; 
(Rezultat ШНУР ПЕРЕТЕРСЯ В МЕСТЕ ВХОДА В ЭЛЕКТРИЧЕСКУЮ ВИЛКУ)
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat ШНУР ПЕРЕТЕРСЯ В МЕСТЕ ВХОДА В ЭЛЕКТРИЧЕСКУЮ ВИЛКУ)
))
)
(defrule Prichina-neispravnosti>Remont-1 "Описание правила: Причина неисправности>Ремонт_1"
(Prichina-neispravnosti ; 
(Prichina ШНУР ВЫХОДИТ ИЗ СТРОЯ ИЗ-ЗА КОРОТКОГО СРОКА СЛУЖБЫ)
)
=>
(assert 
(Remont ; 
(Prichina ШНУР ВЫХОДИТ ИЗ СТРОЯ ИЗ-ЗА КОРОТКОГО СРОКА СЛУЖБЫ)
))
)
(defrule Vneshniy-osmotr+Neispravnost>Diagnostika-2 "Описание правила: Внешний осмотр+Неисправность>Диагностика_2"
(Vneshniy-osmotr ; 
(Vid НЕ РАБОТАЕТ ОТПАРИВАТЕЛЬ УТЮГА)
)
(Neispravnost ; 
(Naimenovanie СИСТЕМА ОТПАРИВАНИЯ)
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie СИСТЕМА ОТПАРИВАНИЯ)
))
)
(defrule Diagnostika>Prichina-neispravnosti-2 "Описание правила: Диагностика>Причина неисправности_2"
(Diagnostika ; 
(Rezultat ЗАСОРИЛИСЬ ВНУТРЕННИЕ ПОЛОСТИ ПАРООБРАЗОВАНИЯ)
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat ЗАСОРИЛИСЬ ВНУТРЕННИЕ ПОЛОСТИ ПАРООБРАЗОВАНИЯ)
))
)
(defrule Prichina-neispravnosti>Remont-2 "Описание правила: Причина неисправности>Ремонт_2"
(Prichina-neispravnosti ; 
(Prichina НИЗКОЕ КАЧЕСТВО ВОДЫ)
)
=>
(assert 
(Remont ; 
(Prichina НИЗКОЕ КАЧЕСТВО ВОДЫ)
))
)
(defrule Vneshniy-osmotr+Neispravnost>Diagnostika-3 "Описание правила: Внешний осмотр+Неисправность>Диагностика_3"
(Vneshniy-osmotr ; 
(Vid ПОДОШВА НЕ НАГРЕВАЕТСЯ ДО НУЖНОЙ ТЕМПЕРАТУРЫ)
)
(Neispravnost ; 
(Naimenovanie НАГРЕВАТЕЛЬНЫЙ ЭЛЕМЕНТ(ТЭН))
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie НАГРЕВАТЕЛЬНЫЙ ЭЛЕМЕНТ(ТЭН))
))
)
(defrule Diagnostika>Prichina-neispravnosti-3 "Описание правила: Диагностика>Причина неисправности_3"
(Diagnostika ; 
(Rezultat ПОДГОРЕВШИЕ КОНТАКТЫ)
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat ПОДГОРЕВШИЕ КОНТАКТЫ)
))
)
(defrule Prichina-neispravnosti>Remont-3 "Описание правила: Причина неисправности>Ремонт_3"
(Prichina-neispravnosti ; 
(Prichina ВЫХОД ИЗ СТРОЯ КОНДЕНСАТОРА)
)
=>
(assert 
(Remont ; 
(Prichina ВЫХОД ИЗ СТРОЯ КОНДЕНСАТОРА)
))
)
