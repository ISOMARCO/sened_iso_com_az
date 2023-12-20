<?php 
function adlar()
{
	$siyahi = File::read(FILES_DIR."siyahi.txt");
	if(empty($siyahi))return false;
	$siyahi = explode("\n",$siyahi);
	$siyahi = array_combine(range(1,count($siyahi)),array_values($siyahi));
	$array = array();
	$i=1;
	while($i)
	{
		if($i > count($siyahi)) break;
		if(strlen($siyahi[$i]) == 1)
		{
			$j=$i;$say=0;$s=0;
			while($j){
				if(strlen($siyahi[$j]) == 1) {$say++;$j++;}
				else {array_push($array,$say+1);break;}
			}
			$s=$say;
			if($s!=0) $i+=$s;
			else $i++;
		}else {
		if($i!=count($siyahi) && strlen($siyahi[$i+1]) != 1) array_push($array,1);
		$i++;
		}
	}
	if(strlen($siyahi[count($siyahi)]) == 0) $array[count($array)-1]+=1;
	else array_push($array,1);
	return $array;
}

function adlar_say()
{
	$siyahi = File::read(FILES_DIR."siyahi.txt");
	if(empty($siyahi))return 0;
	$siyahi = explode("\n",$siyahi);
	return count($siyahi);
}

function hesabla($array,$txtname="say")
{
	$saylar = File::read(FILES_DIR.$txtname.".txt");
	if(empty($saylar)) return false;
	$saylar = explode("\n",$saylar);
	$result = array();
	for($i=0;$i<count($array);$i++)
	{
		$toplam=0;
		for($j=0;$j<$array[$i];$j++)
		{
			$toplam+=floatval(str_replace(",",".",$saylar[0]));
			array_shift($saylar);
		}
		array_push($result,$toplam);
	}
	return $result;
}

function siyahi($return = "name")
{
	$siyahi = File::read(FILES_DIR."siyahi.txt");
	$siyahi = explode("\n",$siyahi);
	$res = array();
	$tel = array();
	for($i=0;$i<count($siyahi);$i++)
	{
		if(strlen($siyahi[$i]) != 1 && !empty($siyahi[$i]))
		{
			if(strlen($siyahi[$i]) > 10)
			{
				$ex = explode(" ",$siyahi[$i]);
				$t=" ";
				for($j=0;$j<count($ex);$j++)
				{
					if($ex[$j]>9)
					{
						if(substr($ex[$j],0,3) === "055" || substr($ex[$j],0,3) === "050" || substr($ex[$j],0,3) === "051" || substr($ex[$j],0,3) === "070" || substr($ex[$j],0,3) === "077"){
							$siyahi[$i] = substr($siyahi[$i],0,strpos($siyahi[$i],$ex[$j]));
							$t=$ex[$j];
						}
					}
				}
				array_push($tel,$t);
			}else array_push($tel," ");
			array_push($res,$siyahi[$i]);
		}
	}
	
	if($return == "name") return $res;
	if($return == "tel") return $tel;
}
function tercume($array)
{
	$tr = File::read(FILES_DIR."tercume.txt");
	if(empty($tr)) return false;
	$tr = explode("\n",$tr);
	$result = array();
	for($i=0;$i<count($array);$i++)
	{
		$txt = "";
		for($j=0;$j<$array[$i];$j++)
		{
			if(strlen($tr[0]) > 1)
			{
				if($array[$i] <3)
				{
					if(empty($txt))
					$txt = trim($tr[0]);
					else $txt = trim($txt).",".$tr[0];
				}
			}
			array_shift($tr);
		}
		array_push($result,trim($txt));
	}
	return $result;
}

function logs_icon($str)
{
	if(strstr($str,"delete")) return $str." <i class='fas fa-trash-alt text-danger'></i>";
	if(strstr($str,"change")) return $str.' <i class="fas fa-edit text-primary"></i>';
	if(strstr($str,"upload")) return $str.' <i class="fas fa-file-upload text-success"></i>';
}