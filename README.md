# Concursos Docentes

# Instrucciones de Importación de la Base de Datos

Para importar la base de datos en tu entorno local, sigue estos pasos:

1. Descarga el archivo llamados_vacantes_db_v6.sql de la carpeta database de este repositorio.

2. Conéctate a tu servidor local utilizando las credenciales adecuadas. Si aún no tienes un login creado para la base de datos llamados_vacantes, sigue estos pasos:

- Abre tu herramienta de administración de bases de datos y conéctate al servidor local.
- Navega hasta la sección de seguridad o usuarios del administrador de la base de datos.
- Busca la opción para crear un nuevo usuario o login y selecciónala.
- Ingresa el nombre de usuario (llamados_vacantes_login) y la contraseña (jumba123) que deseas asignar al nuevo login.
- En las opciones de autenticación, selecciona "SQL Server Authentication".
- Si es necesario, marca la casilla para aplicar una política de contraseñas.
- Confirma la creación del login haciendo clic en "OK" o "Crear".

Recuerda que estos pasos pueden variar ligeramente dependiendo de la herramienta de administración de bases de datos que estés utilizando. Asegúrate de adaptarlos según las opciones disponibles en tu entorno.

3. Crea una nueva base de datos llamada llamados_vacantes ejecutando el siguiente script SQL:

   CREATE DATABASE llamados_vacantes;

4. Haz clic derecho en la base de datos recién creada (llamados_vacantes) en el Explorador de Objetos y selecciona Tasks > Restore > Database....

5. En la ventana de restauración, selecciona From device y elige el archivo .sql que descargaste en el paso 1. Luego, sigue las instrucciones del asistente para completar el proceso de restauración.
