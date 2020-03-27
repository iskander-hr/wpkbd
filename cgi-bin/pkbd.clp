;**************************************************************
; ������������ ���� ������: ���� ������ 1
;**************************************************************
; ��������: 
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
(slot Naimenovanie (default "���"))
)
(deftemplate Kinetika
(slot Naimenovanie (default "7"))
)
(deftemplate Vneshnie-proyavleniya
(slot Naimenovanie (default "����"))
)
;************************ Facts *******************************
(deffacts initial-settings
(Kinetika ;��������
(Naimenovanie "7")
)
)
;************************* Rules ******************************
(defrule Sreda+Tekhnologiya-izgotovleniya+Nagruzka>Degradatsionnyy-protsess "�������� �������: �����+���������� ������������+��������>�������������� �������"
(Sreda ;�����
(Tip "666")
)
(Tekhnologiya-izgotovleniya ;���������� ������������
(Naimenovanie "5")
)
(Nagruzka ;��������
(Tip "5")
)
=>
(assert 
(Degradatsionnyy-protsess ;�������������� �������
(Naimenovanie "���")
))
)
(defrule Kinetika>Vneshnie-proyavleniya "�������� �������: ��������>������� ����������"
(Kinetika ;��������
(Naimenovanie "7")
)
=>
(assert 
(Vneshnie-proyavleniya ;������� ����������
(Naimenovanie "����")
))
)
