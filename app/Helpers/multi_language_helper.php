<?php

function get_phrase($phrase = '')
{
	$current_language	= (session())->get('lang');

	$db      = \Config\Database::connect();
	$builder = $db->table('language');
	// query for finding the phrase from `language` table
	$row	=	$builder->getWhere(['phrase' => $phrase])
						->getRow();	
	if (is_null($row)){
		/** insert blank phrases initially and populating the language db ***/
		$builder->insert(['phrase' => $phrase , 'en'=> $phrase]);
	}

	// return the current sessioned language field of according phrase, else return uppercase spaced word
	if (isset($row->$current_language) && ($row->$current_language != "" || is_null($row->$current_language)))
		return $row->$current_language;
	else
		return ucwords(str_replace('_', ' ', $phrase));

}



function pluralize($single = '', $plural = NULL, $count = 1)
{
	return ($count <= 1) ? ucwords($single) : ucwords(($plural == NULL) ? $single . 's' : $plural);
}
