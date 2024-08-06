@echo off
sqlcmd -S (localdb)\MSSQLLocalDB -d llamados_vacantes -U TU_USUARIO -P TU_CONTRASENA -i "C:\ruta\al\script\actualizar_vacantes.sql"