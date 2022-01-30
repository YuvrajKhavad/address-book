<?php
include('../../../include/db.php');

$districts = array("સુરેન્દ્રનગર","ભાવનગર", "બોટાદ", "રાજકોટ","અમરેલી", "જામનગર", "જુનાગઢ", "ગાંધીનગર","અમદાવાદ", "મોરબી", "પોરબંદર", "વડોદરા", "આણંદ", "અરવલ્લી", "બનાસકાંઠા", "ભરૂચ", "છોટા ઉદેપુર", "દાહોદ", "ડાંગ (આહવા)", "દેવભૂમિ દ્વારકા",  "ગીર સોમનાથ", "કચ્છ","ખેડા (નડિયાદ)", "મહીસાગર","મહેસાણા", "નર્મદા (રાજપીપળા)", "નવસારી", "પંચમહાલ (ગોધરા)","પાટણ", "સાબરકાંઠા(હિંમતનગર)", "સુરત","તાપી (વ્યારા)", "વલસાડ");

$district_data = array(
    "અમદાવાદ" => array("અમદાવાદ સીટી", "બાવળા", "સાણંદ", "ધોલેરા", "ધંધુકા", "ધોળકા", "દસ્ક્રોઇ", "દેત્રોજ-રામપુરા", "માંડલ", "વિરમગામ"),
    "અમરેલી" => array("અમરેલી", "બગસરા", "બાબરા", "જાફરાબાદ", "રાજુલા", "ખાંભા", "ધારી", "લાઠી", "સાવરકુંડલા", "લીલીયા", "કુકાવાવ"),
    "આણંદ" => array("આણંદ", "ખંભાત", "બોરસદ", "પેટલાદ", "તારાપુર", "સોજિત્રા", "આંકલાવ", "ઉમરેઠ"),
    "અરવલ્લી" => array("મોડાસા", "ભિલોડા", "ધનસુરા", "બાયડ", "મેઘરજ", "માલપુરા"),
    "બનાસકાંઠા" => array("પાલનપુર", "થરાદ", "ધાનેરા", "વાવ", "દિયોદર", "ડીસા", "કાંકરેજ", "દાંતા", "દાંતીવાડા", "વડગામ", "લાખણી", "ભાભર", "સુઈગામ", "અમીરગઢ"),
    "ભરૂચ" => array("ભરૂચ", "અંકલેશ્વર", "આમોદ", "વાગરા", "હાંસોટ", "જંબુસર", "નેત્રંગ", "વાલીયા", "જગડિયા"),
    "ભાવનગર" => array("ભાવનગર", "ઘોઘા", "મહૂવા", "ગારીયાધાર", "ઉમરાળા", "જેસર", "પાલીતાણા", "શિહોર", "તળાજા", "વલભીપુર"),
    "બોટાદ" => array("બોટાદ", "ગઢડા", "બરવાળા", "રાણપુર"),
    "છોટા ઉદેપુર" => array("છોટાઉદેપુર", "સંખેડા", "જેતપુર-પાવી", "કવાટ", "બોડેલી", "નસવાડી"),
    "દાહોદ" => array("દાહોદ", "ઝાલોદ", "ધાનપુર", "સિંગવડ", "ફતેપુરા", "ગરબાડા", "દેવગઢ બારીયા", "લીમખેડા", "સંજેલી"),
    "ડાંગ (આહવા)" => array("આહવા", "વધાઈ", "સુબીર"),
    "દેવભૂમિ દ્વારકા" => array("દ્વારકા", "કલ્યાણપુર", "ભાણવડ", "ખંભાળિયા"),
    "ગાંધીનગર" => array("ગાંધીનગર", "કલોલ", "દહેગામ", "માણસા"),
    "ગીર સોમનાથ" => array("વેરાવળ", "કોડીનાર", "ઉના", "સુત્રાપાડા", "ગીર ગઢડા", "તાલાલા"),
    "જામનગર" => array("જામનગર", "જામજોધપુર", "જોડીયા", "લાલપુર", "ધ્રોળ", "કાલાવડ"),
    "જુનાગઢ" => array("જૂનાગઢ શહેર", "જુનાગઢ ગ્રામ્ય", "ભેસાણ", "કેશોદ", "માણાવદર", "મેંદરડા", "માળિયા-હાટીના", "માંગરોળ", "વિસાવદર", "વંથલી"),
    "કચ્છ" => array("ભુજ", "ભચાઉ", "અંજાર", "અબડાસા(નલિયા)", "માંડવી", "મુંદ્રા", "રાપર", "ગાંધીધામ", "લખપત", "નખત્રાણા"),
    "ખેડા (નડિયાદ)" => array("ખેડા", "નડિયાદ", "કઠલાલ", "મહેમદાવાદ", "કપડવંજ", "ઠાસરા", "મહુધા", "ગલતેશ્વર", "માતર", "વસો"),
    "મહીસાગર" => array("લુણાવડા", "કડાણા", "ખાનપુર", "બાલાસિનોર", "વીરપુર", "સંતરામપુર"),
    "મહેસાણા" => array("મહેસાણા", "કડી", "ખેરાલુ", "બેચરાજી", "વડનગર", "વિસનગર", "વિજાપુર", "ઊંઝા", "જોટાણા", "સતલાસણા", "ગોજારીયા"),
    "મોરબી" => array("મોરબી", "માળીયા મીયાણા", "હળવદ", "વાંકાનેર", "ટંકારા"),
    "નર્મદા (રાજપીપળા)" => array("નાંદોદ", "સાગબારા", "ડેડીયાપાડા", "ગરુડેશ્વર", "તિલકવાડા"),
    "નવસારી" => array("નવસારી", "ગણદેવી", "ચીખલી", "વાસંદા", "જલાલપોર", "ખેરગામ"),
    "પંચમહાલ (ગોધરા)" => array("ગોધરા", "હાલોલ", "કાલોલ", "ઘોઘંબા", "જાંબુઘોડા", "શહેરા", "મોરવા-હડફ"),
    "પાટણ" => array("પાટણ", "રાધનપુર", "સિદ્ધપુર,ચાણસ્મા", "સાંતલપુર", "હારીજ", "સમી", "સરસ્વતી", "શંખેશ્વર"),
    "પોરબંદર" => array("પોરબંદર", "રાણાવાવ", "કુતિયાણા"),
    "રાજકોટ" => array("રાજકોટ", "ગોંડલ", "ધોરાજી", "જામકંડોરણા", "જેતપુર", "જસદણ", "કોટડાસાંગાણી", "પડધરી", "ઉપલેટા", "લોધિકા", "વિછીયા"),
    "સાબરકાંઠા(હિંમતનગર)" => array("હિંમતનગર", "ખેડબ્રહ્મા", "પ્રાંતિજ", "ઇડર", "તલોદ", "પોશીના", "વિજયનગર", "વડાલી"),
    "સુરત" => array("સુરત સીટી", "કામરેજ", "બારડોલી", "માંગરોળ", "મહુવા", "ઓલપાડ", "માંડવી", "ચોર્યાસી", "પલસાણા", "ઉમરપાડા"),
    "સુરેન્દ્રનગર" => array("સાયલા", "ચોટીલા", "થાનગઢ", "લીંબડી", "ચુડા", "વઢવાણ", "પાટડી", "દસાડા", "લખતર", "ધ્રાંગધ્રા" ),
    "તાપી (વ્યારા)" => array("વ્યારા", "ડોલવણ", "કુકરમુંડા", "સોનગઢ", "નિઝર", "વાલોડ", "ઉચ્છલ"),
    "વડોદરા" => array("વડોદરા", "કરજણ", "પાદરા", "ડભોઇ", "સાવલી", "શિનોર", "ડેસર", "વાઘોડીયા"),
    "વલસાડ" => array("વલસાડ", "કપરાડા", "પારડી", "વાપી", "ધરમપુર", "ઉંમરગામ"),
);

$district = trim($_POST['search-district']);
$taluka = trim($_POST['search-talukas']);

$query = "SELECT * FROM `location`";

if(!empty($district))
{
    $query .= " WHERE `District_Name` = '".$district."'";
}

if(!empty($taluka))
{
    $query .= " AND  `Taluka_Name` = '".$taluka."'";
}

$res = mysqli_query($con, $query);
$count = 1;
$tr = "";
while($row = mysqli_fetch_array($res))
{
    $district_name = $row['District_Name'];
    $taluka_name = $row['Taluka_Name'];
    $village_id = $row['ID'];

    if($district_name)
    {
            $talukas = $district_data[$district_name];

        //print_r($talukas);

        $talukas_list = '<select name="edit-taluka" class="talukas">';
        $talukas_list .= '<option value="">તાલુકો પસંદ કરો </option>';
        foreach($talukas as $taluka)
        {
            $selected_taluka = ($taluka == $taluka_name)?' selected':'';
            $talukas_list .= '<option value="'.$taluka.'"'.$selected_taluka.'>'.$taluka.'</option>';
        }
        $talukas_list .= '</select>';
        //echo $talukas_list;
    }
    $tr .= '<tr id="village-'.$village_id.'">
                <td>'.$count.'</td>
                <td><input type="text" name="edit-village-name" class="form-control" value="'.$row["Village_Name"].'"/></td>
                <td>';
                    $tr .= '<select id="data-'.$count.'" name="edit-district" class="districts">';
                    $tr .= '<option value="">જિલ્લો પસંદ કરો </option>';
                    foreach($districts as $district)
                    {
                        $selected = ($district == $district_name)?' selected':'';
                        $tr .= '<option value="'.$district.'" '.$selected.'>'.$district.'</option>';
                    }
                    $tr .= '</select>
                </td>';
                $tr .= '<td class = "taluka-list">'.$talukas_list.'</td>';
                $tr .= '<td><button class="btn btn-success update-village" id="'.$village_id.'">Update</button></td>
            </tr>';
    $count++;
    $talukas_list = "";
    //$sum += (int)$row['Amount'];

}
echo $tr;