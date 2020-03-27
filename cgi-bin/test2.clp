;**************************************************************
; Наименование базы знаний: Прогнозирование урожая
;**************************************************************
; Описание: 
;**************************************************************
;********************* Templates ******************************
(deftemplate Osadki
(slot Kolichestvo)
)
(deftemplate Temperatura-vozdukha
(slot Znachenie)
)
(deftemplate Pogodnye-usloviya
(slot Tip)
)
(deftemplate Chastota-poliva
(slot Znachenie)
)
(deftemplate Sostoyanie-pochvy
(slot Sostoyanie)
)
(deftemplate Urozhay
(slot Pokazatel)
)
;************************ Facts *******************************
(deffacts initial-settings
(Chastota-poliva ;Частота полива
(Znachenie "ЧАСТО")
)
(Osadki ;Осадки
(Kolichestvo "ОБИЛЬНЫЕ")
)
(Temperatura-vozdukha ;Температура воздуха
(Znachenie "11-30")
)
)
;************************* Rules ******************************
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-1 "Описание правила: Температура воздуха+Осадки>Погодные условия_1"
(Temperatura-vozdukha ;Температура воздуха
(Znachenie "0-10")
)
(Osadki ;Осадки
(Kolichestvo "МАЛЫЕ")
)
=>
(assert 
(Pogodnye-usloviya ;Погодные условия
(Tip "ХОЛОДНАЯ, СУХАЯ ПОГОДА")
))
)
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-2 "Описание правила: Температура воздуха+Осадки>Погодные условия_2"
(Temperatura-vozdukha ;Температура воздуха
(Znachenie "11-30")
)
(Osadki ;Осадки
(Kolichestvo "МАЛЫЕ")
)
=>
(assert 
(Pogodnye-usloviya ;Погодные условия
(Tip "ТЕПЛАЯ, СУХАЯ ПОГОДА")
))
)
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-3 "Описание правила: Температура воздуха+Осадки>Погодные условия_3"
(Temperatura-vozdukha ;Температура воздуха
(Znachenie "11-30")
)
(Osadki ;Осадки
(Kolichestvo "ОБИЛЬНЫЕ")
)
=>
(assert 
(Pogodnye-usloviya ;Погодные условия
(Tip "ТЕПЛАЯ, ВЛАЖНАЯ ПОГОДА")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-1 "Описание правила: Погодные условия+Частота полива>Состояние почвы_1"
(Pogodnye-usloviya ;Погодные условия
(Tip "ТЕПЛАЯ, ВЛАЖНАЯ ПОГОДА")
)
(Chastota-poliva ;Частота полива
(Znachenie "ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "ОТЛИЧНОЕ")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-2 "Описание правила: Погодные условия+Частота полива>Состояние почвы_2"
(Pogodnye-usloviya ;Погодные условия
(Tip "ТЕПЛАЯ, ВЛАЖНАЯ ПОГОДА")
)
(Chastota-poliva ;Частота полива
(Znachenie "НЕ ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "УДОВЛЕТВОРИТЕЛЬНОЕ")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-3 "Описание правила: Погодные условия+Частота полива>Состояние почвы_3"
(Pogodnye-usloviya ;Погодные условия
(Tip "ХОЛОДНАЯ, СУХАЯ ПОГОДА")
)
(Chastota-poliva ;Частота полива
(Znachenie "НЕ ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "НЕУДОВЛЕТВОРИТЕЛЬНОЕ")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-4 "Описание правила: Погодные условия+Частота полива>Состояние почвы_4"
(Pogodnye-usloviya ;Погодные условия
(Tip "ХОЛОДНАЯ, СУХАЯ ПОГОДА")
)
(Chastota-poliva ;Частота полива
(Znachenie "ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "УДОВЛЕТВОРИТЕЛЬНОЕ")
))
)
(defrule Sostoyanie-pochvy>Urozhay-1 "Описание правила: Состояние почвы>Урожай_1"
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "ОТЛИЧНОЕ")
)
=>
(assert 
(Urozhay ;Урожай
(Pokazatel "БОЛЬШОЙ")
))
)
(defrule Sostoyanie-pochvy>Urozhay-2 "Описание правила: Состояние почвы>Урожай_2"
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "УДОВЛЕТВОРИТЕЛЬНОЕ")
)
=>
(assert 
(Urozhay ;Урожай
(Pokazatel "СРЕДНИЙ")
))
)
(defrule Sostoyanie-pochvy>Urozhay-3 "Описание правила: Состояние почвы>Урожай_3"
(Sostoyanie-pochvy ;Состояние почвы
(Sostoyanie "НЕУДОВЛЕТВОРИТЕЛЬНОЕ")
)
=>
(assert 
(Urozhay ;Урожай
(Pokazatel "МАЛЫЙ")
))
)
