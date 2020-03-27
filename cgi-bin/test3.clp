;**************************************************************
; ������������ ���� ������: Knowledge base 10234235031
;**************************************************************
; ��������: 
;**************************************************************
;********************* Templates ******************************
(deftemplate incident-object ;object of the incident
(slot cf (default "1")) ;certainty factor
(slot caption (default "��� ������")) ;name of the object
)
(deftemplate object-properties ;property of the object
(slot cf (default "1")) ;certainty factor
(slot caption) ;name of the object
(slot caption-incident-object) ;ref to the object
)
(deftemplate material ;material of the object
(slot cf) ;certainty factor
(slot caption) ;������������
(slot type (default "�����")) ;���
(slot mechanical-prop-strength-limit) ;strength limit
(slot mechanical-prop-yield-limit) ;�������� ���������
(slot resistance-prop-corrosion) ;Corrosion resistance
(slot resistance-prop-temperature) ;temperature resistance
(slot resistance-prop-wear) ;chemical properties
(slot chemical-prop-alloying) ;structure
(slot structure-prop-class) ;structural class / martensitic / ferritic/
)
(deftemplate technological-heredity ;��������������� ����������������
(slot cf (default 1)) ;����������� �����������
(slot caption) ;������������
)
(deftemplate making-defects ;������� ������������
(slot caption-technological-heredity) ;������ �� ��������������� ����������������
(slot type) ;��� /������������/������� ������������/
(slot cause) ;������� /������/
(slot location) ;����������������� /���� ����-�� �����������/
(slot cf (default 1)) ;����������� �����������
)
(deftemplate mechanical-stress-const ;������������ �������� - �����������/����������/
(slot stress-const-type (default "HIGH")) ;��� ����������� ��������/���������� ��������/���//��������������� �������� /��//�������������� ��������/
(slot stress-value (default 0)) ;�������� ��������
(slot tension-type) ;��� ���������� /������������� / ��������� / ������/
(slot tension-value) ;�������� ����������
(slot cycle-amplitude) ;��������� �����
(slot cycle-frequency) ;������� �����
(slot cycle-asymmetry) ;����������� ���������� �����
(slot cycle-average-value) ;������� �������� �����
(slot speed) ;��������
(slot speed-up) ;���������
(slot max-stress-value) ;������������ �������� ��������
(slot cf (default 1)) ;����������� �����������
)
(deftemplate technological-environment ;/�������/ ��������������� �����
(slot contents-molecular-hydrogen (default "ACTIVE")) ;���������� ������������� �������� /������ 10% ��/�� 10% �� 50% ��/������ 50 % ��/
(slot ph) ;���������� ���������� /������ 0-7 /������� ����� ������, ����������� ������������� � ����/, = 7 /������� ����� �����������/, ������ 7-15 /������� ����� ��������, �������� �������� ������������� � 15//
(slot radiation) ;�������� /����������� / ���������������� / ������������/
(slot properties-alternation) ;����������� ������� ����� /��/���/
(slot environment-humidity) ;��������� �����
(slot environment-flash) ;����������� ������� ����� �����
(slot cf (default 1)) ;����������� �����������
)
(deftemplate heat-exchange-technological-environment ;������������� ��������������� �����
(slot environment-type) ;��� /��������� ���� /�����������������/ / ���������-��������� ���� /�� ������������/ / ���������-��������� ���� /�������������//
(slot ph (default "�����������")) ;���������� ����������
(slot cf (default 1)) ;����������� �����������
)
(deftemplate exist-event ;����������� ������� ��������
(slot cf) ;����������� �����������
(slot caption) ;������������ �������
(slot caption-kin) ;������ �� ��������
(slot probabilityrel (default "0")) ;����������� �������������
(slot id (default "0"))
)
(deftemplate exist-dam ;����������� �����������
(slot id-dam (default "CRACK"))
(slot caption-dam) ;������������ �����������
(slot dam-type) ;��� /� ������� ������� ��� ������������������/
(slot dam-stress-type) ;��� ����������
(slot dam-mesto-zarozdenia) ;����� ���������� /��������, �������/
(slot dam-istochnik (default "CORROSION FATIGUE")) ;��������
(slot dam-mestopolozenie) ;��������������
(slot dam-orientacia) ;������������ /��������, �������/
(slot dam-glubina) ;�������
(slot dam-dlina) ;�����
(slot dam-diametr) ;�������
(slot dam-forma) ;����� � ������
(slot dam-kolichestvo) ;���������� ����������� ������� �� �������
(slot dam-velichina-raskritia) ;������� ���������
(slot dam-tech-pered-razrusheniem) ;�������� ���� ����� �����������
(slot dam-napravlenie) ;����������� �� ��������� � ������� ���
(slot caption-def)
(slot id-def)
(slot caption-meh)
(slot dam-cf (default 1)) ;����������� �����������
)
(deftemplate exist-des ;����������� ����������
(slot id-des (default "BRITTLE FAILURE"))
(slot caption-des) ;������������
(slot des-istochnik) ;��������
(slot des-orientacia) ;������������ /��������, �������/
(slot des-napravlenie) ;����������� �� ��������� � ������� ���
(slot des-forma) ;�����
(slot des-kolichestvo) ;����������
(slot des-koncentracia-naprazheniy)
(slot des-mestopolozenie (default "CRACK")) ;��������������
(slot caption-dam)
(slot id-dam)
(slot caption-meh)
(slot des-cf (default 1)) ;����������� �����������
)
(deftemplate exist-def ;����������� �������
(slot id-def)
(slot caption-def) ;������������
(slot caption-meh)
(slot def-cf (default 1)) ;����������� �����������
)
(deftemplate exist-meh ;����������� ��������
(slot caption-meh (default "CORROSION FATIGUE")) ;������������
(slot meh-cf (default 1)) ;����������� �����������
)
(deftemplate exist-kin ;����������� �������� ������
(slot caption (default "KINETICS 'CORROSION FATIGUE'")) ;������������
(slot caption-meh (default "CORROSION FATIGUE")) ;������ �� ��������
(slot cf (default 1)) ;��������� ������� -
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
(defrule fai-mechanism-ky-1001 "������� ��������� /���������/: ���� ������� ������������ �������� ������� ������� � �������� ��������������� ����� � ������������� ���������� � �������� ����������������� ����� � ������� ������� ������������ �� ����� ���������� �������� ������������ ���������"
(mechanical-stress-const ;������������ ��������
(cycle-frequency "HIGH") ;-----------
)
(technological-environment ;��������������� �����
(ph "ACTIVE") ;���������� ����������
(properties-alternation "YES") ;����������� ������� ����� /��/���/
)
(material ;��������
(type "STEEL") ;���
(chemical-prop-alloying "LOW-ALLOY STEEL") ;��������������
)
(making-defects ;������� ������������
(caption-technological-heredity ?id-th-m1) ;������ �� ��������������� ����������������
)
=>
(assert 
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;����� ���������� /��������/
(cf "0,9") ;��
))
(assert 
(exist-meh ;exist-meh
(caption-meh "CORROSION FATIGUE") ;����� ���������� /��������/
(meh-cf "0,9") ;��
))
)
(defrule fai-kinatics-ky-1001 "������� ��������� /��������/: ���� ����������� �������� ������������ ��������� �� ����� ���������� �������� ������������ ���������"
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;����������� /��������/
(cf ?x)
)
=>
(assert 
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����� ���������� /��������/
(caption-meh "CORROSION FATIGUE")
(cf ?x)
))
)
(defrule fai-kinatic-events-ky-1001 "������� ��������� /���������/������� ��������/: ���� ����������� �������� ������������ ��������� �� ����� ����������� �������: ������ ������� ����� ����� �������� ������� � ������ ������ ������� �����"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "LEAKAGE OF THE WORKING ENVIRONMENT THROUGH THE THROUGH CRACKS") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
(assert 
(exist-event ;exist-event
(caption "COMPLETE RESET OF THE WORKING ENVIRONMENT") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule fai-kinatic-events-ky-1002 "������� ��������� /����������� ������� ��������/: ���� ���������-�� �������� ������������ ��������� � ������� ������ ������� ����� ����� �������� ������� �� ����� ����������� ������� ����������� �������� �������"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/
)
(exist-event ;exist-event
(caption "LEAKAGE OF THE WORKING ENVIRONMENT THROUGH THE THROUGH CRACKS") ;/�������/
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE THROUGH CRACKS") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule fai-kinatic-events-ky-1003 "������� ��������� /����������� ������� ��������/: ���� ���������-�� �������� ������������ ��������� � ������� ������ ������ ������� ����� �� ����� ����������� ������� ������� ����������"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/
)
(exist-event ;exist-event
(caption "COMPLETE RESET OF THE WORKING ENVIRONMENT")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "BRITTLE FAILURE") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-mechanism-ky-1001 "�������� �������: des-mechanism-ky-1001"
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
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-mechanism-ky-1002 "�������� �������: des-mechanism-ky-1002"
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
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-mechanism-ky-1003 "�������� �������: des-mechanism-ky-1003"
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
(caption "FORMATION OF THE MACROCRACKS OF THE UNACCEPTABLE SIZE") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-kinatic-events-ky-1004 "�������� �������: des-kinatic-events-ky-1004"
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
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-kinatic-events-ky-1005 "�������� �������: des-kinatic-events-ky-1005"
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
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule des-kinatic-events-ky-1006 "�������� �������: des-kinatic-events-ky-1006"
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
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-mechanism-ky-1001 "������� ��������� /���������/"
(mechanical-stress-const ;������������ ��������
(cycle-frequency "HIGH") ;-----------
)
(technological-environment ;��������������� �����
(ph "ACTIVE") ;���������� ����������
(properties-alternation "YES") ;����������� ������� ����� /��/���/
)
(incident-object ;������ ���������
(caption ?id-inc-obj) ;���
)
(material ;��������
(type "STEEL") ;���
(chemical-prop-alloying "LOW-ALLOY STEEL") ;��������������
)
=>
(assert 
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;����� ���������� /��������/
(cf "0,9") ;��
))
)
(defrule dam-mechanism-ky-1002 "������� ��������� /���������/"
(mechanical-stress-const ;������������ ��������
(cycle-frequency "HIGH") ;-----------
)
(technological-environment ;��������������� �����
(ph "ACTIVE") ;���������� ����������
(properties-alternation "YES") ;����������� ������� ����� /��/���/
)
(incident-object ;������ ���������
(caption ?id-inc-obj) ;���
)
(material ;��������
(type "STEEL") ;���
(chemical-prop-alloying "LOW-ALLOY STEEL") ;��������������
)
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;����� ���������� /��������/
(cf "0,9") ;��
))
)
(defrule dam-kinatics-ky-1001 "������� ��������� /��������/"
(exist-event ;exist-event
(caption "MECHANISM 'CORROSION FATIGUE'") ;����������� /��������/
(cf ?x)
)
=>
(assert 
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����� ���������� /��������/
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1001 "������� ������������� �����������: ���� ����������� �������� ������������ ��������� �� ����� ���������� ����������� �������, ���������� - ���������, ����������, ��������������� ���������������"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/
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
(id-dam "��-1")
))
(assert 
(exist-event ;exist-event
(caption "MACROCRACKS DEVELOPMENT OF STRUCTURAL DAMAGE IN ZONES OF STRESS CONCENTRATORS 'FROM THE HOLE IN THE SAME PLANE IN TWO DIRECTIONS'") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1002 "�������� �������: dam-kinatic-events-ky-1002"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/ /
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
(caption "MERGING MICROCRACKS") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1003 "�������� �������: dam-kinatic-events-ky-1003"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/ /
)
(exist-event ;exist-event
(caption "MERGING MICROCRACKS")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "PREFERENTIAL DEVELOPMENT OF MICROCRACKS ORIENTED IN PLANES PERPENDICULAR TO THE MAXIMUM TENSILE STRESS") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1004 "�������� �������: dam-kinatic-events-ky-1004"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/ /
)
(exist-event ;exist-event
(caption "PREFERENTIAL DEVELOPMENT OF MICROCRACKS ORIENTED IN PLANES PERPENDICULAR TO THE MAXIMUM TENSILE STRESS")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "FORMATION OF THE MICROCRACKS") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1005 "�������� �������: dam-kinatic-events-ky-1005"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/ /
)
(exist-event ;exist-event
(caption "FORMATION OF THE MICROCRACKS")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "DEVELOPMENT OF INTRAGRANULAR SUBMICROCRACKS DUE TO THE DISSOLUTION IN THE SLIP PLANES") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
(defrule dam-kinatic-events-ky-1006 "�������� �������: dam-kinatic-events-ky-1006"
(exist-kin ;exist-kin
(caption "KINETICS 'CORROSION FATIGUE'") ;����������� /��������/ /
)
(exist-event ;exist-event
(caption "DEVELOPMENT OF INTRAGRANULAR SUBMICROCRACKS DUE TO THE DISSOLUTION IN THE SLIP PLANES")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
)
=>
(assert 
(exist-event ;exist-event
(caption "FORMATION OF LOCAL DEFORMATION ZONES IN THE SURFACE DUE TO CYCLIC LOADING") ;����� ���������� /�������/
(probabilityrel "1")
(caption-kin "KINETICS 'CORROSION FATIGUE'")
(cf ?x)
))
)
