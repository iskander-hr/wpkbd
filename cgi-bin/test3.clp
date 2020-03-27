;**************************************************************
; Наименование базы знаний: Knowledge base 10234235031
;**************************************************************
; Описание: 
;**************************************************************
;********************* Templates ******************************
(deftemplate incident-object ;object of the incident
(slot cf (default "1")) ;certainty factor
(slot caption (default "НЕТ ДАННЫХ")) ;name of the object
)
(deftemplate object-properties ;property of the object
(slot cf (default "1")) ;certainty factor
(slot caption) ;name of the object
(slot caption-incident-object) ;ref to the object
)
(deftemplate material ;material of the object
(slot cf) ;certainty factor
(slot caption) ;наименование
(slot type (default "СТАЛЬ")) ;вид
(slot mechanical-prop-strength-limit) ;strength limit
(slot mechanical-prop-yield-limit) ;свойства стойкости
(slot resistance-prop-corrosion) ;Corrosion resistance
(slot resistance-prop-temperature) ;temperature resistance
(slot resistance-prop-wear) ;chemical properties
(slot chemical-prop-alloying) ;structure
(slot structure-prop-class) ;structural class / martensitic / ferritic/
)
(deftemplate technological-heredity ;технологическая наследственность
(slot cf (default 1)) ;коэффициент уверенности
(slot caption) ;наименование
)
(deftemplate making-defects ;дефекты изготовления
(slot caption-technological-heredity) ;ссылка на технологическую наследственность
(slot type) ;вид /микротрещины/дефекты изготовления/
(slot cause) ;причина /сварка/
(slot location) ;месторасположение /зона терм-го воздействия/
(slot cf (default 1)) ;коэффициент уверенности
)
(deftemplate mechanical-stress-const ;механические нагрузки - статические/постоянные/
(slot stress-const-type (default "HIGH")) ;вид статических нагрузок/внутреннее давление/мпа//сосредоточенная нагрузка /мн//распределенная нагрузка/
(slot stress-value (default 0)) ;величина нагрузок
(slot tension-type) ;вид напряжения /растягивающие / сжимающие / сдвига/
(slot tension-value) ;величина напряжения
(slot cycle-amplitude) ;амплитуда цикла
(slot cycle-frequency) ;частота цикла
(slot cycle-asymmetry) ;коэффициент асимметрии цикла
(slot cycle-average-value) ;среднее значение цикла
(slot speed) ;скорость
(slot speed-up) ;ускорение
(slot max-stress-value) ;максимальное значение нагрузок
(slot cf (default 1)) ;коэффициент уверенности
)
(deftemplate technological-environment ;/рабочая/ технологическая среда
(slot contents-molecular-hydrogen (default "ACTIVE")) ;содержание молекулярного водорода /меньше 10% об/от 10% до 50% об/больше 50 % об/
(slot ph) ;водородный показатель /меньше 0-7 /рабочая среда кислая, кислотность увеличивается к нулю/, = 7 /рабочая среда нейтральная/, больше 7-15 /рабочая среда щелочная, щелочные свойства увеличиваются к 15//
(slot radiation) ;радиация /термическая / электромагнитная / ионизирующая/
(slot properties-alternation) ;чередование свойств среды /да/нет/
(slot environment-humidity) ;влажность среды
(slot environment-flash) ;температура вспышки паров среды
(slot cf (default 1)) ;коэффициент уверенности
)
(deftemplate heat-exchange-technological-environment ;теплообменная технологическая среда
(slot environment-type) ;вид /оборотная вода /слабокоррозионная/ / химически-очищенная вода /не коррозионная/ / химически-очищенная вода /слабощелочная//
(slot ph (default "НЕЙТРАЛЬНАЯ")) ;водородный показатель
(slot cf (default 1)) ;коэффициент уверенности
)
(deftemplate exist-event ;наблюдаемое событие кинетики
(slot cf) ;коэффициент уверенности
(slot caption) ;наименование события
(slot caption-kin) ;ссылка на кинетику
(slot probabilityrel (default "0")) ;вероятность возникновения
(slot id (default "0"))
)
(deftemplate exist-dam ;наблюдаемые повреждения
(slot id-dam (default "CRACK"))
(slot caption-dam) ;наименование повреждения
(slot dam-type) ;тип /в частном случает тип трещинообразования/
(slot dam-stress-type) ;тип напряжения
(slot dam-mesto-zarozdenia) ;место зарождения /например, трещины/
(slot dam-istochnik (default "CORROSION FATIGUE")) ;источник
(slot dam-mestopolozenie) ;местоположение
(slot dam-orientacia) ;ориентировка /например, трещины/
(slot dam-glubina) ;глубина
(slot dam-dlina) ;длина
(slot dam-diametr) ;диаметр
(slot dam-forma) ;форма в изломе
(slot dam-kolichestvo) ;количество повреждений близких по размеру
(slot dam-velichina-raskritia) ;велична раскрытия
(slot dam-tech-pered-razrusheniem) ;критерий течь перед разрушением
(slot dam-napravlenie) ;направление по отношению к главной оси
(slot caption-def)
(slot id-def)
(slot caption-meh)
(slot dam-cf (default 1)) ;коэффициент уверенности
)
(deftemplate exist-des ;наблюдаемые разрушения
(slot id-des (default "BRITTLE FAILURE"))
(slot caption-des) ;наименование
(slot des-istochnik) ;источник
(slot des-orientacia) ;ориентировка /например, трещины/
(slot des-napravlenie) ;направление по отношению к главной оси
(slot des-forma) ;форма
(slot des-kolichestvo) ;количество
(slot des-koncentracia-naprazheniy)
(slot des-mestopolozenie (default "CRACK")) ;местоположение
(slot caption-dam)
(slot id-dam)
(slot caption-meh)
(slot des-cf (default 1)) ;коэффициент уверенности
)
(deftemplate exist-def ;наблюдаемые дефекты
(slot id-def)
(slot caption-def) ;наименование
(slot caption-meh)
(slot def-cf (default 1)) ;коэффициент уверенности
)
(deftemplate exist-meh ;наблюдаемая механизм
(slot caption-meh (default "CORROSION FATIGUE")) ;наименование
(slot meh-cf (default 1)) ;коэффициент уверенности
)
(deftemplate exist-kin ;наблюдаемая кинетика отказа
(slot caption (default "KINETICS 'CORROSION FATIGUE'")) ;наименование
(slot caption-meh (default "CORROSION FATIGUE")) ;ссылка на механизм
(slot cf (default 1)) ;выявления событий -
)
;************************ Facts *******************************
(deffacts initial-settings
(mechanical-stress-const ;mechanical-stress-const
(stress-value 0)
(cycle-frequency "HIGH")
(cf 1)
)
(technological-environment ;technological-environment
(ph "ACTIVE")
(properties-alternation "YES")
(cf 1)
)
(incident-object ;incident-object
(cf "1")
(caption "PIPE INTO PIPE")
)
(material ;material
(cf "1")
(type "STEEL")
(chemical-prop-alloying "LOW-ALLOY STEEL")
)
)
;************************* Rules ******************************
(defrule fai-mechanism-ky-1001 "правило выявления /механизма/: если имеются механические нагрузки высокой частоты и активная технологическая среда с чередующимися свойствами и материал низколегированная сталь и имеются дефекты изготовления то может возникнуть механизм коррозионная усталость"
(mechanical-stress-const ;механические нагрузки
(cycle-frequency "HIGH") ;-----------
)
(technological-environment ;технологическая среда
(ph "ACTIVE") ;водородный показатель
(properties-alternation "YES") ;чередование свойств среды /да/нет/
)
(material ;материал
(type "STEEL") ;вид
(chemical-prop-alloying "LOW-ALLOY STEEL") ;легированность
)
(making-defects ;дефекты изготовления
(caption-technological-heredity ?id-th-m1) ;ссылка на технологическую наследственность
)
=>
(assert 
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;может возникнуть /механизм/
(cf "0,9") ;ку
))
(assert 
(exist-meh ;exist-meh
(caption-meh "CORROSION FATIGUE") ;может возникнуть /механизм/
(meh-cf "0,9") ;ку
))
)
(defrule fai-kinatics-ky-1001 "правило выявления /кинетики/: если наблюдается механизм коррозионная усталость то может возникнуть кинетика коррозионная усталость"
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;наблюдается /механизм/
(cf ?x)
)
=>
(assert 
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;может возникнуть /кинетика/
(caption-meh "CORROSION FATIGUE")
(cf ?x)
))
)
(defrule fai-kinatic-events-ky-1001 "правило выявления /параметры/события кинетики/: если наблюдается кинетика коррозионная усталость то могут наблюдаться события: утечка рабочей среды через сквозные трещины и полный выброс рабочей среды"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "LEAKAGE OF THE WORKING ENVIRONMENT THROUGH THE THROUGH CRACKS") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
(assert 
(exist-event ;exist-event
(caption "COMPLETE RESET OF THE WORKING ENVIRONMENT") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule fai-kinatic-events-ky-1002 "правило выявления /последующее событие кинетики/: если наблюдает-ся кинетика коррозионная усталость и событие утечка рабочей среды через сквозные трещины то может наблюдаться событие образование сквозной трещины"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/
)
(exist-event ;exist-event
(caption "LEAKAGE OF THE WORKING ENVIRONMENT THROUGH THE THROUGH CRACKS") ;/событие/
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE THROUGH CRACKS") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule fai-kinatic-events-ky-1003 "правило выявления /последующее событие кинетики/: если наблюдает-ся кинетика коррозионная усталость и событие полный выброс рабочей среды то может наблюдаться событие хрупкое разрушение"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/
)
(exist-event ;exist-event
(caption "COMPLETE RESET OF THE WORKING ENVIRONMENT")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "BRITTLE FAILURE") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-mechanism-ky-1001 "Описание правила: des-mechanism-ky-1001"
(exist-dam ;exist-dam
(caption-dam "CRACK")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(caption-meh "CORROSION FATIGUE")
(dam-cf ?x)
(id-dam ?id)
)
=>
(assert 
(exist-des ;exist-des
(des-cf ?x)
(caption-des "MACROCRACK")
(des-istochnik "SURFACE DAMAGE")
(des-orientacia "PERPENDICULARLY")
(des-napravlenie "LONGITUDINAL")
(des-kolichestvo "SINGLE")
(caption-meh "CORROSION FATIGUE")
(caption-dam "CRACK")
(id-dam ?id)
(id-des ?id)
))
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-mechanism-ky-1002 "Описание правила: des-mechanism-ky-1002"
(exist-dam ;exist-dam
(caption-dam "CRACK")
(dam-istochnik "CONSTRUCTIVE STRESS CONCENTRATOR FORMED BY THE INTERSECTION OF HOLES")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(dam-forma "SEMI-ELLIPTIC")
(caption-meh "CORROSION FATIGUE")
(dam-cf ?x)
(id-dam ?id)
)
(exist-event ;exist-event
(caption "FORMATION OF THE THROUGH CRACKS")
)
=>
(assert 
(exist-des ;exist-des
(des-cf ?x)
(caption-des "MACROCRACK")
(des-istochnik "HOLEHOLE")
(des-orientacia "PERPENDICULARLY")
(des-napravlenie "LONGITUDINAL")
(des-kolichestvo "SINGLE")
(des-koncentracia-naprazheniy "LESS THAN 2")
(caption-meh "CORROSION FATIGUE")
(caption-dam "CRACK")
(id-dam ?id)
(id-des ?id)
))
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-mechanism-ky-1003 "Описание правила: des-mechanism-ky-1003"
(exist-event ;exist-event
(caption "BRITTLE FAILURE")
)
(exist-des ;exist-des
(caption-des "BRITTLE FAILURE")
(des-istochnik "CONSTRUCTIVE STRESS CONCENTRATOR FORMED BY THE INTERSECTION OF HOLES")
(des-orientacia "PERPENDICULARLY")
(des-napravlenie "LONGITUDINAL")
(des-forma "SEMI-ELLIPTIC")
(caption-meh "CORROSION FATIGUE")
(id-dam ?id)
(id-des ?id2)
(des-cf ?x)
)
=>
(assert 
(exist-des ;exist-des
(des-cf ?x)
(caption-des "MACROCRACK")
(des-istochnik "HOLE")
(des-orientacia "PERPENDICULARLY")
(des-napravlenie "LONGITUDINAL")
(des-kolichestvo "SINGLE")
(des-koncentracia-naprazheniy "LESS THAN 2")
(caption-meh "CORROSION FATIGUE")
(caption-dam "CRACK")
(id-dam ?id)
(id-des ?id2)
))
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-kinatic-events-ky-1004 "Описание правила: des-kinatic-events-ky-1004"
(exist-dam ;exist-dam
(caption-dam "CRACK")
(dam-istochnik "SURFACE DAMAGE")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(dam-kolichestvo "SINGLE")
(caption-meh "CORROSION FATIGUE")
)
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE")
(caption-kin "KINETICS OF DESTRUCTION 'CORROSION FATIGUE 1'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-kinatic-events-ky-1005 "Описание правила: des-kinatic-events-ky-1005"
(exist-dam ;exist-dam
(caption-dam "CRACK")
(dam-istochnik "HOLE")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(dam-kolichestvo "SINGLE")
(caption-meh "CORROSION FATIGUE")
)
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-kinatic-events-ky-1006 "Описание правила: des-kinatic-events-ky-1006"
(exist-dam ;exist-dam
(caption-dam "CRACK")
(dam-istochnik "HOLE")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(dam-kolichestvo "SINGLE")
(caption-meh "CORROSION FATIGUE")
)
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-mechanism-ky-1001 "правило выявления /механизма/"
(mechanical-stress-const ;механические нагрузки
(cycle-frequency "HIGH") ;-----------
)
(technological-environment ;технологическая среда
(ph "ACTIVE") ;водородный показатель
(properties-alternation "YES") ;чередование свойств среды /да/нет/
)
(incident-object ;объект инцидента
(caption ?id-inc-obj) ;код
)
(material ;материал
(type "STEEL") ;вид
(chemical-prop-alloying "LOW-ALLOY STEEL") ;легированность
)
=>
(assert 
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;может возникнуть /механизм/
(cf "0,9") ;ку
))
)
(defrule dam-mechanism-ky-1002 "правило выявления /механизма/"
(mechanical-stress-const ;механические нагрузки
(cycle-frequency "HIGH") ;-----------
)
(technological-environment ;технологическая среда
(ph "ACTIVE") ;водородный показатель
(properties-alternation "YES") ;чередование свойств среды /да/нет/
)
(incident-object ;объект инцидента
(caption ?id-inc-obj) ;код
)
(material ;материал
(type "STEEL") ;вид
(chemical-prop-alloying "LOW-ALLOY STEEL") ;легированность
)
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;может возникнуть /механизм/
(cf "0,9") ;ку
))
)
(defrule dam-kinatics-ky-1001 "правило выявления /кинетики/"
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;наблюдается /механизм/
(cf ?x)
)
=>
(assert 
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;может возникнуть /кинетика/
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1001 "правило возникновения повреждения: если наблюдается кинетика коррозионная усталость то может возникнуть повреждение трещина, количество - одиночные, продольные, ориентированные перпендикулярно"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/
(cf ?x)
)
=>
(assert 
(exist-dam ;exist-dam
(dam-cf ?x)
(caption-dam "CRACK")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(dam-kolichestvo "SINGLE")
(caption-meh "CORROSION FATIGUE")
(id-dam "КУ-1")
))
(assert 
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1002 "Описание правила: dam-kinatic-events-ky-1002"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/ /
)
(exist-dam ;exist-dam
(caption-dam "CRACK")
(dam-orientacia "PERPENDICULARLY")
(dam-napravlenie "LONGITUDINAL")
(dam-kolichestvo "SINGLE")
(caption-meh "CORROSION FATIGUE")
)
(exist-event ;exist-event
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "MERGING MICROCRACKS") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1003 "Описание правила: dam-kinatic-events-ky-1003"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/ /
)
(exist-event ;exist-event
(caption "MERGING MICROCRACKS")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "PREFERENTIAL DEVELOPMENT OF MICROCRACKS ORIENTED IN PLANES PERPENDICULAR TO THE MAXIMUM TENSILE STRESS") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1004 "Описание правила: dam-kinatic-events-ky-1004"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/ /
)
(exist-event ;exist-event
(caption "PREFERENTIAL DEVELOPMENT OF MICROCRACKS ORIENTED IN PLANES PERPENDICULAR TO THE MAXIMUM TENSILE STRESS")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE MICROCRACKS") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1005 "Описание правила: dam-kinatic-events-ky-1005"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/ /
)
(exist-event ;exist-event
(caption "FORMATION OF THE MICROCRACKS")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "DEVELOPMENT OF INTRAGRANULAR SUBMICROCRACKS DUE TO THE DISSOLUTION IN THE SLIP PLANES") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1006 "Описание правила: dam-kinatic-events-ky-1006"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;наблюдается /кинетика/ /
)
(exist-event ;exist-event
(caption "DEVELOPMENT OF INTRAGRANULAR SUBMICROCRACKS DUE TO THE DISSOLUTION IN THE SLIP PLANES")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "FORMATION OF LOCAL DEFORMATION ZONES IN THE SURFACE DUE TO CYCLIC LOADING") ;может возникнуть /событие/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
