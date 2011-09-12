<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=header.first
[END_COT_EXT]
==================== */

/**
 * Compiler for LESS CSS files
 *
 * @author Koradhil, Leaf Corcoran
 * @license MIT
 */

defined('COT_CODE') or die('Wrong URL.');

require_once(cot_incfile('lessc', 'plug', 'inc'));

$dirs = array(
	'./themes/'.$usr['theme'],
	'./themes/'.$usr['theme'].'/css'
);

$cachetime = $cfg['plugin']['lessc']['cachetime'] * 60;

$lessfiles = array();
foreach($dirs as $dir)
{
	$cachename = base64_encode($dir);
	if($cachetime && $cache && $cache->mem)
	{
		if ($cache->mem->exists($cachename, 'lessc'))
		{
			$lessfiles = @array_merge($lessfiles, $cache->mem->get($cachename, 'lessc'));
		}
		else
		{
			$lessfiles = @array_merge($lessfiles, glob("$dir/*.less"));
			$cache->mem->store($cachename, $lessfiles, 'lessc', $cachetime);
		}
	}
	elseif($cachetime && $cache && $cache->db)
	{
		if ($cache->db->exists($cachename, 'lessc'))
		{
			$lessfiles = @array_merge($lessfiles, $cache->db->get($cachename, 'lessc'));
		}
		else
		{
			$lessfiles = @array_merge($lessfiles, glob("$dir/*.less"));
			$cache->db->store($cachename, $lessfiles, 'lessc', $cachetime);
		}
	}
	else
	{
		$lessfiles = @array_merge($lessfiles, glob("$dir/*.less"));
	}
}
foreach ($lessfiles as $lessfile)
{
	try
	{
		$cssfile = substr($lessfile, 0, strrpos($lessfile, '.less')).'.css';
		lessc::ccompile($lessfile, $cssfile);
	}
	catch (exception $ex) {}
}

?>