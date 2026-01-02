<?php

/**
 * ICD API client
 * 
 * @version		1.2
 * @author    	mdonada	 
 * @package		classes
 * @since 		icd-api-playground 1.0
 */

class INVENTARIO_API_Client
{

    private $api_response;
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    // public function get() {

    // 	if($this->makeRequest() == 401) { // unauthorized token 
    // 		$this->newToken();
    // 		$this->makeRequest();
    // 	}			 
    // 	return json_decode($this->api_response);
    // }

    public function get()
    {
        $this->getData();
        return json_decode($this->api_response);
    }

    public function getData()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // set curl without result echo
        $this->api_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $http_code;
    }
    public function postData($jsonData)
    {
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $this->uri);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        // 		'Accept: application/json'
        // ));			
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // set curl without result echo
        // $this->api_response = curl_exec($ch);
        // $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);		
        // curl_close($ch);

        // return $http_code;

        $ch = curl_init($this->uri);

        // 5. Configuras cURL para POST y envío de JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        // 6. Cabeceras: tipo JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ]);

        // 7. Ejecutas la petición
        $response = curl_exec($ch);

        // 8. Manejas errores si hay
        if (curl_errno($ch)) {
            return 'Error: ' . curl_error($ch);
        } else {
            // Opcional: ver respuesta del servidor
            return $response;
        }

        // 9. Cierras cURL
        curl_close($ch);
    }
}
