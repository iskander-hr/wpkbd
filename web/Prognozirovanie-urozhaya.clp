;***********************************************************************************
; Наименование базы знаний: Прогнозирование урожая
;***********************************************************************************
; Описание: База знаний добавлена из файла
;***********************************************************************************
;**************Templates*********************************************************
(deftemplate Osadki ;
(slot Kolichestvo (default ""));
)
(deftemplate Temperatura-vozdukha ;
(slot Znachenie (default ""));
)
(deftemplate Pogodnye-usloviya ;
(slot Tip (default ""));
)
(deftemplate Chastota-poliva ;
(slot Znachenie (default ""));
)
(deftemplate Sostoyanie-pochvy ;
(slot Sostoyanie (default ""));
)
(deftemplate Urozhay ;
(slot Pokazatel (default ""));
)
;**************Facts*************************************************************
(deffacts initial-settings
(Chastota-poliva ;
(Znachenie "ЧАСТО")
)
(Osadki ;
(Kolichestvo "ОБИЛЬНЫЕ")
)
(Temperatura-vozdukha ;
(Znachenie "11-30")
)
)
;**************Rules*************************************************************
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-1 "Описание правила: Температура воздуха+Осадки>Погодные условия_1"
(Temperatura-vozdukha ; 
(Znachenie "0-10")
)
(Osadki ; 
(Kolichestvo "МАЛЫЕ")
)
=>
(assert 
(Pogodnye-usloviya ; 
(Kolichestvo "МАЛЫЕ")
))
)
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-2 "Описание правила: Температура воздуха+Осадки>Погодные условия_2"
(Temperatura-vozdukha ; 
(Znachenie "11-30")
)
(Osadki ; 
(Kolichestvo "МАЛЫЕ")
)
=>
(assert 
(Pogodnye-usloviya ; 
(Kolichestvo "МАЛЫЕ")
))
)
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-3 "Описание правила: Температура воздуха+Осадки>Погодные условия_3"
(Temperatura-vozdukha ; 
(Znachenie "11-30")
)
(Osadki ; 
(Kolichestvo "ОБИЛЬНЫЕ")
)
=>
(assert 
(Pogodnye-usloviya ; 
(Kolichestvo "ОБИЛЬНЫЕ")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-1 "Описание правила: Погодные условия+Частота полива>Состояние почвы_1"
(Pogodnye-usloviya ; 
(Tip "ТЕПЛАЯ, ВЛАЖНАЯ ПОГОДА")
)
(Chastota-poliva ; 
(Znachenie "ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ; 
(Znachenie "ЧАСТО")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-2 "Описание правила: Погодные условия+Частота полива>Состояние почвы_2"
(Pogodnye-usloviya ; 
(Tip "ТЕПЛАЯ, ВЛАЖНАЯ ПОГОДА")
)
(Chastota-poliva ; 
(Znachenie "НЕ ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ; 
(Znachenie "НЕ ЧАСТО")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-3 "Описание правила: Погодные условия+Частота полива>Состояние почвы_3"
(Pogodnye-usloviya ; 
(Tip "ХОЛОДНАЯ, СУХАЯ ПОГОДА")
)
(Chastota-poliva ; 
(Znachenie "НЕ ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ; 
(Znachenie "НЕ ЧАСТО")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-4 "Описание правила: Погодные условия+Частота полива>Состояние почвы_4"
(Pogodnye-usloviya ; 
(Tip "ХОЛОДНАЯ, СУХАЯ ПОГОДА")
)
(Chastota-poliva ; 
(Znachenie "ЧАСТО")
)
=>
(assert 
(Sostoyanie-pochvy ; 
(Znachenie "ЧАСТО")
))
)
(defrule Sostoyanie-pochvy>Urozhay-1 "Описание правила: Состояние почвы>Урожай_1"
(Sostoyanie-pochvy ; 
(Sostoyanie "ОТЛИЧНОЕ")
)
=>
(assert 
(Urozhay ; 
(Sostoyanie "ОТЛИЧНОЕ")
))
)
(defrule Sostoyanie-pochvy>Urozhay-2 "Описание правила: Состояние почвы>Урожай_2"
(Sostoyanie-pochvy ; 
(Sostoyanie "УДОВЛЕТВОРИТЕЛЬНОЕ")
)
=>
(assert 
(Urozhay ; 
(Sostoyanie "УДОВЛЕТВОРИТЕЛЬНОЕ")
))
)
(defrule Sostoyanie-pochvy>Urozhay-3 "Описание правила: Состояние почвы>Урожай_3"
(Sostoyanie-pochvy ; 
(Sostoyanie "НЕУДОВЛЕТВОРИТЕЛЬНОЕ")
)
=>
(assert 
(Urozhay ; 
(Sostoyanie "НЕУДОВЛЕТВОРИТЕЛЬНОЕ")
))
)
