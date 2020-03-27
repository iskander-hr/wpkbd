;***********************************************************************************
; Наименование базы знаний: База знаний
;***********************************************************************************
; Описание: База знаний добавлена из файла
;***********************************************************************************
;**************Templates*********************************************************
(deftemplate Zvukovye-signaly-BIOS ;
(slot Vid (default "1 ДЛИННЫЙ, 2 КОРОТКИХ"));
)
(deftemplate Neispravnost ;
(slot Naimenovanie (default "ВИДЕОАДАПТЕР НЕ ОБНАРУЖЕН ИЛИ ОШИБКА ВИДЕОПАМЯТИ;ОТСУТСТВУЕТ ИЗОБРАЖЕНИЕ НА ЭКРАНЕ"));
)
(deftemplate Diagnostika ;
(slot Rezultat (default "ВИДЕОАДАПТЕР НЕ ОБНАРУЖЕН ИЛИ ОШИБКА ВИДЕОПАМЯТИ"));
)
(deftemplate Prichina-neispravnosti ;
(slot Prichina (default "ПОЛОМКА ВИДЕОАДАПТЕРА ИЛИ ЕГО ОТСУТСТВИЕ"));
)
(deftemplate Remont ;
(slot Metod (default "ЗАМЕНА ВИДЕОАДАПТЕРА ИЛИ РЕМОНТИРОВАНИЕ ИСХОДНОГО"));
)
;**************Facts*************************************************************
(deffacts initial-settings
(Zvukovye-signaly-BIOS ;
(Vid "1 ДЛИННЫЙ, 2 КОРОТКИХ")
)
(Neispravnost ;
(Naimenovanie "ОТСУТСТВУЕТ ИЗОБРАЖЕНИЕ НА ЭКРАНЕ")
)
)
;**************Rules*************************************************************
(defrule Zvukovye-signaly-BIOS+Neispravnost>Diagnostika-1 "Описание правила: Звуковые сигналы BIOS+Неисправность>Диагностика_1"
(Zvukovye-signaly-BIOS ; 
(Vid "1 ДЛИННЫЙ, 2 КОРОТКИХ")
)
(Neispravnost ; 
(Naimenovanie "ОТСУТСТВУЕТ ИЗОБРАЖЕНИЕ НА ЭКРАНЕ")
)
=>
(assert 
(Diagnostika ; 
(Naimenovanie "ОТСУТСТВУЕТ ИЗОБРАЖЕНИЕ НА ЭКРАНЕ")
))
)
(defrule Diagnostika>Prichina-neispravnosti-1 "Описание правила: Диагностика>Причина неисправности_1"
(Diagnostika ; 
(Rezultat "ВИДЕОАДАПТЕР НЕ ОБНАРУЖЕН ИЛИ ОШИБКА ВИДЕОПАМЯТИ")
)
=>
(assert 
(Prichina-neispravnosti ; 
(Rezultat "ВИДЕОАДАПТЕР НЕ ОБНАРУЖЕН ИЛИ ОШИБКА ВИДЕОПАМЯТИ")
))
)
(defrule Prichina-neispravnosti>Remont-1 "Описание правила: Причина неисправности>Ремонт_1"
(Prichina-neispravnosti ; 
(Prichina "ПОЛОМКА ВИДЕОАДАПТЕРА ИЛИ ЕГО ОТСУТСТВИЕ")
)
=>
(assert 
(Remont ; 
(Prichina "ПОЛОМКА ВИДЕОАДАПТЕРА ИЛИ ЕГО ОТСУТСТВИЕ")
))
)
