<?php
mb_internal_encoding('UTF-8');
//Slagame print_r ( za da vijdame kakva info. shte se izprashtat obratno sled populvane na formata
//print_r($_POST);//Array ( ) - v momenta tui kato ne sme populnili nishto na nashta foma ,zatova e prazni
//no shtom pulnim neshto, Array sushto se populva :
//Array [username] => Huen [phone] => 2424 [group] => Приятели 
//no nashiqt masiv ne se vijda mn dobre , zatova shte go slojim po tozi nachin 
echo '<pre>'.print_r($_POST, true).'</pre>';
/*Array
(
    [username] => Huen
    [phone] => 2424
    [group] => Приятели
)
 */
$pageTitle='Форма за попълване';
//Proverka dali dannite sa zapisani pravilno , spored validaciqta i norma.
include '/includes/header.php';
//s include - oitvame v header.php, zimame koda i go postavim na mqstoto kudeto sme slojili include (copy, paste)

//Neka da napravim edin masiv i da slagame grupata tuka
//$groups=array(1=>'Приятели',2=>'Бивши',3=>'Бъдеши',4=>'Колеги',5=>'Семейство');//1,2,3 = key otdolu pri foreach - tova 
//go ima i v index.php- dublirane na koda - shte go zimame da go slagame nqkude kudeto vs failove imat odstup do nego
//mojem da go slagame v nov fail i da polzvame require, t.e ako ne namira faila - shte iztreshti celiqt php - nqma da trugne nishto
require 'includes/constants.php';//$groups=array(1=>'Приятели',2=>'Бивши',3=>'Бъдеши',4=>'Колеги',5=>'Семейство');
  //Sled kato zimame sutvetnata info ot forma tag bilo chrez razlichite zqvki- purvo trqbva da napravim NORMALIZACIQ ,
                           // i vtoroto e : VALIDACIQ , nikoga da ne vqrvame vhodqstata infot.
         // Normalizaciqta : t.e da prevedem info., taka che nashiqt kod da razbira kakvo sa vuveli horata ili klientite 
         // Validaciq ; dali tezi danni , koito poluchavame dali sa validni za nashta sistema: 
//Purvo  shte napravime za pole : username , tui kato e string - nai chesto e intervali , koito slagame vutre pri vuvejdane:    huen 
//zatova shte gi mahame .
 
//1.NORMALIZACIQ-purvo username go ochakvame da e string, i normalizaciqta e da mmhame intervalite
//Spored razlichni ezici- naprimer imame Grupa - semeistvo e bg, no e Family na ang,
//zatova e po dobre da napravim edin id = stoinost, i da promenim stoinosta spored suovtniq ezik  naprimer za grupata - shte napravim slednoto

if($_POST){ // ako imame Post zaqvka 
    
$username=trim($_POST['username']); //s trim mahame intervalite \n  v string-a
$username=str_replace('!', '', $username);//tova vliza v normalizaciq, zamestvame simvola ! - s '' , v string username
$phone=trim($_POST['phone']); 
$phone=str_replace('!', '', $phone);//tova vliza v normalizaciq, zamestvame simvola ! - s '' , v string username
$selectedGroup=(int)$_POST['group']; // t.e castvame samite kluchove da sa int, a ne naprimer string ili neshto durgo, v momenta kluchovete sa ni chisla 
$errors=false;
/*Array
(
    [username] => gr
    [phone] => rge
    [group] => 2 // tuka veche zima KLUCHA , a ne stoinosta , zatova mojem da napravim gornoto castvane, zimaneto na klucha 2 se izvurshva v foreach dolu
)
 * 
 */

//2. VALIDACIQ -
//Proverqvane na duljinata na string - se naricha strlen -Returns the length of the given string. - NE E BINARY SAFE 
//echo mb_strlen($username,'UTF-8'); //vrushta duljinata na string, koito sme vuveli na tova pole , no samo go  simvolite sa na ang.
//ako e na bulgarski ili drug ezik vrushta druga duljina , tova se naricha ENCODING- zatova NE E BINARY SAFE .. zatova shte izpolzvame edna funk.
//mb_strlen:  echo mb_strlen($username,'UTF-8')-i veche shte vrushta pravilnata duljina
//no ne vsqka funkciq ima mb, zatova shte slagame mb_internal_encoding('UTF-8'); i vsqko neshto kato izvikvame tazi funkciq

//Proverqne na stringa, dali e < 4
if (mb_strlen($username) < 4) {
    echo '<p>Името е прекалено късо</p>';
    $errors= true;
}
//Proverka za telefona - za duljina i da sudurja samo chisla(regularni izrazi)
if (mb_strlen($phone) < 6 || mb_strlen($phone) > 12) {
    echo '<p>Телефона е с грешна дължина</p>';
        $errors= true;

}

//Дали това selected group susteshtuva vutre v nashta grupa
if (!array_key_exists($selectedGroup,$groups)){ //tova vrushta true ili false, spored tova dali  klucha exist or not // t.e dali groups sudurja tova id = selectedgroup v sebe si, Da ili ne 
    echo '<p>Невалидна група</p>';//false , zatova slagame ! , zashtot ne iskame klucha da exist, i da dava echo s nevalidna grupa

    $errors= true;
    
}

//Sled kato sme preminali vs ot validaciq i normalizaciq , togava shte gi zapisvame dannite v failovete 
//predi da zapisvame trqbva da izmislim strukturata - kak shte bude informaciqta v faila :

if (!$errors) { // ako nqmame errors - togava shte zapisvame v faila data.txt
    $result=$username.'!'. $phone. '!'. $selectedGroup."\n";//new line-polzvai Notepad za da otvorish faila 
    if(file_put_contents('data.txt', $result, FILE_APPEND)) // така при всяко въвеждане на данни от потребителя. данните отиват в този fail,
            //no kude otiva starite danni, pri vsqko vuvejdane ? - nachi tazi funkciq  file_put_contents('data.txt', $result)- tui kato ako go napishem samo s tezi dva parametura
            //shte prezapisva starata info, no ako dobavim flaga-  FILE_APPEND - togava shte dobavq novite danni kum starite do momenta
            //no dannite sa zalepeni po tozi nachin , iskame da sa na otdelen red
    {
        echo 'Записа е успешен!';
        
    }
        
  //Kakvo  shte stane ako klienta vuvejda simvola ! v string-a , shte napravim slednotot - shte izpolzvame str_replace();- gore sum go napisala 
}

//sled kato  preminahme uspeshno vsichko ; togava iskame dannite ot tozi fail , da gi chetem i da gi zapisvame v spisuka s kontaktire ni : 
//otivame v index.php za da go napravim 
}

?>
        <a href="index.php">Списък</a> 
        <!-- -->
        <form method="POST"> <!-- <form method="GET"> -
        info. se predava ot tuka i nikude drugade http://localhost/addressbook/form.php?username=2&phone=242&group=%D0%91%D1%8A%D0%B4%D0%B5%D1%88%D0%B8 
        Sled kato zimame sutvetnata info ot forma tag bilo chrez razlichite zqvki- purvo trqbva da napravim NORMALIZACIQ ,
                            i vtoroto e : VALIDACIQ , nikoga da ne vqrvame vhodqstata infot.
          Normalizaciqta : t.e da prevedem info., taka che nashiqt kod da razbira kakvo sa vuveli horata ili klientite 
          Validaciq ; dali tezi danni , koito poluchavame dali sa validni za nashta sistema
                            

        -->
        
        <div>Име: <input type="text" name="username" /></div>
        <div>Телефон: <input type="text" name="phone" /></div>
        <div>Група:
           <select name="group">
               
               
               <!-- <option>
                    Приятели
                </option>
                <option>
                    Бивши
                </option>
                <option>
                    Колеги
                </option>
               или ще го правим с един масив + foreach  -->
                <?php
                foreach ($groups as $key=>$value) {
                    echo '<option value="'.$key.'">'.$value.'</option>'; 
                }
                ?>
            </select               
            <!-- Ot HTML - kogato iskame da prashtam nqkakva info, chrez natiskane na butona Submit, nie trqbva da gi slagame v form tag. -->
        </div>
        <div><input type="submit" value="Submit" /></div>
</form>
           
 <?php
include '/includes/footer.php';
?>