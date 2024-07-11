

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `ID` int(11) NOT NULL,
  `TipoInstitucionesID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participación`
--

CREATE TABLE `participación` (
  `ID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `TipoParticipación` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `países`
--

CREATE TABLE `países` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinstituciones`
--

CREATE TABLE `tipoinstituciones` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposidentificación`
--

CREATE TABLE `tiposidentificación` (
  `ID` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `TipoIdentificaciónID` int(11) NOT NULL,
  `Identificación` varchar(20) NOT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `CorreoPersonal` varchar(100) NOT NULL,
  `CorreoInstitucional` varchar(100) DEFAULT NULL,
  `InstituciónID` int(11) NOT NULL,
  `Dirección` varchar(100) NOT NULL,
  `Celular` varchar(20) NOT NULL,
  `PaísID` int(11) NOT NULL,
  `Provincia` varchar(50) DEFAULT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `CódigoPostal` varchar(20) DEFAULT NULL,
  `NivelEstudios` text DEFAULT NULL,
  `FacturarOtraPersona` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

