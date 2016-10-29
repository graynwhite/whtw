<?php

/* You should implement error checking, but for simplicity, we avoid it here */


if($_GET['action'] == 'get_products'){

    /* We're here to get the product listing...

        You can obviously change this file to include many

        different actions based on the request.

    */

    switch($_GET['id']){


        /* We had the following in our list.

                0 Audio

                1 Games

                2 Internet

            The integer value on the left is the value

            corresponding to the javascript selectedIndex

            property.*/

        case 0: // Audio Programs

            /* Print HTML to fill the product_cage <div> 
                Any output to the browser will be 

                retrieved in the XMLHttpRequest object's 

                responseText property */


            echo '

                <ul>

                    <li>CDex</li>

                    <li>CoolEdit</li>

                    <li>Winamp</li>

                    <li>XMMS</li>


                </ul>';

            break;

        case 1: //Games

            echo '

                <ul>

                    <li>Blackjack</li>

                    <li>Calculatron</li>


                    <li>Hold\'em</li>

                    <li>Minesweeper</li>

                    <li>Tetris</li>

                </ul>';

            break;

        case 2: //Internet


            echo '
				<form>
                <select>

                    <option>Epiphany</option>

                    <option>Internet Explorer</option>

                    <option>Mozilla</option>

                    <option>Netscape</option>


                    <option>Opera</option>

                    <option>Safari</option>

                </select>
			</form>';
            break;

        default: 

            echo '<b>You didn\'t select an item from above!</b>';


            break;     

    }    

}

?>





