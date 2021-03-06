<?php
include('../../../include/db.php');
$district = $_POST["district"];
$type = $_POST['type'];
if($type == 'search')
{
	$talukas_list = '<select name="search-talukas" class="search-talukas">';
	$talukas_list .= '<option value="">તાલુકો પસંદ કરો </option>';
	$res = mysqli_query($con, "SELECT DISTINCT `Taluka_Name` FROM `location` WHERE `District_Name` = '".$district."'");
	while($row = mysqli_fetch_array($res))
	{
		$talukas_list .= '<option value="'.$row['Taluka_Name'].'">'.$row['Taluka_Name'].'</option>';
	}
	$talukas_list .= '</select>';
}
else
{
	$districts = array("અમદાવાદ", "અમરેલી", "આણંદ", "અરવલ્લી", "બનાસકાંઠા", "ભરૂચ", "ભાવનગર", "બોટાદ", "છોટા ઉદેપુર", "દાહોદ", "ડાંગ (આહવા)", "દેવભૂમિ દ્વારકા", "ગાંધીનગર", "ગીર સોમનાથ","જામનગર","જુનાગઢ","કચ્છ","ખેડા (નડિયાદ)","મહીસાગર","મહેસાણા","મોરબી","નર્મદા (રાજપીપળા)","નવસારી","પંચમહાલ (ગોધરા)","પાટણ","પોરબંદર","રાજકોટ","સાબરકાંઠા(હિંમતનગર)","સુરત","સુરેન્દ્રનગર","તાપી (વ્યારા)","વડોદરા", "વલસાડ");

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

	$talukas = $district_data[$district];

	$talukas_list = '<select name="edit-taluka" class="talukas">';
	$talukas_list .= '<option value="">તાલુકો પસંદ કરો </option>';
	foreach($talukas as $taluka)
	{
		$talukas_list .= '<option value="'.$taluka.'">'.$taluka.'</option>';
	}
	$talukas_list .= '</select>';
}
echo $talukas_list;
?>