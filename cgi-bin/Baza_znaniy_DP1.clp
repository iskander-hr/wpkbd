;***********************************************************************************
; Наименование базы знаний: База знаний ДП1
;***********************************************************************************
; Описание: База знаний добавлена из файла
;***********************************************************************************
;**************Templates*********************************************************
(deftemplate Material_obekta_ ;
(slot caption (default ""));
(slot Vid (default ";СТАЛЬ;МЕТАЛЛ"));
(slot mechanical-prop-strength-limit (default ""));
(slot mechanical-prop-yield-limit (default ""));
(slot resistance-prop-corrosion (default ";ДА;НЕТ"));
(slot Temperaturnaya_stoykost (default ";ДА;НЕТ"));
(slot resistance-prop-wear (default ";ДА;НЕТ"));
(slot chemical-prop-alloying (default ";НИЗКОЛЕГИРОВАННАЯ СТАЛЬ;СРЕДНЕЛЕГИРОВАННАЯ СТАЛЬ;ВЫСОКОЛЕГИРОВАННАЯ СТАЛЬ"));
(slot structure-prop-class (default ";МАРТЕНСИТНЫЙ;ФЕРРИТНЫЙ;МАРТЕНСИТНЫЙ ИЛИ ФЕРРИТНЫЙ"));
(slot technological-heredity (default ";НЕОДНОРОДНОСТЬ ГРАНИЦ ЗЕРЕН ИЛИ ХРУПКОСТЬ ГРАНИЦ ЗЕРЕН ИЛИ НЕОДНОРОДНОСТЬ МИКРОНАПРЯЖЕННОГО СОСТОЯНИЯ"));
)
(deftemplate ostatochnie-napryagenia ;
(slot ostN-vid (default ";РАСТЯГИВАЮЩИЕ;СЖИМАЮЩИЕ;НАПРЯЖЕНИЯ СДВИГА"));
(slot ostN-znachenie (default ";МАКСИМАЛЬНЫЕ;СРЕДНИЕ;МИНИМАЛЬНЫЕ"));
(slot ostN-mestopolozenie (default ";НА БОКОВОЙ ПОВЕРХНОСТИ;НА ВОГНУТОЙ ПОВЕРХНОСТИ;НА БОКОВОЙ ИЛИ ВОГНУТОЙ ПОВЕРХНОСТИ"));
(slot ostN-orientacia (default ";ПРОДОЛЬНЫЕ;ПЕРПЕНДИКУЛЯРНЫЕ"));
(slot ostN-prichina (default ";ДЕФОРМАЦИЯ В ХОЛОДНОМ СОСТОЯНИИ ПРИ ГНУТЬЕ "));
)
(deftemplate structural-heredity ;
(slot structural-stress-concentrators (default ";Переходы поверхностей;Галтели;Соединения  "));
(slot absolute-sizes-section-element (default ";Незначительные;Значительные"));
)
(deftemplate making-defects ;
(slot def-nalichie (default "ДА;НЕТ"));
(slot type (default ";ЗАКАТЫ;НЕМЕТАЛЛИЧЕСКИЕ ВКЛЮЧЕНИЯ;МИКРОТРЕЩИНЫ;ПОРЫ;РАССЛОЕНИЕ;ТРЕЩИНА (Ы) - ДЕФЕКТ;ФЛОКЕНЫ"));
(slot cause (default ";СВАРКА"));
(slot location (default ";ЗОНА ТЕРМАЛЬНОГО ВОЗДЕЙСТВИЯ"));
)
(deftemplate mechanical-stress-const ;
(slot stress-const-nalichie (default "ДА;НЕТ"));
(slot stress-const-type (default "ВНУТРЕННЕЕ ДАВЛЕНИЕ;СОСРЕДОТОЧЕННАЯ НАГРУЗКА;РАСПРЕДЕЛЕННАЯ НАГРУЗКА"));
(slot stress-value (default ""));
(slot tension-type (default "РАСТЯГИВАЮЩИЕ НАПРЯЖЕНИЯ;СЖИМАЮЩИЕ НАПРЯЖЕНИЯ;НАПРЯЖЕНИЯ СДВИГА"));
(slot tension-value (default ""));
)
(deftemplate mechanical-stress-variables ;
(slot stress-variables-nalichie (default "ДА;НЕТ"));
(slot stress-variables-dinamic-type (default "МАЛОЦИКЛОВАЯ (до 100000 циклов);МНОГОЦИКЛОВАЯ (до 10000000 циклов)"));
(slot stress-value (default ""));
(slot cycle-amplitude (default ""));
(slot cycle-frequency (default "ВЫСОКАЯ (больше 60 цикл/мин);СРЕДНЯЯ (от 20 до 60 цикл/мин);НИЗКАЯ (ниже 20 цикл/мин)"));
(slot cycle-asymmetry (default ""));
(slot cycle-average-value (default ""));
(slot tension-type (default "РАСТЯГИВАЮЩИЕ НАПРЯЖЕНИЯ;СЖИМАЮЩИЕ НАПРЯЖЕНИЯ;НАПРЯЖЕНИЯ СДВИГА"));
(slot tension-value (default ""));
)
(deftemplate mechanical-stress-dynamic ;
(slot cycle-nalichie (default "ДА;НЕТ"));
(slot cycle-amplitude (default ""));
(slot cycle-frequency (default "ВЫСОКАЯ (больше 60 цикл/мин);СРЕДНЯЯ (от 20 до 60 цикл/мин);НИЗКАЯ (ниже 20 цикл/мин)"));
(slot speed (default ""));
(slot speed-up (default ""));
(slot max-stress-value (default ""));
(slot tension-type (default "РАСТЯГИВАЮЩИЕ НАПРЯЖЕНИЯ;СЖИМАЮЩИЕ НАПРЯЖЕНИЯ;НАПРЯЖЕНИЯ СДВИГА"));
(slot tension-value (default ""));
)
(deftemplate thermal-stress ;
(slot drop-length (default ";Меньше 100 градусов;От 100 до  300 градусов;Больше 300 градусов"));
(slot drop-thickness (default ";Меньше 10 градусов; От 10 до 100 градусов;Больше 100 градусов"));
)
(deftemplate technological-environment ;
(slot temperature (default ""));
(slot vyazkost (default ""));
(slot contents-molecular-hydrogen (default "МЕНЬШЕ 10%;ОТ 10% ДО 50%;БОЛЬШЕ 50%"));
(slot pH (default "НЕЙТРАЛЬНАЯ (7 рН);АКТИВНАЯ (КИСЛАЯ, 0-7 рН);АКТИВНАЯ (ЩЕЛОЧНАЯ, 7-15 рН);АКТИВНАЯ (КИСЛАЯ или ЩЕЛОЧНАЯ);АКТИВНАЯ (ЭЛЕКТРОЛИТ)"));
(slot radiation (default "ТЕРМИЧЕСКАЯ;ЭЛЕКТРОМАГНИТНАЯ;ИОНИЗИРУЮЩАЯ"));
(slot properties-alternation (default "ДА;НЕТ"));
(slot environment-humidity (default ""));
(slot environment-flash (default "МЕНЬШЕ 20 ГР С;ОТ 28 до 61 ГР С;БОЛЬШЕ 61 ГР С"));
)
(deftemplate heat-exchange-technological-environment ;
(slot type (default "ОБОРОТНАЯ ВОДА (слабокоррозионная);ХИМИЧЕСКИ-ОЧИЩЕННАЯ ВОДА (некоррозионная);ХИМИЧЕСКИ-ОЧИЩЕННАЯ ВОДА (слабощелочная)"));
(slot pH (default "НЕЙТРАЛЬНАЯ (7 рН);АКТИВНАЯ (КИСЛАЯ, 0-7 рН);АКТИВНАЯ (ЩЕЛОЧНАЯ, 7-15 рН);АКТИВНАЯ (КИСЛАЯ или ЩЕЛОЧНАЯ);АКТИВНАЯ (ЭЛЕКТРОЛИТ)"));
(slot obshayGestkost (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot kislorod (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot gelezo (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot chlor (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot sera (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot azot (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot gidrozin-gidrat (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
(slot elektrodniyPotencial (default "НИЖЕ НОРМЫ;В НОРМЕ;ВЫШЕ НОРМЫ"));
)
(deftemplate flow-technological-environment ;
(slot nalichie-potok (default "ДА;НЕТ"));
(slot speed (default ""));
(slot solid-particles-there (default "ДА;НЕТ"));
(slot solid-particles-value (default ""));
(slot solid-particles-hardness (default ""));
(slot differentiation-of-components (default "ДЕЙСТВИЕ ЦЕНТРОБЕЖНЫХ СИЛ ИЛИ ДЕЙСТВИЕ ПОЛЕЙ"));
(slot turbulence (default "УДАР О ПОВЕРХНОСТЬ ИЛИ ОБТЕКАНИЕ ПРЕПЯТСТВИЙ"));
)
(deftemplate surface-damage-from-corrosive-environment ;
(slot nalichiePovregdaemosti (default "ДА;НЕТ"));
(slot type (default ""));
(slot cause (default ""));
(slot location (default ""));
)
(deftemplate exist-meh-dam ;
(slot caption-meh (default "ВОДОРОДНОЕ ОХРУПЧИВАНИЕ;ИЗНАШИВАНИЕ;КОРРОЗИЯ МЕСТНАЯ;КОРРОЗИЯ СТРУКТУРНАЯ;КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ;КОРРОЗИОННАЯ УСТАЛОСТЬ;МЕХАНИЧЕСКАЯ УСТАЛОСТЬ;ЭРОЗИЯ"));
(slot meh-cf (default ""));
)
(deftemplate exist-dam ;
(slot caption-dam (default ";ТРЕЩИНА (Ы) - ПОВРЕЖДЕНИЕ;ПИТТИНГИ;ЯЗВЫ;ЭРОЗИЙНЫЕ ПОВРЕЖДЕНИЯ"));
(slot dam-type-treshinoobrazovaniy (default ""));
(slot dam-istochnik (default ";ДЕФЕКТ ИЗГОТОВЛЕНИЯ;ЛОКАЛЬНЫЕ КОРРОЗИОННЫЕ ВПАДИНЫ;КОНСТРУКТИВНЫЙ КОНЦЕНТРАТОР НАПРЯЖЕНИЙ;КОНСТРУКТИВНЫЙ КОНЦЕНТРАТОР НАПРЯЖЕНИЙ ОБРАЗОВАННЫЙ ПЕРЕСЕЧЕНИЕМ ОТВЕРСТИЙ;ПОВРЕЖДЕНИЯ ПОВЕРХНОСТИ;ОТВЕРСТИЕ"));
(slot dam-mestopolozenie (default ";НА ПОВЕРХНОСТИ;НА ВНЕШНЕЙ ПОВЕРХНОСТИ;НА ВНУТРЕННЕЙ ПОВЕРХНОСТИ;БЛИЗЛЕЖАЩИЕ ЗОНЫ ТЕРМИЧЕСКОГО ВЛИЯНИЯ;НА ПОВЕРХНОСТИ, В ПРЕДЕЛАХ ОДНОЙ ЗОНЫ ТЕРМИЧЕСКОГО ВЛИЯНИЯ"));
(slot dam-orientacia (default ";ПЕРЕПЕНДИКУЛЯРНО;ПРОДОЛЬНО"));
(slot dam-glubina (default "менее 4"));
(slot dam-dlina (default ""));
(slot dam-diametr (default ""));
(slot dam-forma (default ";ВЫТЯНУТЫЕ УГЛУБЛЕНИЯ;ЦАРАПИНЫ"));
(slot dam-forma-v-izlome (default ";ПОЛУЭЛЛИПТИЧЕСКАЯ;ПСЕВДОПОЛУЭЛЛИПТИЧЕСКАЯ"));
(slot dam-kolichestvo (default ";ОДИНОЧНЫЕ;ПОЛЕ"));
(slot dam-distribution (default ";РАВНОМЕРНО"));
(slot dam-velichina-raskritia (default ""));
(slot dam-tech-pered-razrusheniem (default ";ДА;НЕТ"));
(slot dam-napravlenie (default ";ПРОДОЛЬНЫЕ;ПОПЕРЕЧНЫЕ"));
(slot dam-cf (default ""));
)
(deftemplate exist-meh-des ;
(slot caption-meh (default "ВОДОРОДНОЕ ОХРУПЧИВАНИЕ;ИЗНАШИВАНИЕ;КОРРОЗИЯ МЕСТНАЯ;КОРРОЗИЯ СТРУКТУРНАЯ;КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ;КОРРОЗИОННАЯ УСТАЛОСТЬ;МЕХАНИЧЕСКАЯ УСТАЛОСТЬ;ЭРОЗИЯ"));
(slot meh-cf (default ""));
)
(deftemplate exist-des ;
(slot caption-des (default ";ТРЕЩИНА (Ы) - НЕДОПУСТИМАЯ (ЫЕ)"));
(slot des-istochnik (default ";ПОВРЕЖДЕНИЕ ПОВЕРХНОСТИ;ОТВЕРСТИЕ (КОНЦЕНТРАЦИЯ НАПРЯЖЕНИЯ БОЛЕЕ 2)"));
(slot des-mestopolozenie (default ";НА ПОВЕРХНОСТИ;НА ВНЕШНЕЙ ПОВЕРХНОСТИ;НА ВНУТРЕННЕЙ ПОВЕРХНОСТИ;БЛИЗЛЕЖАЩИЕ ЗОНЫ ТЕРМИЧЕСКОГО ВЛИЯНИЯ;НА ПОВЕРХНОСТИ, В ПРЕДЕЛАХ ОДНОЙ ЗОНЫ ТЕРМИЧЕСКОГО ВЛИЯНИЯ"));
(slot des-orientacia (default ";ПЕРПЕНДИКУЛЯРНО;ПРОДОЛЬНО"));
(slot des-forma (default ";ПОЛУЭЛЛИПТИЧЕСКАЯ;ПСЕВДОПОЛУЭЛЛИПТИЧЕСКАЯ"));
(slot des-kolichestvo (default ";ОДИНОЧНЫЕ;ПОЛЕ"));
(slot des-napravlenie (default ";ПРОДОЛЬНЫЕ;ПОПЕРЕЧНЫЕ"));
(slot des-crack-glubina (default ";КРИТИЧЕСКАЯ"));
(slot des-koncentracia-naprazheniy (default ""));
(slot des-cf (default ""));
)
(deftemplate exist-meh-fail ;
(slot caption-meh (default "ВОДОРОДНОЕ ОХРУПЧИВАНИЕ;ИЗНАШИВАНИЕ;КОРРОЗИЯ МЕСТНАЯ;КОРРОЗИЯ СТРУКТУРНАЯ;КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ;КОРРОЗИОННАЯ УСТАЛОСТЬ;МЕХАНИЧЕСКАЯ УСТАЛОСТЬ;ЭРОЗИЯ"));
(slot meh-cf (default ""));
)
(deftemplate exist-fail ;
(slot caption-fail (default ";СКВОЗНАЯ ТРЕЩИНА;ХРУПКОЕ;ВЯЗКОЕ;КВАЗИХРУПКОЕ"));
(slot fail-istochnik (default ";ПОВРЕЖДЕНИЕ ПОВЕРХНОСТИ;ОТВЕРСТИЕ (КОНЦЕНТРАЦИЯ НАПРЯЖЕНИЯ БОЛЕЕ 2);КОНСТРУКТИВНЫЙ КОНЦЕНТРАТОР НАПРЯЖЕНИЙ ОБРАЗОВАННЫЙ ПЕРЕСЕЧЕНИЕМ ОТВЕРСТИЙ"));
(slot fail-mestopolozenie (default ";НА ПОВЕРХНОСТИ;НА ВНЕШНЕЙ ПОВЕРХНОСТИ;НА ВНУТРЕННЕЙ ПОВЕРХНОСТИ;БЛИЗЛЕЖАЩИЕ ЗОНЫ ТЕРМИЧЕСКОГО ВЛИЯНИЯ;НА ПОВЕРХНОСТИ, В ПРЕДЕЛАХ ОДНОЙ ЗОНЫ ТЕРМИЧЕСКОГО ВЛИЯНИЯ"));
(slot fail-orientacia (default ";ПЕРПЕНДИКУЛЯРНО"));
(slot fail-forma (default "ПОЛУЭЛЛИПТИЧЕСКАЯ;ПСЕВДОПОЛУЭЛЛИПТИЧЕСКАЯ"));
(slot fail-kolichestvo (default ";ОДИНОЧНЫЕ;ПОЛЕ"));
(slot fail-napravlenie (default ";ПРОДОЛЬНЫЕ;ПОПЕРЕЧНЫЕ"));
(slot fail-crack-opening (default "0,2"));
(slot fail-koncentracia-naprazheniy (default ""));
(slot fail-kriteriy-chrupkogo-des (default "Псевдополуэллиптическая  трещина достигла критического размера  раньше чем стала сквозной"));
(slot fail-proyavlenia (default ";УТЕЧКА РАБОЧЕЙ СРЕДЫ;УМЕРЕННЫЙ ВЫБРОС СРЕДЫ;ПОЛНЫЙ ВЫБРОС СРЕДЫ"));
(slot fail-vid (default ";КРИТИЧЕСКИЙ"));
(slot fail-nabludaemost (default ";СКРЫТЫЙ;ЯВНЫЙ"));
(slot fail-prognoz (default ";ВНЕЗАПНЫЙ"));
(slot fail-posledstvia (default ";ЗНАЧИТЕЛЬНЫЕ;НЕЗНАЧИТЕЛЬНЫЕ"));
(slot fail-cf (default ""));
)
;**************Facts*************************************************************
(deffacts initial-settings
(material ;
(caption )
(type СТАЛЬ)
(mechanical-prop-strength-limit )
(mechanical-prop-yield-limit )
(resistance-prop-corrosion )
(resistance-prop-temperature )
(resistance-prop-wear )
(chemical-prop-alloying )
(structure-prop-class )
(technological-heredity НЕОДНОРОДНОСТЬ ГРАНИЦ ЗЕРЕН ИЛИ ХРУПКОСТЬ ГРАНИЦ ЗЕРЕН ИЛИ НЕОДНОРОДНОСТЬ МИКРОНАПРЯЖЕННОГО СОСТОЯНИ)
)
)
;**************Rules*************************************************************
(defrule dam-mechanism-dam-ky "Описание правила: Правило_выявления_механизма_повреждения"
(Material_obekta_ ; 
(caption )
)
(type СТАЛЬ)
)
(mechanical-prop-strength-limit )
)
(mechanical-prop-yield-limit )
)
(resistance-prop-corrosion )
)
(resistance-prop-temperature )
)
(resistance-prop-wear )
)
(chemical-prop-alloying )
)
(structure-prop-class )
)
(technological-heredity НЕОДНОРОДНОСТЬ ГРАНИЦ ЗЕРЕН ИЛИ ХРУПКОСТЬ ГРАНИЦ ЗЕРЕН ИЛИ НЕОДНОРОДНОСТЬ МИКРОНАПРЯЖЕННОГО СОСТОЯНИЯ)
)
(ostatochnie-napryagenia ; 
(ostN-vid РАСТЯГИВАЮЩИЕ)
)
(ostN-znachenie МАКСИМАЛЬНЫЕ)
)
(ostN-mestopolozenie НА БОКОВОЙ ИЛИ ВОГНУТОЙ ПОВЕРХНОСТИ)
)
(ostN-orientacia ПРОДОЛЬНЫЕ)
)
(ostN-prichina ДЕФОРМАЦИЯ В ХОЛОДНОМ СОСТОЯНИИ ПРИ ГНУТЬЕ)
)
(mechanical-stress-const ; 
(stress-const-nalichie ДА)
)
(stress-const-type )
)
(stress-value )
)
(tension-type )
)
(tension-value )
)
(heat-exchange-technological-environment ; 
(type )
)
(pH АКТИВНАЯ (КИСЛАЯ или ЩЕЛОЧНАЯ))
)
(obshayGestkost )
)
(kislorod )
)
(gelezo )
)
(chlor )
)
(sera )
)
(azot )
)
(gidrozin-gidrat )
)
(elektrodniyPotencial )
)
=>
(assert 
(exist-meh-dam ; 
(type )
))
(pH АКТИВНАЯ (КИСЛАЯ или ЩЕЛОЧНАЯ))
))
(obshayGestkost )
))
(kislorod )
))
(gelezo )
))
(chlor )
))
(sera )
))
(azot )
))
(gidrozin-gidrat )
))
(elektrodniyPotencial )
))
)
(defrule dam-damage-ky "Описание правила: Правило_выявления_повреждений"
(exist-meh-dam ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
)
(meh-cf )
)
=>
(assert 
(exist-dam ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
))
(meh-cf )
))
)
(defrule des-mechanism-des-ky "Описание правила: Правило_выявления_механизма_разрушения"
(exist-meh-dam ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
)
(meh-cf )
)
(exist-dam ; 
(caption-dam ТРЕЩИНА (Ы) - ПОВРЕЖДЕНИЕ)
)
(dam-type-treshinoobrazovaniy )
)
(dam-istochnik )
)
(dam-mestopolozenie )
)
(dam-orientacia )
)
(dam-glubina менее 4)
)
(dam-dlina )
)
(dam-diametr )
)
(dam-forma )
)
(dam-forma-v-izlome )
)
(dam-kolichestvo )
)
(dam-distribution )
)
(dam-velichina-raskritia )
)
(dam-tech-pered-razrusheniem )
)
(dam-napravlenie )
)
(dam-cf )
)
=>
(assert 
(exist-meh-des ; 
(caption-dam ТРЕЩИНА (Ы) - ПОВРЕЖДЕНИЕ)
))
(dam-type-treshinoobrazovaniy )
))
(dam-istochnik )
))
(dam-mestopolozenie )
))
(dam-orientacia )
))
(dam-glubina менее 4)
))
(dam-dlina )
))
(dam-diametr )
))
(dam-forma )
))
(dam-forma-v-izlome )
))
(dam-kolichestvo )
))
(dam-distribution )
))
(dam-velichina-raskritia )
))
(dam-tech-pered-razrusheniem )
))
(dam-napravlenie )
))
(dam-cf )
))
)
(defrule des-destruction-ky "Описание правила: Правило_выявления_разрушений"
(exist-meh-des ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
)
(meh-cf )
)
=>
(assert 
(exist-des ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
))
(meh-cf )
))
)
(defrule fail-mechanism-fail-ky "Описание правила: Правило_выявления_механизма_отказа"
(exist-meh-des ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
)
(meh-cf )
)
(exist-des ; 
(caption-des ТРЕЩИНА (Ы) - НЕДОПУСТИМАЯ (ЫЕ))
)
(des-istochnik )
)
(des-mestopolozenie )
)
(des-orientacia ПЕРПЕНДИКУЛЯРНО)
)
(des-forma )
)
(des-kolichestvo )
)
(des-napravlenie ПРОДОЛЬНЫЕ)
)
(des-crack-glubina КРИТИЧЕСКАЯ)
)
(des-koncentracia-naprazheniy )
)
(des-cf )
)
=>
(assert 
(exist-meh-fail ; 
(caption-des ТРЕЩИНА (Ы) - НЕДОПУСТИМАЯ (ЫЕ))
))
(des-istochnik )
))
(des-mestopolozenie )
))
(des-orientacia ПЕРПЕНДИКУЛЯРНО)
))
(des-forma )
))
(des-kolichestvo )
))
(des-napravlenie ПРОДОЛЬНЫЕ)
))
(des-crack-glubina КРИТИЧЕСКАЯ)
))
(des-koncentracia-naprazheniy )
))
(des-cf )
))
)
(defrule Pravilo_vyyavleniya_otkaza "Описание правила: Правило_выявления_отказа"
(exist-meh-fail ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
)
(meh-cf )
)
=>
(assert 
(exist-fail ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
))
(meh-cf )
))
(exist-fail ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
))
(meh-cf )
))
(exist-fail ; 
(caption-meh КОРРОЗИОННОЕ РАСТРЕСКИВАНИЕ)
))
(meh-cf )
))
)
(defrule Pravilo_vyyavleniya_mehanizma_otkaza "Описание для правила:"
(exist-meh-des ; 
(caption-meh ВОДОРОДНОЕ ОХРУПЧИВАНИЕ)
)
(exist-des ; 
=>
(assert 
(exist-meh-fail ; 
(caption-meh ВОДОРОДНОЕ ОХРУПЧИВАНИЕ)
))
)
