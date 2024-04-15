USE [master]
GO
/****** Object:  Database [llamados_vacantes]    Script Date: 15/4/2024 12:33:44 ******/
CREATE DATABASE [llamados_vacantes]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'llamados_vacantes', FILENAME = N'C:\Users\54341\llamados_vacantes.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'llamados_vacantes_log', FILENAME = N'C:\Users\54341\llamados_vacantes_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [llamados_vacantes] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [llamados_vacantes].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [llamados_vacantes] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [llamados_vacantes] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [llamados_vacantes] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [llamados_vacantes] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [llamados_vacantes] SET ARITHABORT OFF 
GO
ALTER DATABASE [llamados_vacantes] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [llamados_vacantes] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [llamados_vacantes] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [llamados_vacantes] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [llamados_vacantes] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [llamados_vacantes] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [llamados_vacantes] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [llamados_vacantes] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [llamados_vacantes] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [llamados_vacantes] SET  DISABLE_BROKER 
GO
ALTER DATABASE [llamados_vacantes] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [llamados_vacantes] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [llamados_vacantes] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [llamados_vacantes] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [llamados_vacantes] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [llamados_vacantes] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [llamados_vacantes] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [llamados_vacantes] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [llamados_vacantes] SET  MULTI_USER 
GO
ALTER DATABASE [llamados_vacantes] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [llamados_vacantes] SET DB_CHAINING OFF 
GO
ALTER DATABASE [llamados_vacantes] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [llamados_vacantes] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [llamados_vacantes] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [llamados_vacantes] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [llamados_vacantes] SET QUERY_STORE = OFF
GO
USE [llamados_vacantes]
GO
/****** Object:  User [llamados_vacantes_login]    Script Date: 15/4/2024 12:33:44 ******/
CREATE USER [llamados_vacantes_login] FOR LOGIN [llamados_vacantes_login] WITH DEFAULT_SCHEMA=[db_accessadmin]
GO
/****** Object:  Table [dbo].[areas]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[areas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[dpto_id] [int] NOT NULL,
 CONSTRAINT [PK_areas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[catedras]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[catedras](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[descrip] [varchar](1000) NULL,
	[plan] [varchar](50) NOT NULL,
	[ano_cursado] [varchar](50) NOT NULL,
	[hs_semanales] [int] NOT NULL,
	[tipo_cursado] [varchar](50) NOT NULL,
	[electiva] [bit] NOT NULL,
	[area_id] [int] NOT NULL,
 CONSTRAINT [PK_catedras] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dptos]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dptos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NULL,
 CONSTRAINT [PK_departamentos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[estados]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[estados](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[descrip] [varchar](50) NOT NULL,
 CONSTRAINT [PK_estados] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inscripciones]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inscripciones](
	[vacante_id] [int] NOT NULL,
	[usuario_id] [int] NOT NULL,
	[fecha] [date] NOT NULL,
	[puntaje] [int] NULL,
 CONSTRAINT [PK_inscripciones] PRIMARY KEY CLUSTERED 
(
	[usuario_id] ASC,
	[vacante_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[jefes_catedras]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[jefes_catedras](
	[catedra_id] [int] NOT NULL,
	[usuario_id] [int] NOT NULL,
	[fecha_desde] [date] NOT NULL,
 CONSTRAINT [PK_jefes_catedras] PRIMARY KEY CLUSTERED 
(
	[usuario_id] ASC,
	[catedra_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[usuarios]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuarios](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NOT NULL,
	[apellido] [varchar](50) NOT NULL,
	[sexo] [char](1) NOT NULL,
	[direccion] [varchar](50) NOT NULL,
	[telefono] [varchar](50) NOT NULL,
	[cuil] [varchar](50) NOT NULL,
	[email] [varchar](50) NOT NULL,
	[fecha_nac] [date] NOT NULL,
	[tipo_usu] [varchar](50) NULL,
	[nro_legajo] [varchar](50) NULL,
	[usuario] [varchar](50) NOT NULL,
	[password] [varchar](256) NULL,
	[nro_dni] [char](8) NOT NULL,
	[cv] [varbinary](max) NULL,
 CONSTRAINT [PK_usuarios] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [UC_usuarios_usuario] UNIQUE NONCLUSTERED 
(
	[usuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[vacantes]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[vacantes](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[descrip] [varchar](1000) NOT NULL,
	[fecha_ini] [date] NOT NULL,
	[fecha_fin] [date] NULL,
	[req] [varchar](1000) NULL,
	[tiempo] [varchar](50) NULL,
	[exp] [varchar](1000) NULL,
	[estado_id] [int] NOT NULL,
	[catedra_id] [int] NOT NULL,
 CONSTRAINT [PK_vacantes] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[vacantes_estados]    Script Date: 15/4/2024 12:33:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[vacantes_estados](
	[vacante_id] [int] NOT NULL,
	[estado_id] [int] NOT NULL,
	[fecha_desde] [date] NOT NULL,
	[observacion] [varchar](50) NULL,
 CONSTRAINT [PK_vacantes_estados] PRIMARY KEY CLUSTERED 
(
	[vacante_id] ASC,
	[estado_id] ASC,
	[fecha_desde] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[areas]  WITH CHECK ADD  CONSTRAINT [FK_areas_dptos] FOREIGN KEY([dpto_id])
REFERENCES [dbo].[dptos] ([id])
GO
ALTER TABLE [dbo].[areas] CHECK CONSTRAINT [FK_areas_dptos]
GO
ALTER TABLE [dbo].[catedras]  WITH CHECK ADD  CONSTRAINT [FK_catedras_areas] FOREIGN KEY([area_id])
REFERENCES [dbo].[areas] ([id])
GO
ALTER TABLE [dbo].[catedras] CHECK CONSTRAINT [FK_catedras_areas]
GO
ALTER TABLE [dbo].[inscripciones]  WITH CHECK ADD  CONSTRAINT [FK_inscripciones_usuarios] FOREIGN KEY([usuario_id])
REFERENCES [dbo].[usuarios] ([id])
GO
ALTER TABLE [dbo].[inscripciones] CHECK CONSTRAINT [FK_inscripciones_usuarios]
GO
ALTER TABLE [dbo].[inscripciones]  WITH CHECK ADD  CONSTRAINT [FK_inscripciones_vacantes] FOREIGN KEY([vacante_id])
REFERENCES [dbo].[vacantes] ([id])
GO
ALTER TABLE [dbo].[inscripciones] CHECK CONSTRAINT [FK_inscripciones_vacantes]
GO
ALTER TABLE [dbo].[jefes_catedras]  WITH CHECK ADD  CONSTRAINT [FK_jefes_catedras_catedras] FOREIGN KEY([catedra_id])
REFERENCES [dbo].[catedras] ([id])
GO
ALTER TABLE [dbo].[jefes_catedras] CHECK CONSTRAINT [FK_jefes_catedras_catedras]
GO
ALTER TABLE [dbo].[jefes_catedras]  WITH CHECK ADD  CONSTRAINT [FK_jefes_catedras_usuarios] FOREIGN KEY([usuario_id])
REFERENCES [dbo].[usuarios] ([id])
GO
ALTER TABLE [dbo].[jefes_catedras] CHECK CONSTRAINT [FK_jefes_catedras_usuarios]
GO
ALTER TABLE [dbo].[vacantes]  WITH CHECK ADD  CONSTRAINT [FK_vacantes_catedras] FOREIGN KEY([catedra_id])
REFERENCES [dbo].[catedras] ([id])
GO
ALTER TABLE [dbo].[vacantes] CHECK CONSTRAINT [FK_vacantes_catedras]
GO
ALTER TABLE [dbo].[vacantes]  WITH CHECK ADD  CONSTRAINT [FK_vacantes_estados] FOREIGN KEY([estado_id])
REFERENCES [dbo].[estados] ([id])
GO
ALTER TABLE [dbo].[vacantes] CHECK CONSTRAINT [FK_vacantes_estados]
GO
ALTER TABLE [dbo].[vacantes_estados]  WITH CHECK ADD  CONSTRAINT [FK_vacantes_estados_estados] FOREIGN KEY([estado_id])
REFERENCES [dbo].[estados] ([id])
GO
ALTER TABLE [dbo].[vacantes_estados] CHECK CONSTRAINT [FK_vacantes_estados_estados]
GO
ALTER TABLE [dbo].[vacantes_estados]  WITH CHECK ADD  CONSTRAINT [FK_vacantes_estados_vacantes] FOREIGN KEY([vacante_id])
REFERENCES [dbo].[vacantes] ([id])
GO
ALTER TABLE [dbo].[vacantes_estados] CHECK CONSTRAINT [FK_vacantes_estados_vacantes]
GO
USE [master]
GO
ALTER DATABASE [llamados_vacantes] SET  READ_WRITE 
GO
