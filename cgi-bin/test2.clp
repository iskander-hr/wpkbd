;**************************************************************
; ������������ ���� ������: ��������������� ������
;**************************************************************
; ��������: 
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
(Chastota-poliva ;������� ������
(Znachenie "�����")
)
(Osadki ;������
(Kolichestvo "��������")
)
(Temperatura-vozdukha ;����������� �������
(Znachenie "11-30")
)
)
;************************* Rules ******************************
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-1 "�������� �������: ����������� �������+������>�������� �������_1"
(Temperatura-vozdukha ;����������� �������
(Znachenie "0-10")
)
(Osadki ;������
(Kolichestvo "�����")
)
=>
(assert 
(Pogodnye-usloviya ;�������� �������
(Tip "��������, ����� ������")
))
)
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-2 "�������� �������: ����������� �������+������>�������� �������_2"
(Temperatura-vozdukha ;����������� �������
(Znachenie "11-30")
)
(Osadki ;������
(Kolichestvo "�����")
)
=>
(assert 
(Pogodnye-usloviya ;�������� �������
(Tip "������, ����� ������")
))
)
(defrule Temperatura-vozdukha+Osadki>Pogodnye-usloviya-3 "�������� �������: ����������� �������+������>�������� �������_3"
(Temperatura-vozdukha ;����������� �������
(Znachenie "11-30")
)
(Osadki ;������
(Kolichestvo "��������")
)
=>
(assert 
(Pogodnye-usloviya ;�������� �������
(Tip "������, ������� ������")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-1 "�������� �������: �������� �������+������� ������>��������� �����_1"
(Pogodnye-usloviya ;�������� �������
(Tip "������, ������� ������")
)
(Chastota-poliva ;������� ������
(Znachenie "�����")
)
=>
(assert 
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "��������")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-2 "�������� �������: �������� �������+������� ������>��������� �����_2"
(Pogodnye-usloviya ;�������� �������
(Tip "������, ������� ������")
)
(Chastota-poliva ;������� ������
(Znachenie "�� �����")
)
=>
(assert 
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "������������������")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-3 "�������� �������: �������� �������+������� ������>��������� �����_3"
(Pogodnye-usloviya ;�������� �������
(Tip "��������, ����� ������")
)
(Chastota-poliva ;������� ������
(Znachenie "�� �����")
)
=>
(assert 
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "��������������������")
))
)
(defrule Pogodnye-usloviya+Chastota-poliva>Sostoyanie-pochvy-4 "�������� �������: �������� �������+������� ������>��������� �����_4"
(Pogodnye-usloviya ;�������� �������
(Tip "��������, ����� ������")
)
(Chastota-poliva ;������� ������
(Znachenie "�����")
)
=>
(assert 
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "������������������")
))
)
(defrule Sostoyanie-pochvy>Urozhay-1 "�������� �������: ��������� �����>������_1"
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "��������")
)
=>
(assert 
(Urozhay ;������
(Pokazatel "�������")
))
)
(defrule Sostoyanie-pochvy>Urozhay-2 "�������� �������: ��������� �����>������_2"
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "������������������")
)
=>
(assert 
(Urozhay ;������
(Pokazatel "�������")
))
)
(defrule Sostoyanie-pochvy>Urozhay-3 "�������� �������: ��������� �����>������_3"
(Sostoyanie-pochvy ;��������� �����
(Sostoyanie "��������������������")
)
=>
(assert 
(Urozhay ;������
(Pokazatel "�����")
))
)
