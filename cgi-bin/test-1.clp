;**************************************************************
; ������������ ���� ������: ���� ������ 28024867406
;**************************************************************
; ��������: 
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
(slot naimenovanie (default "���"))
)
(deftemplate kinetika
(slot naimenovanie (default "7"))
)
(deftemplate vneshnie-proyavleniya
(slot naimenovanie) ;************************ facts *******************************
)
;************************ Facts *******************************
(deffacts initial-settings
(kinetika ;��������
(naimenovanie "7")
)
)
;************************* Rules ******************************
(defrule sreda+tekhnologiya-izgotovleniya+nagruzka>degradatsionnyy-protsess "�������� �������: �����+���������� ������������+��������>�������������� �������"
(sreda ;�����
(tip "666")
)
(tekhnologiya-izgotovleniya ;���������� ������������
(naimenovanie "5")
)
(nagruzka ;��������
(tip "5")
)
=>
(assert 
(degradatsionnyy-protsess ;�������������� �������
(naimenovanie "���")
))
)
(defrule kinetika>vneshnie-proyavleniya "�������� �������: ��������>������� ����������"
(kinetika ;��������
(naimenovanie "7")
)
=>
(assert 
(vneshnie-proyavleniya ;������� ����������
(naimenovanie "IT WORKS!")
))
)
