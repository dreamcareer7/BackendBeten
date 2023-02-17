<?php

/*************************************
 *	safeResponse
 *		return json string of data sent
 *	Arguments
 *		$data, $code [ default 200, otherwise its error], $has_error [to inform reception]
 *	Todo - split this function to safeResponseData, safeResponseMessage, safeResponseError - WITH redirect option
 *
 ************************************/
if( ! function_exists('safeResponse') )
{
	function safeResponse($data, $code = 200, $has_error = false)
	{
		if( request()->ajax() ) {
			if( $has_error === true )
				return response()->json(["error"=>$data, "code"=>$code, "has_error"=>true,]);
			else
				return response()->json(["data"=>$data, "code"=>$code]);
		}
		else	{
			if( $has_error === true )
				return $data;
			return $data;
		}
	}
}
