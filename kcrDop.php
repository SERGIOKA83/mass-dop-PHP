<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />

		<title>Усложненное допзадание</title>

	</head>
	<body>

		<h1>Массивы</h1>


		<h2>Задание 2</h2>

		<?php
			$mega_sort_arr = ["A1",["ax",11.37,["z","x","c"],"aaa","bbb"],"A2",[10,20,[36.6,"y",12.5],15],"A22","A3","A0",["eee","aaa",12,25.3],5,1,3];
			//$m = ["A7","A1",["ax",11.37,["z","x","c"],"aaa","bbb"],"A3","A4","A2"];
			//$m = ["A7","A1",["ax",11.37,["z","x","c"],"aaa","bbb"],"A3","A4","A2"];
			//$m = ["A7","A4","A3","A1",["ax",11.37,["z","x","c"],"aaa","bbb"]];
			//$m = ["A7","A4","A3","A1",["z","x","c"]];
			//$m = ["A7","A4","A3",["z","x","c"],"A1"];
			//$m = ["A7","A4","A3",["z","x","c"],"A1",["ax","aaa","bbb","ccc"]];
			//$m = ["A7","A4","A3","A1"];
            //$m = ["ax",11.37,"aaa","bbb"];
            //$m = ["z","x","c"];
            //$m = ["a","d","b","c"];
            //$m = [1,4,2,3];
			//$m = ["A7",["z","x","c"],"A4","A3","A1"];
			//$m = ["A7","A4",["z","x","c"],"A3","A1"];
			//$m = ["A7",["z","x","c"],"A4",["ax","aaa","bbb","ccc"],"A3","A1"];
			//$m = ["A7",["ax",11.37,["z","x","c"],"aaa","bbb"],"A1","A2","A3","A4"];
			//$m = ["A7",["d","b","a",["b","a", ["c","b","a"]],"c"],"A1",["c","b",["d","b","a","c"],"a"],"A4",["b","a", ["c","b","a"]],"A2","A3"];
	         //$m = ["A7",["ax",11.37,["z","x","c"],"aaa","bbb"],"A1",["z","x","c"],"A2","A3","A4"];
			// $m = ["A7","A4","A3","A2",["ax","aaa","bbb"],"A1",["z","x","c"]];

			function viewLevels( array $mass_levels ) : void
            {

                echo "<ul>";

                foreach($mass_levels as $value)
                {

                    if(is_array($value))
                    {

                        viewLevels($value);   //Если $value - массив, то совершаем рекурсивный вызов функции.

                    }
                    else   //Иначе выводим переменную.
                    {

                        echo "<li>$value</li>";

                    }

                }

                echo "</ul>";

            }

            //функция позволяющая определять наличие массива за элементом,
            // который собираемся сортировать
			function massHelper(int $count_mass,int $limit, array $mass ) : int
            {

                $count_mass++;

                if($count_mass>$limit)

                    return $count_mass-1;

                else
                {
                    if(is_array($mass[$count_mass]))

                        return $count_mass;

                    else

                        return $count_mass-1;

                }

            }

			function massSortMenu( array $mass_levels ) : array
            {

                $size = sizeof($mass_levels);

                for($i = $size-1; $i>=0; $i--)
                {

                    for($j = 0; $j < $i; $j++)
                    {

                        if(!is_array($mass_levels[$j]))
                        {

                            {
                                $first_mass = $j;

                                $first_mass = massHelper( $first_mass, $size-1, $mass_levels );

                                if ($first_mass<$i)///????

                                {

                                    $second_mass = $first_mass + 1;

                                    $second_mass = massHelper( $second_mass, $size-1, $mass_levels );

                                    if($mass_levels[$j] > $mass_levels[$first_mass+1])
                                    {

                                        //сохраняем второе значение с привязанным к нему массивом (если он есть)
                                        for($ind_sec = $first_mass+1, $i_temp = 0; $ind_sec <=$second_mass; $ind_sec++, $i_temp++)
                                        {

                                            $temp_mass[$i_temp] = $mass_levels[$ind_sec];

                                        }

                                        //копируем первое значение с привязанным массивом (если он есть) на место второго
                                        for($ind = $first_mass, $ind_first = $second_mass; $ind >= $j; $ind--, $ind_first--)
                                        {

                                            $mass_levels[$ind_first] = $mass_levels[$ind];

                                        }

                                        //восстанавливаеим второе значение с привязанным к нему массивом (если он есть) на месте первого
                                        for($i_cop = $j, $r_cop = 0 ; $i_cop < ($second_mass - $first_mass)+$j; $i_cop++, $r_cop++ )
                                        {

                                               $mass_levels[$i_cop] = $temp_mass[$r_cop];

                                        }

                                    }

                                }

                            }

                        }

                    }

                    if(is_array($mass_levels[$i]))
                    {

                        $mass_levels[$i] = massSortMenu($mass_levels[$i]);

                    }

                }

                return 	$mass_levels;

            }

			function delElement( array $mass_levels ) : array
            {

                foreach($mass_levels as $key => $value)
                {

                    if(is_array($value))

                        $mass_levels[$key] = delElement($value);

                    else
                    {

                        if (is_double($value) or is_string($value))
                        {

                            unset($mass_levels[$key]); //Удаляем нецелочисленные элементы

                        }

                    }

                }

                return $mass_levels;

            }

			echo "</br>Исходный вид</br>";

			viewLevels( $mega_sort_arr);


			echo "</br>После сортировки как меню</br>";

			$mass=massSortMenu( $mega_sort_arr);

			viewLevels($mass);

			echo "</br>После удаления нецелочисленных элементов</br>";

			viewLevels(delElement( $mass ));
		?>


</body>
</html>

