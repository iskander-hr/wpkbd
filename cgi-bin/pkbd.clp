;**************************************************************
; Наименование базы знаний: База знаний 1
;**************************************************************
; Описание: 
;**************************************************************
;********************* Templates ******************************
(deftemplate Tekhnologiya-izgotovleniya
(slot Naimenovanie (default "5"))
)
(deftemplate Sreda
(slot Tip (default "666"))
)
(deftemplate Nagruzka
(slot Tip (default "5"))
)
(deftemplate Degradatsionnyy-protsess
(slot Naimenovanie (default "ПАП"))
)
(deftemplate Kinetika
(slot Naimenovanie (default "7"))
)
(deftemplate Vneshnie-proyavleniya
(slot Naimenovanie (default "ВВАВ"))
)
;************************ Facts *******************************
(deffacts initial-settings
(Kinetika ;Кинетика
(Naimenovanie "7")
)
)
;************************* Rules ******************************
(defrule Sreda+Tekhnologiya-izgotovleniya+Nagruzka>Degradatsionnyy-protsess "Описание правила: Среда+Технология изготовления+Нагрузка>Деградационный процесс"
(Sreda ;Среда
(Tip "666")
)
(Tekhnologiya-izgotovleniya ;Технология изготовления
(Naimenovanie "5")
)
(Nagruzka ;Нагрузка
(Tip "5")
)
=>
(assert 
(Degradatsionnyy-protsess ;Деградационный процесс
(Naimenovanie "ПАП")
))
)
(defrule Kinetika>Vneshnie-proyavleniya "Описание правила: Кинетика>Внешние проявления"
(Kinetika ;Кинетика
(Naimenovanie "7")
)
=>
(assert 
(Vneshnie-proyavleniya ;Внешние проявления
(Naimenovanie "ВВАВ")
))
)
