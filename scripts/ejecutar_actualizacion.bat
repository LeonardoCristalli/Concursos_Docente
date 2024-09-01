@echo off
start /b sqlcmd -S (localdb)\MSSQLLocalDB -d llamados_vacantes -U llamados_vacantes_login -P jumba123 -i "C:\Users\54341\Documents\Facultad\4\EG\TP_Integrador\Scripts\actualizar_vacantes_a_abiertas.sql" >nul 2>&1
start /b sqlcmd -S (localdb)\MSSQLLocalDB -d llamados_vacantes -U llamados_vacantes_login -P jumba123 -i "C:\Users\54341\Documents\Facultad\4\EG\TP_Integrador\Scripts\actualizar_vacantes.sql" >nul 2>&1
