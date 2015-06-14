<?php
//Code challenge
//company: Sparkcentral
//applicant:  Mike Roderick

class simpleCalculator{
  private $str_calc;

  //constructor, accepts inoput string for calculation
  public function simpleCalculator($str_input){
    //remove whitespace and other undesireables, store result in private variable
    $this->str_calc = preg_replace('/[^0-9%+-\/\*]/s', '', $str_input);
    if (sizeof($this->str_calc) > 0){
      print "successfully initialized.\nValue stored:".$this->str_calc."\n";
      return true;
    } else {
      return false;
    }
  }

  public function calculateResult(){
    //order of operations: multiplication, division and modulus, then addition and subtraction
    $this->handleMath('*');
    $this->handleMath('/');
    $this->handleMath('%');
    $this->handleMath('+');
    $this->handleMath('-');
    print "calculated value:".$this->str_calc."\n";
  } 

  private function handleMath($operator){
  	//Iterate over the equation, according to the operator that was passed in
    while(strpos($this->str_calc,$operator) !== false){
      //for debugging
      //echo $this->str_calc."...";
      
      //find number1 and number2 based on operand
      $operator_position = strpos($this->str_calc,$operator);
      
      //get the first number+position in this operation
      $first_half = substr($this->str_calc,0,$operator_position);
      $first_parts = preg_split("/[%+-\/\*]+/",$first_half);
      $number1 = array_pop($first_parts);
      $numberpos1 = strrpos($first_half,$number1);
      
      //get the second number+position in this operation
      $second_half = substr($this->str_calc,$operator_position+1);
      $second_parts = preg_split("/[%+-\/\*]+/",$second_half);
      $number2 = array_shift($second_parts);
      $numberpos2 = ($operator_position + 1) + strlen($number2);
      
      //do the math
      $result = $this->mathOp($number1, $number2, $operator);
      
      //shoehorn the result back into the string
      $this->str_calc = substr($this->str_calc,0,$numberpos1) . $result . substr($this->str_calc,$numberpos2);
      
      //for debugging
      //print "becomes: ".$this->str_calc."\n";
    }
  }
  
  private function mathOp($number1, $number2, $operator){
    switch($operator){
      case '*':
      	return $number1 * $number2;
      	break;
      case '/':
      	return $number1 / $number2;
      	break;
      case '+':
      	return $number1 + $number2;
      	break;
      case '-':
      	return $number1 - $number2;
      	break;
      case '%':
      	return $number1 % $number2;
      	break;
    }	
  }
  
}
echo 'starting...';
$x = new simpleCalculator('a e q 5 + 9 - 4 * 2 / 4 % 5 * 2');
$x->calculateResult();
?>
