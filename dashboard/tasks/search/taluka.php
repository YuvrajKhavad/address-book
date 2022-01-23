<?php
include('../../../include/db.php');
$district = $_POST["district"];

$districts = array("અમદાવાદ", "અમરેલી", "આણંદ", "અરવલ્લી", "બનાસકાંઠા", "ભરૂચ", "ભાવનગર", "બોટાદ", "છોટા ઉદેપુર", " દાહોદ", "ડાંગ (આહવા)", "દેવભૂમિ દ્વારકા", "ગાંધીનગર", "ગીર સોમનાથ","જામનગર","જુનાગઢ","કચ્છ","ખેડા (નડિયાદ)","મહીસાગર","મહેસાણા"," મોરબી"," નર્મદા (રાજપીપળા)","નવસારી","પંચમહાલ (ગોધરા)","પાટણ","પોરબંદર","રાજકોટ","સાબરકાંઠા(હિંમતનગર)","સુરત","સુરેન્દ્રનગર","તાપી (વ્યારા)","વડોદરા", "વલસાડ");

$district_data = array(
	"અમદાવાદ" => array("અમદાવાદ સીટી", "બાવળા", "સાણંદ", "ધોલેરા", "ધંધુકા", "ધોળકા", "દસ્ક્રોઇ", "દેત્રોજ-રામપુરા", "માંડલ", "વિરમગામ"),
	"અમરેલી" => array("અમરેલી", "બગસરા", "બાબરા", "જાફરાબાદ", "રાજુલા", "ખાંભા", "ધારી", "લાઠી", "સાવરકુંડલા", "લીલીયા", "કુકાવાવ"),
	"આણંદ" => array("આણંદ", "ખંભાત", "બોરસદ", "પેટલાદ", "તારાપુર", "સોજિત્રા", "આંકલાવ", "ઉમરેઠ"),
	"અરવલ્લી" => array("મોડાસા", "ભિલોડા", "ધનસુરા", "બાયડ", "મેઘરજ", "માલપુરા"),
);

$talukas = $district_data[$district];
//print_r($talukas);

$talukas_list = '<select name="taluka" class="talukas">';
foreach($talukas as $taluka)
{
	$talukas_list .= '<option value="'.$taluka.'">'.$taluka.'</option>';
}
$talukas_list .= '</select>';
echo $talukas_list;
?>