<?php
function first_name_and_middle_name($items, $perms = array(), &$collect) {
    if (empty($items)) { 
	$collect[] = array('Fname'=>$perms[0], 'Mname'=>$perms[1]);
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             first_name_and_middle_name($newitems, $newperms,$collect);
         }
    }
}

function all_combination2a($items, $perms = array(), &$collect) {
    if (empty($items)) { 
	$collect[] = array('Fname'=>$perms[0], 'Lname'=>$perms[1]);
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             all_combination2a($newitems, $newperms,$collect);
         }
    }
}



function all_combination3($items, $perms = array(), &$collect) {
    if (empty($items)) { 
	$collect[] = array('Fname'=>$perms[0], 'Mname'=>$perms[1],'Lname'=>$perms[2]);
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             all_combination3($newitems, $newperms,$collect);
         }
    }
}

function get_all_combination1($candidate, $fatherName)
{
	$result = array();
	$num = count($fatherName);
	// candidate
	for($h=0; $h< count($candidate); $h++) {
		//fathers
		for($i=0; $i < $num; $i++)
		{
			$result[] = array('Fname'=>$candidate[$h], 'Lname'=>$fatherName[$i]);
			$result[] = array('Fname'=>$fatherName[$i], 'Lname'=>$candidate[$h]);
			for($j = $i+1; $j < $num; $j++) {
				$result[] = array('Fname'=>$candidate[$h], 'Mname'=>$fatherName[$i], 'Lname'=>$fatherName[$j]);
				$result[] = array('Fname'=>$candidate[$h], 'Mname'=>$fatherName[$j], 'Lname'=>$fatherName[$i]);
				$result[] = array('Fname'=>$fatherName[$j], 'Mname'=>$candidate[$h], 'Lname'=>$fatherName[$i]);
				$result[] = array('Fname'=>$fatherName[$i], 'Mname'=>$candidate[$h], 'Lname'=>$fatherName[$j]);
				$result[] = array('Fname'=>$fatherName[$i], 'Mname'=>$fatherName[$j], 'Lname'=>$candidate[$h]);
				$result[] = array('Fname'=>$fatherName[$j], 'Mname'=>$fatherName[$i], 'Lname'=>$candidate[$h]);
			}		
		}
	}
	return $result;
}

function get_all_combination2($candidate, $fatherName)
{
	$result = array();
	$num = count($fatherName);
	foreach($candidate as $key=>$value) {
		//fathers
		for($i=0; $i < $num; $i++)
		{
			$result[] = array('Fname'=>$value['Fname'], 'Lname'=>$fatherName[$i]);
			$result[] = array('Fname'=>$fatherName[$i], 'Lname'=>$value['Fname']);
			$result[] = array('Fname'=>$value['Mname'], 'Lname'=>$fatherName[$i]);
			$result[] = array('Fname'=>$fatherName[$i], 'Lname'=>$value['Mname']);
			
			for($j = $i+1; $j < $num; $j++) {
				$result[] = array('Fname'=>$candidate[$h], 'Mname'=>$fatherName[$i], 'Lname'=>$fatherName[$j]);
				$result[] = array('Fname'=>$candidate[$h], 'Mname'=>$fatherName[$j], 'Lname'=>$fatherName[$i]);
				$result[] = array('Fname'=>$fatherName[$j], 'Mname'=>$candidate[$h], 'Lname'=>$fatherName[$i]);
				$result[] = array('Fname'=>$fatherName[$i], 'Mname'=>$candidate[$h], 'Lname'=>$fatherName[$j]);
				$result[] = array('Fname'=>$fatherName[$i], 'Mname'=>$fatherName[$j], 'Lname'=>$candidate[$h]);
				$result[] = array('Fname'=>$fatherName[$j], 'Mname'=>$fatherName[$i], 'Lname'=>$candidate[$h]);
			}		
		}
	}
	return $result;
}


//filter Name
function filter_father_name($candidate = array(), $father = array())
{	
	$result = array();
	$diffrence = array_diff($father,$candidate);
	foreach($diffrence as $key=>$val) {
		if(!empty($val)) {
			$result[] = $val;
		}
	}
	return $result;
	
}





function rule1($candidate, $father, $tmp = array())
{
	$result = get_all_combination1($candidate,$father);
	$final_array = array();
	foreach($result as $key=>$val) {
		if(isset($val['Mname'])) {
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname']);
			
			//make all possible comination with 1 alphabet  
			
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname'][0]);
			
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname'][0]);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname'][0]);
			
			
			
		}else {
			$final_array[] = array('Fname'=>$val['Fname'], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Lname'=>$val['Lname'][0]);
		}
	}
	echo "<pre>"; print_r($final_array);die;
}

function rule2($candidate, $father, $tmp = array())
{
	$result = get_all_combination2($candidate,$father);
	foreach($result as $key=>$val) {
	
		if(isset($val['Mname'])) {
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname']);
			
			//make all possible comination with 1 alphabet  
			
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname'][0]);
			
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname'][0]);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname'][0]);
			
			
			
		}else {
			$final_array[] = array('Fname'=>$val['Fname'], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Lname'=>$val['Lname'][0]);
		}
	}
	echo "<pre>"; print_r($final_array);die;
	
}

function rule3($candidate, $father, $tmp = array())
{
	first_name_and_middle_name($candidate, array(), $collecton);
	$result = get_all_combination2($collecton,$father);
	echo "<pre>"; print_r($result);die;
	foreach($result as $keys=>$values)
	{
		if(isset($val['Mname'])) {
			if(in_array($values['Fname'], $tmp) && in_array($values['Mname'], $tmp) && in_array($values['Lname'], $tmp))
			unset($result[$keys]);
			
		}else{
			if(in_array($values['Fname'], $tmp) && in_array($values['Lname'], $tmp))
			unset($result[$keys]);
		}
	}
	echo "<pre>"; print_r($result);die;
	foreach($result as $key=>$val) {
	
		if(isset($val['Mname'])) {
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname']);
			
			//make all possible comination with 1 alphabet  
			
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname'][0]);
			
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Mname'=>$val['Mname'], 'Lname'=>$val['Lname'][0]);
			$final_array[] = array('Fname'=>$val['Fname'], 'Mname'=>$val['Mname'][0], 'Lname'=>$val['Lname'][0]);
			
			
			
		}else {
			$final_array[] = array('Fname'=>$val['Fname'], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'][0], 'Lname'=>$val['Lname']);
			$final_array[] = array('Fname'=>$val['Fname'], 'Lname'=>$val['Lname'][0]);
		}
	}
	echo "<pre>"; print_r($final_array);die;
	
}
//********************start**************

//candidate
$FName = "Pawan";
$MName = "kumar";
$LName = "";
//father
$FFName = "Ashok";
$FMName = "kumar";
$FLName = "Mishra";

if(!empty($FName) && !empty($MName) && !empty($LName))
{
	$rule = 3;
	$candidate = array($FName, $MName, $LName);
	$father = filter_father_name($candidate, array($FFName, $FMName, $FLName));
}
else if((!empty($FName) && !empty($MName)) || (!empty($FName) && !empty($LName))) 
{
	if(!empty($FName) && !empty($LName))
	{
		
		$candidate = array($FName, $LName);
		$father = filter_father_name($candidate, array($FFName, $FMName, $FLName));
		$final_array = rule2($candidate, $father);
	}
	else
	{
		$candidate = array($FName, $MName);
		$father = filter_father_name($candidate, array($FFName, $FMName, $FLName));
		$final_array = rule3($candidate, $father, array($FFName, $FMName, $FLName));
	}
	
}
else
{
	$candidate = array($FName);
	$father = filter_father_name($candidate, array($FFName, $FMName, $FLName));
	$final_array = rule1($candidate, $father);
}




?>

 
