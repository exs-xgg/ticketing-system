<?php

namespace App\Helpers;

class runCode
{

    static function run($code, $stdin)
    {
        $ch = curl_init();
		$parameters = array(
            'clientId' => '4cfd295e37b15fc6cda77e1222825dea',
            'clientSecret' => 'aa55c923319d164b035fcdfae295e31867500ad1598a05227c01daca2c2f83b1',
		    'script' => $code,
            'language' => 'java',
			'versionIndex' => '2',
			'stdin' => $stdin
		);
		curl_setopt( $ch, CURLOPT_URL,'https://api.jdoodle.com/v1/execute' );
		curl_setopt( $ch, CURLOPT_POST, 1 );

		//Send the parameters set above with the request
		$payload = json_encode( $parameters ); 
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		// Receive response from server
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$output = curl_exec( $ch );
		curl_close ($ch);

		//Show the server response
		return $output;
    }
}
