<? session_start();
    header('Content-Type:text/html; charset=utf-8');

	include_once "_funciones.php";

	define( 'DB_SERVER',                  'localhost'     );
	define( 'DB_SERVER_USERNAME',         'tc000085_vecchia' );
    define( 'DB_SERVER_PASSWORD',         	'ra73fesaNA'      );
	define( 'DB_DATABASE',                'tc000085_vecchia'   );
	// Defino constantes
	define("_DB1_",						"mysql");
	define("DIR_INC",					"../model/");
	define("UPLOAD_DIR",				"/upload/");
	define("CLASS_MODEL_",				"../model/" );

	define( 'DIR_INCLUDES',             "include/" );


//include_once("_sesiones.php");

?>