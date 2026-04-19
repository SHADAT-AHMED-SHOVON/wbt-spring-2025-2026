 <?php  
        echo "Task 1" . "<br>";
        $length = 5;
        $width = 10;
        $area = $length * $width ;
        echo "Length is: " . $length . "<br>";
        echo "Width is: " . $width . "<br>";
        echo "Area is: " . $area . "<br>";
        $perimeter = 2 * ($length + $width);
        echo "Perimeter is: " . $perimeter . "<br>". "<br>";

        echo "Task 2" . "<br>";
        $amount = 500;
        echo "Amount is: " . $amount . "<br>";
        $vat = 0.15 * $amount;
        echo "Vat is: " . $vat . "<br>" . "<br>";

        echo "Task 3" . "<br>";
        $value = 93;
        echo "Value is: " . $value . "<br>";
        if($value%2 == 0) {
            echo "Even Number" . "<br>";
        }
        else{
            echo "Odd Number" . "<br>" . "<br>";
        }

        echo "Task 4" . "<br>";
        $num1 = 5;
        $num2 = 10;
        $num3 = 8;
        $large = 0;

        if($num1 > $num2 && $num1 > $num3){
            echo "Largest Number: " . $num1 . "<br>";
        }
        else if($num2 > $num1 && $num2 > $num3){
            echo "Largest Number: " . $num2 . "<br>";
        }
        else{
            echo "Largest Number: " . $num3 . "<br>";
        }
        echo "<br>";

        echo "Task 5" . "<br>";
        echo "Odd Numbers between 10 to 100: ";
        for ($i=10; $i<=100; $i++){
            if($i%2!=0){
                echo $i . " ";
            }
        } 
        echo "<br>" . "<br>";

        echo "Task 6" . "<br>";
        $department = array("CSE", "EEE". "IPE", "Pharmecy", "BBA", "LAW") ;
        $search = "CSE" ;
        $found = false;
        for($i=0; $i < count($department); $i++) {
           if($department[$i] == $search){
            $found = true;
            break;
           }
        }
         if($found == true){
                echo "Found the serched element." . "<br>";
            }
         else{
                echo "Can't find the searched element." . "<br>";
            }

        echo "<br>";

        echo "Task 7" . "<br>" . "<br>";
        echo "Print *" . "<br>";
        for($i=0; $i<3; $i++){
            for($j=0; $j<=$i; $j++){
                echo "*" . " ";
            } 
            echo "<br>";
        }

        echo "Print 1,2,3" . "<br>";
        for($i=3; $i>=1; $i--){
            for($j=1; $j<=$i; $j++){
                echo $j . " ";
            } 
            echo "<br>";
        }

        $letter = "A";
        echo "Print A,B,C" . "<br>";
        for($i=0; $i<3; $i++){
            for($j=0; $j<=$i; $j++){
                echo $letter . " ";
                $letter++;
            } 
            echo "<br>";
        }



    ?>