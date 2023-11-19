-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: chedraui
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NOT NULL,
  `cantidad` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `IdCliente` int unsigned NOT NULL,
  `Dni` varchar(8) DEFAULT NULL,
  `Nombres` varchar(244) DEFAULT NULL,
  `Direccion` varchar(244) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (17,'2','Juan Guerrero Solis','Los Alamos','1'),(18,'1','Maria Rosas Villanueva','Los Laureles 234','1'),(19,'3','Andres de Santa Cruz','Av. La Frontera 347','1'),(20,'4','Andres Mendoza','Chosica, Lurigancho','1');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_ventas` (
  `IdDetalleVentas` int unsigned NOT NULL,
  `IdVentas` int unsigned NOT NULL,
  `IdProducto` int unsigned NOT NULL,
  `Cantidad` int unsigned DEFAULT NULL,
  `PrecioVenta` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_ventas`
--

LOCK TABLES `detalle_ventas` WRITE;
/*!40000 ALTER TABLE `detalle_ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleventas`
--

DROP TABLE IF EXISTS `detalleventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleventas` (
  `idDetalleVentas` int NOT NULL AUTO_INCREMENT,
  `idventas` varchar(45) DEFAULT NULL,
  `idproducto` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDetalleVentas`),
  UNIQUE KEY `idventas_UNIQUE` (`idventas`),
  UNIQUE KEY `idproducto_UNIQUE` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleventas`
--

LOCK TABLES `detalleventas` WRITE;
/*!40000 ALTER TABLE `detalleventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `IdEmpleado` int unsigned NOT NULL,
  `Dni` varchar(8) NOT NULL,
  `Nombres` varchar(255) DEFAULT NULL,
  `Telefono` varchar(9) DEFAULT NULL,
  `Estado` varchar(1) DEFAULT NULL,
  `User` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'123','Pedro Hernandez','988252459','1','emp01'),(2,'123','Roman Riquelme','988252459','1','Jo46'),(3,'123','Palermo Suarez','453536458','1','Em22');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `idlogin` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nomina`
--

DROP TABLE IF EXISTS `nomina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nomina` (
  `idNomina` int NOT NULL AUTO_INCREMENT,
  `idusuario` int DEFAULT NULL,
  `idpuesto` int DEFAULT NULL,
  `idsucursal` int DEFAULT NULL,
  PRIMARY KEY (`idNomina`),
  KEY `idpersona_idx` (`idusuario`),
  KEY `idpuesto_idx` (`idpuesto`),
  KEY `idsucursal_idx` (`idsucursal`),
  CONSTRAINT `idpuesto` FOREIGN KEY (`idpuesto`) REFERENCES `puesto` (`idPuesto`),
  CONSTRAINT `idsucursal` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idSucursal`),
  CONSTRAINT `idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nomina`
--

LOCK TABLES `nomina` WRITE;
/*!40000 ALTER TABLE `nomina` DISABLE KEYS */;
/*!40000 ALTER TABLE `nomina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `idProducto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text,
  `imagen_url` varchar(255) NOT NULL,
  `cantidad` int NOT NULL,
  `fechaagregado` date NOT NULL,
  `categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Jamón de Pavo Fud Virgina 290g',32.50,NULL,'https://th.bing.com/th/id/OIP.kgZWTjUACWpZNCyjIM_zugHaHa?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(2,'Salchichas de Pavo San Rafael 500g',41.50,NULL,'https://th.bing.com/th/id/R.635a7e54be0d4ec4e1651b258bd12d02?rik=0ycpisk1oewAzA&pid=ImgRaw&r=0',50,'2023-11-18','Salchichoneria'),(3,'Jamón Real de Pavo Rebanadas Sándwich 250g',33.00,NULL,'https://th.bing.com/th/id/OIP.aj23G2IiQk4C27uRDvRIJgHaHa?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(4,'Jamón de Pavo Fud Virginia 450g',53.50,NULL,'https://th.bing.com/th/id/R.dabc6a2da37bf9797f8dcc57b4fbe1cb?rik=rqR4sAZnZLQaZg&pid=ImgRaw&r=0',50,'2023-11-18','Salchichoneria'),(5,'Pechuga de Pavo San Rafael Balance Rebanadas Delgadas 250g',50.00,NULL,'https://th.bing.com/th/id/OIP.MdXra9g6-Y_JMmHQCq9UWwHaHa?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(6,'Salchicha Alpino Pavo Frankfurt 500g',25.50,NULL,'https://th.bing.com/th/id/OIP.Jj9ODmh0RqNNVEMmYu4L0AHaHa?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(7,'Horneado Especial Fud de Pierna 1kg',115.00,NULL,'https://th.bing.com/th/id/OIP.kO-Rwfwg_8LrOiaLKzcd7QAAAA?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(8,'Salchichas de Pavo San Rafael para Hot Dog 500g',45.50,NULL,'https://www.movil.farmaciasguadalajara.com/wcsstore/FGCAS/wcs/products/1076698_S_1280_F.jpg',50,'2023-11-18','Salchichoneria'),(9,'Jamón Virginia de Pavo Zwan 400g',51.00,NULL,'https://th.bing.com/th/id/OIP.a4p_I5FoDcbiTyQg8_zSJgHaHa?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(10,'Pechuga de Pavo San Rafael Balance 250g',50.00,NULL,'https://res.cloudinary.com/walmart-labs/image/upload/w_960,dpr_auto,f_auto,q_auto:best/gr/images/product-images/img_large/00750104000675L.jpg',50,'2023-11-18','Salchichoneria'),(11,'Salchicha Zwan De Pavo Hot Dog 500g',32.00,NULL,'https://th.bing.com/th/id/OIP.cvf-gKJS4yXz110aUZNI9wHaHa?rs=1&pid=ImgDetMain',50,'2023-11-18','Salchichoneria'),(12,'Salchicha de Pavo tipo Frankfort Bafar 500 g',29.60,NULL,'https://i5.walmartimages.com.mx/gr/images/product-images/img_large/00750151846341L.jpg',50,'2023-11-18','Salchichoneria'),(13,'Jamón Alpino Pavo 400g',26.00,NULL,'https://res.cloudinary.com/walmart-labs/image/upload/d_default.jpg/w_960,dpr_auto,f_auto,q_auto:best/gr/images/product-images/img_large/00750132570179L.jpg',50,'2023-11-18','Salchichoneria'),(14,'Salchichas Fud con Pavo 500g',43.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22329085-150-150?v=638357683089370000&width=150&height=150&aspect=true',50,'2023-11-18','Salchichoneria'),(15,'Jamón Zwan Virginia Pavo 290g',39.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22328650-800-auto?v=638357676393100000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(16,'Pechuga de Pavo San Rafael Natural 1 Kg',414.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21464025-800-auto?v=638343772563300000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(17,'Jamón Zwan Virginia de Pavo 1 Kg',140.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21929382-800-auto?v=638350649445100000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(18,'Jamón de Pierna San Rafael Real 300g Referencia: 3007894',80.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22329128-800-auto?v=638357683293670000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(19,'Salchicha Zwan Pavo 500g',44.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22328920-800-auto?v=638357682339800000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(20,'Pechuga de Pavo Fud Virginia 250g',42.40,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22395308-800-auto?v=638358626215230000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(21,'Jamón rebanado de Pavo y Cerdo Bafar 400 g',26.85,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22328982-800-auto?v=638357682591130000&width=800&height=auto&aspect=true',50,'2023-11-18','Salchichoneria'),(22,'Tomate Saladet por kg',25.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21558689-800-auto?v=638344494691300000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(23,'Cebolla Blanca por kg',32.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22433040-800-auto?v=638359440534330000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(24,'Aguacate Hass por Kg',49.80,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21726104-800-auto?v=638347283735400000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(25,'Zanahoria por kg',25.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22227334-800-auto?v=638356751776830000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(26,'Papa Blanca por kg',39.80,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22367614-800-auto?v=638358414813230000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(27,'Pepino Verde por Kg',24.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21539026-800-auto?v=638344182052030000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(28,'Calabaza Italiana por Kg',23.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21493003-800-auto?v=638343936837000000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(29,'Cilantro Rollo',5.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22185221-800-auto?v=638355896767370000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(30,'Aguacate Hass Enmallado Pieza',6.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22234533-800-auto?v=638356847705970000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(31,'Lechuga Romana Pieza',16.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21726095-800-auto?v=638347283695830000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(32,'Espinacas Rollo',9.40,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22233467-800-auto?v=638356823896200000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(33,'Tomate Verde por kg',39.80,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21558687-800-auto?v=638344494677100000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(34,'Chayote sin Espinas por kg',39.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22234513-800-auto?v=638356847602170000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(35,'Manzana Golden Chica en Bolsa por Kg',32.80,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22227406-800-auto?v=638356752002330000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(36,'Chile Serrano por Kg',55.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22227659-800-auto?v=638356752857400000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(37,'Nopal por kg',26.40,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21849763-800-auto?v=638349887789630000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(38,'Piña Gota Miel por Kg',28.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22300784-800-auto?v=638357525842100000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(39,'Manzana Golden Mediana por Kg',49.80,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21825314-800-auto?v=638349647338570000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(40,'Melón Chino por Kg',24.50,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22300786-800-auto?v=638357525856670000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(41,'Uva Verde por kg',85.50,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21794552-800-auto?v=638349012038670000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(42,'Ajo por Kg',74.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22019644-800-auto?v=638351747257870000&width=800&height=auto&aspect=true',50,'2023-11-18','Frutas y Verduras'),(43,'Pierna y Muslo Americano Fresco de Pollo kg',31.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22394171-800-auto?v=638358618196300000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(44,'Camarón Grande sin Cabeza kg',299.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22359373-800-auto?v=638358325333200000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(45,'Pulpa de Cerdo kg',112.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21645834-800-auto?v=638346301720570000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(46,'Arrachera de Res Pulpa Marinada 500g',68.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21879382-800-auto?v=638350140045800000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(47,'Arrachera Sukarne de Res 600g',183.60,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21465114-800-auto?v=638343781574170000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(48,'Arrachera Marinada Ligera Sukarne de Res 600g',185.30,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22335529-800-auto?v=638357798244130000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(49,'Molida de Res kg',94.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22394061-800-auto?v=638358617734270000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(50,'Arrachera Natural Cerdo Nutrí Carne 450g',48.50,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21947180-800-auto?v=638350734227330000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(51,'Arrachera Marinada Sukarne Res 1 Pieza por Kg',313.65,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21519700-800-auto?v=638344071338830000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(52,'Milanesa Pollo kg',193.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22394174-800-auto?v=638358618207070000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(53,'Pechuga sin Hueso de Pollo kg',182.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22301153-800-auto?v=638357527556230000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(54,'Milanesa de Cerdo kg',116.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22221584-800-auto?v=638356680106900000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(55,'Pechuga Corte Americano de Pollo kg',65.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22394170-800-auto?v=638358618189500000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(56,'Filete de Tilapia por Kg',118.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22160031-800-auto?v=638355269303730000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(57,'Pechuga de Pollo sin Hueso Congelado por Kg',74.90,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21469590-800-auto?v=638343810498470000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(58,'Chuleta de Cerdo Ahumada por kg',122.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21786904-800-auto?v=638348867774070000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(59,'Bistec Pulpa Blanca de Res kg',179.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22394059-800-auto?v=638358617727400000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(60,'Molida fina de Res 95-5 kg',199.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21464954-800-auto?v=638343780758430000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(61,'Chuleta de Cerdo Natural kg',98.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21786809-800-auto?v=638348867441600000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(62,'Pollo Entero por kg',47.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21528410-800-auto?v=638344120323530000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(63,'Molida de Pierna de Cerdo kg',114.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21539351-800-auto?v=638344183329670000&width=800&height=auto&aspect=true',50,'2023-11-18','Carnes, Pescados y Mariscos'),(64,'Consola Xbox Series X 1TB Negro',11990.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22137362-800-auto?v=638354843404400000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(65,'Laptop Lenovo IP1 Cel 8GB 256SSD 14 Pulgadas + Mochila',5990.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22047919-800-auto?v=638352431958200000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(66,'Streaming Roku Tv Express ROK3960MX',590.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21963598-800-auto?v=638350878162000000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(67,'Pantalla TCL 55 Pulgadas Smart TV 4K UHD Roku TV 55S453',6890.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22371172-800-auto?v=638358436542330000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(68,'Echo Dot Amazon Bocina Inteligente Negra',595.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21995863-800-auto?v=638351509787370000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(69,'Echo Dot 5 Bocina inteligente con Alexa Negro',790.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22142523-800-auto?v=638354954005630000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(70,'Consola Xbox Series S 512GB Blanco',4590.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21995432-800-auto?v=638351508213630000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(71,'Pantalla Daewoo 32 Pulgadas Básica TV HD DAW32H',1995.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22002200-800-auto?v=638351544097100000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(72,'Pantalla Daewoo 50 Pulgadas Smart TV UHD Roku DAW50UR',4990.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22142509-800-auto?v=638354953920900000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(73,'Pantalla Sansui 32 Pulgadas Smart TV HD Roku SMX32D6HR',2490.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21997834-800-auto?v=638351522065270000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(74,'Pantalla Daewoo 70 Pulgadas Smart TV Roku UHD Frameless DAW70UR',11295.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22000086-800-auto?v=638351534687800000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(75,'Roku Express ROK3930MX',590.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22179361-800-auto?v=638355809606730000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(76,'Celular Moto G82 5G 128GB Negro Telcel',5999.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22047925-800-auto?v=638352431977470000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(77,'Pantalla LG 50 Pulgadas Smart TV UHD 4K AI ThinQ 50UQ8000PSB',6890.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21997787-800-auto?v=638351521876470000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(78,'Celular Telcel Motorola Moto E13 64 GB Blanco',1999.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22242773-800-auto?v=638356968785470000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(79,'Sistema de Audio Klipsch 2.1 Negro Pro Media 1063511-6251',1995.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21955145-800-auto?v=638350812709730000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(80,'Celular ZTE Blade L9 32GB Azul Telcel',1299.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22242722-800-auto?v=638356968573230000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(81,'Pantalla Daewoo 55 Pulgadas Smart TV Roku UHD DAW55URF',6290.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22142532-800-auto?v=638354954059900000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(82,'Pantalla LG 60 Pulgadas Smart TV UHD 4K TV AI ThinQ 60UQ8000PSB',8790.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22177633-800-auto?v=638355767550300000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(83,'Pantalla Sansui 55 Pulgadas Smart TV UHD Roku SMX55P7UR',5590.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/22001524-800-auto?v=638351541448130000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia'),(84,'Bafle Amplificado Fussion 15 Pulgadas PBS-15018',995.00,NULL,'https://chedrauimx.vtexassets.com/arquivos/ids/21934231-800-auto?v=638350677707170000&width=800&height=auto&aspect=true',50,'2023-11-19','Tecnologia');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puesto`
--

DROP TABLE IF EXISTS `puesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puesto` (
  `idPuesto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puesto`
--

LOCK TABLES `puesto` WRITE;
/*!40000 ALTER TABLE `puesto` DISABLE KEYS */;
INSERT INTO `puesto` VALUES (1,'administrador'),(2,'Empleado'),(3,'Cliente');
/*!40000 ALTER TABLE `puesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro` (
  `idregistro` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idregistro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sucursal` (
  `idSucursal` int NOT NULL AUTO_INCREMENT,
  `idlocalidad` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursal`
--

LOCK TABLES `sucursal` WRITE;
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  `idPuesto` int DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idPuesto` (`idPuesto`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idPuesto`) REFERENCES `puesto` (`idPuesto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Erick Santiago Gonzalez Marin','2321595692','winsomeparrot57@gmail.com','ErickSantiago18',1),(2,'Santy','1234567890','santy@gmail.com','santy123',3),(3,'Ruben Diaz','2321552505','rubendiaz@gmail.com','Ribendiaz232',2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `producto` varchar(255) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-19 12:12:27
