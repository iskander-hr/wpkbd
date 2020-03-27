;***********************************************************************************
; Наименование базы знаний: База знаний 1
;***********************************************************************************
; Описание: База знаний добавлена из файла
;***********************************************************************************
;**************Templates*********************************************************
(deftemplate Tehnologiya_izgotovleniya ;bug test 1
(slot Naimenovanie (default "5"));
)
(deftemplate Sreda ;bug test
(slot Tip (default "666"));
)
(deftemplate Nagruzka ;
(slot Tip (default "5"));
)
(deftemplate Degradatsionnyy-protsess ;
(slot Naimenovanie (default "пап"));
)
(deftemplate Kinetika ;
(slot Naimenovanie (default "7"));
)
(deftemplate Vneshnie-proyavleniya ;
(slot Naimenovanie (default "ввав"));
)
(deftemplate Shablon-T007 ;Описание для шаблона: bug test
(slot Slot-01 (default "8"));Описание для слота:
)
;**************Facts*************************************************************
(deffacts initial-settings
(Kinetika ;bug test 1
(Naimenovanie 7)
)
)
;**************Rules*************************************************************
(defrule Sreda+Tekhnologiya-izgotovleniya+Nagruzka>Degradatsionnyy-protsess "Описание правила: Среда+Технология изготовления+Нагрузка>Деградационный процесс"
(Sreda ; bug test
(Tip 666)
)
(Tehnologiya_izgotovleniya ; bug test 1
(Naimenovanie 5)
)
(Nagruzka ; 
(Tip 5)
)
=>
(assert 
(Degradatsionnyy-protsess ; 
(Naimenovanie "5")
))
)
(defrule Kinetika>Vneshnie-proyavleniya "Описание правила: Кинетика>Внешние проявления"
(Kinetika ; 
(Naimenovanie 7)
)
=>
(assert 
(Vneshnie-proyavleniya ; 
(Naimenovanie 7)
))
)
