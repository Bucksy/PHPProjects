<?php
$pageTitle='Списък';
include '/includes/header.php';//tuka izpolzvame otnositelen(relativen) put 
////no ako slagame header. php i footer.php v edna otdelna papka, i papkata se namira na sushtto mqsto kudeto e index.php , neka da q krustim papkata
//includes , togava gorniqt put shte bude './includes/header.php', t.e v sushata direktoriq , a s dve tochki - tova e gornata direktoriq
//s include - oitvame v header.php, zimame koda i go postavim na mqstoto kudeto sme slojili include (copy, paste)
//ulesnqva ni rabotata , kato promenim na edno mqsto i se otrazqva na vs
/*include_once '';//vkaravai faila samo edin put, po baven ot include.
require '';//zaduljitelno trea da go vkluchvash faila
require_once '';
 * 
 *Formata, za populvane , vs tiq neshta koito se vijdat v momenta v browsera, se vijda ot klientite
 * sled kato choveka si populva suotvetnata forma, dannite se izprashtat obratno kum php koda ,za da se obratvotvat spored koda na php
 * i tova stava chrez HTTP protokola- ima dva metodaa GET i POST- dva nachina za predavane na informaciq
 * GET- protokola - zimane na informaciq , kogato se opitvame da otvorim nqkoq web-str. primerno , ideqta na Get - e che browsera prashta zaqvka kum dadeniq servera i
 * servera vrushta informaciqta(sudurjanieto na str.)
 * POST- osven che prashta info. na servera + dopulnitelna infor. s tova kakvo da pravi s neq 
 * s get, prosto iskame da zimame info i da q gledame , dokato s post- nie populvame formi it.n promenqme neshto v formite, i togava browsera q izprashta obratno
 * 
 * 
 */

//$groups=array(1=>'Приятели',2=>'Бивши',3=>'Бъдеши',4=>'Колеги',5=>'Семейство');//shte napravim taka che na grupite ni da se pokzvat stoinsota a ne klucha 
//1,2,3 = key otdolu pri foreach - tova 
//go ima i v form.php- dublirane na koda - shte go zimame da go slagame nqkude kudeto vs failove imat odstup do nego
// //mojem da go slagame v nov fail i da polzvame require, t.e ako ne namira faila - shte iztreshti celiqt php - nqma da trugne nishto

require '/includes/contants.php';//$groups=array(1=>'Приятели',2=>'Бивши',3=>'Бъдеши',4=>'Колеги',5=>'Семейство');
?>
       <a href="form.php">Добави нов контакт</a> 
        <table border="1">
            <tr>
                <td>
                    Име
                </td>
                 <td>
                    Телефон
                </td>
                 <td>
                    Група
                </td>
            </tr>
            <?php 
            //sled kato  preminahme uspeshno vsichko ; togava iskame dannite ot tozi fail , da gi chetem i da gi zapisvame v spisuka s kontaktire ni : 
 
            //1.Trqbva da prochetem faila data.txt
            //predi da trugnem da go prochetem,
            // trqbva da proverim 3 neshta - dali  faila exists, dali ima prava za dostupa
            if (file_exists('data.txt')) {
                //da go prochetem kato string i da  go slagame 
               //v string 
                //$result=  file_get_contents('data.txt'); //Reads entire file into a string
                //echo $result;// Huen!1243243!1 Ivan!131241243!1 Bucskie !4324323!2 
               //no tova e samo string, na nas ni trqbva da sa v tablisata 
                //neka da zemem vseki element na nov red da go  slagame v masiv ,za da mojem da go iterirame t.e 
                //da minem element po element - ima gotova funciq za neq - file- za vseki nov red, po nego razdelq elementa ni 
                $result=  file('data.txt'); //Reads entire file into an array 
                echo '<pre>'.print_r($result, true).'</pre>';//array
                /*Array
                (
                    [0] => Huen!1243243!1

                    [1] => Ivan!131241243!1

                    [2] => Bucskie !4324323!2

                )
                 */
              
                foreach ($result as $value){
                    //trqbva da zimame gornite danni da gi  razdelim na otdelni 3 neshta i - tova se naricha explode -Split a string by string
                    $columns= explode('!',$value); // razdeli string-a value ot tozi znak
                    echo '<pre>'.print_r(
                        $columns, true).'</pre>'; // veche go razdelq po sledniqt nachin: 
                    /*Array
                                (
                                    [0] => Huen
                                    [1] => 1243243
                                    [2] => 1

                                )

                                Array
                                (
                                    [0] => Ivan
                                    [1] => 131241243
                                    [2] => 1

                                )

                                Array
                                (
                                    [0] => Bucskie 
                                    [1] => 4324323
                                    [2] => 2

                                )

                                                     */

                    //groups[0,1,2.3] - tazi promenliva[2\n] - osven 0,12,3 sudurja i simvol za nov v red , i v momenta s groups[columns[2]] - se opitvame da zimame 
                    //simvola ["2\n]- koito ne sustestvuva v nashiqt masiv - zatova shte izpolzvame trim() za da premahvame nov red
                    echo '<tr>
                           <td>'.$columns[0].'</td> 
                           <td>'.$columns[1].'</td> 
                           <td>'.$groups[trim($columns[2])].'</td>
                        </tr>';
              
                }
                
                //v momenta grupata ni sa chisla - trea da sa family, bishvi.t.n
                //nka da zimame groups array
            }
            
         /*
            $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
            $pieces = explode(" ", $pizza);
            echo $pieces[0]; // piece1
            echo $pieces[1]; // piece2 
            * 
            */
              ?>
        </table>
<?php
include '/includes/footer.php';
?>