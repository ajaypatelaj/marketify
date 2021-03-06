<?php

class Java
{

  public static function getClassName($code)
  {
    $re = preg_match('/class [^ ]+ extends YRecipe/',$code,$matches);
    if($re != 1)
      return NULL;

    $xpl = explode(' ',$matches[0]);
    return $xpl[1];
  }

  public static function addReplaceImports($in)
  {
    $repl =  array(
		  'import pl.poznan.put.cs.ify.api.*;',
		  'import pl.poznan.put.cs.ify.api.exceptions.*;',
		  'import pl.poznan.put.cs.ify.api.features.*;',
		  'import pl.poznan.put.cs.ify.api.features.events.*;',
		  'import pl.poznan.put.cs.ify.api.group.*;',
		  'import pl.poznan.put.cs.ify.api.log.*;',
		  'import pl.poznan.put.cs.ify.api.params.*;',
		  'import pl.poznan.put.cs.ify.api.security.*;',
		  'import pl.poznan.put.cs.ify.api.types.*;',
		  );

    $lines = explode("\n",$in);
    for($i = 0; $i < count($lines); $i++)
      if(in_array(trim($lines[$i]),$repl))
	unset($lines[$i]);

    return implode("\n",array_merge($repl,$lines));
  }

  public static function isSafe($in)
  {
    $dangers = array(
		     'android.',
		     'java.lang.Class.',
		     );
    
    foreach($dangers as $danger)
      if(strpos($in,$danger) !== false)
	return false;

    return true;
  }

}