;**************************************************************
; Наименование базы знаний: База знаний 28024867406
;**************************************************************
; Описание: 
;**************************************************************
;********************* Templates ******************************
(deftemplate tekhnologiya-izgotovleniya
(slot naimenovanie (default "5"))
)
(deftemplate sreda
(slot tip (default "666"))
)
(deftemplate nagruzka
(slot tip (default "5"))
)
(deftemplate degradatsionnyy-protsess
(slot naimenovanie (default "ПАП"))
)
(deftemplate kinetika
(slot naimenovanie (default "7"))
)
(deftemplate vneshnie-proyavleniya
(slot naimenovanie) ;************************ facts *******************************
)
;************************ Facts *******************************
(deffacts initial-settings
(kinetika ;кинетика
(naimenovanie "7")
)
)
;************************* Rules ******************************
(defrule sreda+tekhnologiya-izgotovleniya+nagruzka>degradatsionnyy-protsess "описание правила: среда+технология изготовления+нагрузка>деградационный процесс"
(sreda ;среда
(tip "666")
)
(tekhnologiya-izgotovleniya ;технология изготовления
(naimenovanie "5")
)
(nagruzka ;нагрузка
(tip "5")
)
=>
(assert 
(degradatsionnyy-protsess ;деградационный процесс
(naimenovanie "ПАП")
))
)
(defrule kinetika>vneshnie-proyavleniya "описание правила: кинетика>внешние проявления"
(kinetika ;кинетика
(naimenovanie "7")
)
=>
(assert 
(vneshnie-proyavleniya ;внешние проявления
(naimenovanie "IT WORKS!")
))
)
