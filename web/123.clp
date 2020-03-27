;***********************************************************************************
; Наименование базы знаний: База знаний 30483461991
;***********************************************************************************
; Описание: База знаний добавлена из файла
;***********************************************************************************
;**************Templates*********************************************************
(deftemplate Vneshniy-osmotr ;
(slot Vid (default "Видимые неисправности отсутствуют;Не работает отпариватель утюга;Подошва не нагревается до нужной температуры"));
)
(deftemplate Neispravnost ;
(slot Naimenovanie (default "Неисправность в сетевом шнуре;Система отпаривания;Нагревательный элемент(ТЭН)"));
)
(deftemplate Diagnostika ;
(slot Rezultat (default "шнур перетерся в месте входа в электрическую вилку;Засорились внутренние полости парообразования;подгоревшие контакты"));
)
(deftemplate Prichina-neispravnosti ;
(slot Prichina (default "Шнур выходит из строя из-за короткого срока службы;Низкое качество воды;Выход из строя конденсатора"));
)
(deftemplate Remont ;
(slot Metod (default "Укоротите шнур на 10-15см или замените на новый;Использовать специальные средства очистки накипи;Замена конденсатора и зачистка контактов наждачной бумагой"));
)
;**************Facts*************************************************************
(deffacts initial-settings
(Vneshniy-osmotr ;
(Vid Видимые неисправности отсутствуют)
)
(Neispravnost ;
(Naimenovanie Неисправность в сетевом шнуре)
)
)
;**************Rules*************************************************************
(defrule Vneshniy-osmotr+Neispravnost>Diagnostika-1 "Описание правила: Внешний осмотр+Неисправность>Диагностика_1"
(Vneshniy-osmotr ; 
(Vid Видимые неисправности отсутствуют)
)
(Neispravnost ; 
(Naimenovanie Неисправность в сетевом шнуре)
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie Неисправность в сетевом шнуре)
))
)
(defrule Diagnostika>Prichina-neispravnosti-1 "Описание правила: Диагностика>Причина неисправности_1"
(Diagnostika ; 
(Rezultat шнур перетерся в месте входа в электрическую вилку)
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat шнур перетерся в месте входа в электрическую вилку)
))
)
(defrule Prichina-neispravnosti>Remont-1 "Описание правила: Причина неисправности>Ремонт_1"
(Prichina-neispravnosti ; 
(Prichina Шнур выходит из строя из-за короткого срока службы)
)
=>
(assert 
(Remont ; 
(Prichina Шнур выходит из строя из-за короткого срока службы)
))
)
(defrule Vneshniy-osmotr+Neispravnost>Diagnostika-2 "Описание правила: Внешний осмотр+Неисправность>Диагностика_2"
(Vneshniy-osmotr ; 
(Vid Не работает отпариватель утюга)
)
(Neispravnost ; 
(Naimenovanie Система отпаривания)
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie Система отпаривания)
))
)
(defrule Diagnostika>Prichina-neispravnosti-2 "Описание правила: Диагностика>Причина неисправности_2"
(Diagnostika ; 
(Rezultat Засорились внутренние полости парообразования)
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat Засорились внутренние полости парообразования)
))
)
(defrule Prichina-neispravnosti>Remont-2 "Описание правила: Причина неисправности>Ремонт_2"
(Prichina-neispravnosti ; 
(Prichina Низкое качество воды)
)
=>
(assert 
(Remont ; 
(Prichina Низкое качество воды)
))
)
(defrule Vneshniy-osmotr+Neispravnost>Diagnostika-3 "Описание правила: Внешний осмотр+Неисправность>Диагностика_3"
(Vneshniy-osmotr ; 
(Vid Подошва не нагревается до нужной температуры)
)
(Neispravnost ; 
(Naimenovanie Нагревательный элемент(ТЭН))
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie Нагревательный элемент(ТЭН))
))
)
(defrule Diagnostika>Prichina-neispravnosti-3 "Описание правила: Диагностика>Причина неисправности_3"
(Diagnostika ; 
(Rezultat подгоревшие контакты)
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat подгоревшие контакты)
))
)
(defrule Prichina-neispravnosti>Remont-3 "Описание правила: Причина неисправности>Ремонт_3"
(Prichina-neispravnosti ; 
(Prichina Выход из строя конденсатора)
)
=>
(assert 
(Remont ; 
(Prichina Выход из строя конденсатора)
))
)
