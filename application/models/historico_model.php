<?php

class Historico_model extends CI_Model {
	function historico($data, $ubicacion){
		if($data) {
			$xml = simplexml_load_string($data);
			$estaciones='';
			$estaciones.='<div id="gralBox" class="estTable historico">';
			$estaciones.='<div><h2 class="tdu dib">'.$ubicacion.'</h2></div>';
			$estaciones.='<section data="historico"><ul id="filters">
    <li>
        <input type="checkbox" checked="yes" value="categorya" />
        <label >FECHA</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryb" />
        <label >TEMP. MAX. (°c)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryc" />
        <label >TEMP. MÍN. (°c)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryd" />
        <label >PREC. ACUM. (mm)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categorye" />
        <label >INT. MÁX. (mm/h)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryf" />
        <label >PREC. ANUAL (mm)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryg" />
        <label >HUM. REL. MÁX. (%)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryh" />
        <label >HUM. REL. MÍN. (%)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryi" />
        <label >RAD. SOLAR MÁX. (W/m<sup>2</sup>)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryj" />
        <label >PRES. BAR. MÁX. (hPa)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryk" />
        <label >PRES. BAR. MÍN. (hPa)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categoryl" />
        <label >VEL VIENTO MÁX (m/s)</label>
    </li>
     <li>
        <input type="checkbox" checked="yes" value="categorym" />
        <label >VEL VIENTO MÍN (m/s)</label>
    </li>

   </ul></section>';

			$estaciones.='<table class="tb1 detach-container"><thead><tr class="tti detach">';	
			$estaciones.='<th class="categorya">FECHA</th>';
			$estaciones.='<th class="categoryb">TEMP. MAX. (°c)</th>';
			$estaciones.='<th class="categoryc">TEMP. MÍN. (°c)</th>';
			$estaciones.='<th class="categoryd">PREC. ACUM. (mm)</th>';
			$estaciones.='<th class="categorye"">INT. MÁX. (mm/h)</th>';
			$estaciones.='<th class="categoryf">PREC. ANUAL (mm)</th>';
			$estaciones.='<th class="categoryg">HUM. REL. MÁX. (%)</th>';
			$estaciones.='<th class="categoryh">HUM. REL. MÍN. (%)</th>';
			$estaciones.='<th class="categoryi">RAD. SOLAR MÁX. (W/m<sup>2</sup>)</th>';
			$estaciones.='<th class="categoryj">PRES. BAR. MÁX. (hPa)</th>';
			$estaciones.='<th class="categoryk">PRES. BAR. MÍN. (hPa)</th>';
			$estaciones.='<th class="categoryl">VEL VIENTO MÁX (m/s)</th>';
			$estaciones.='<th class="categorym">VEL VIENTO MÍN (m/s)</th>';
			$estaciones.='</tr></thead><tbody><tr><td colspan="13"></td></tr>';
			foreach ($xml as $est) {
				$var=$est->fecha;
				$estaciones .='<tr>';
					$estaciones .='<td class="categorya">'.$est->fecha.'</td>';
					$estaciones .='<td class="categoryb">'.sprintf("%01.2f",$est->temperaturamaxima).'</td>';
					$estaciones .='<td class="categoryc">'.sprintf("%01.2f",$est->temperaturaminima).'</td>';
					$estaciones .='<td class="categoryd">'.$est->precipitacionacumulada.'</td>';
					$estaciones .='<td class="categorye">'.$est->intensidadmaxima.'</td>';
					$estaciones .='<td class="categoryf">'.$est->precipitacionanual.'</td>';
					$estaciones .='<td class="categoryg">'.sprintf("%01.2f",$est->humedadrelativamaxima).'</td>';
					$estaciones .='<td class="categoryh">'.sprintf("%01.2f",$est->humedadrelativaminima).'</td>';
					$estaciones .='<td class="categoryi">'.sprintf("%01.2f",$est->radiacionsolarmaxima).'</td>';
					$estaciones .='<td class="categoryj">'.sprintf("%01.2f",$est->presionbarometricamaxima).'</td>';
					$estaciones .='<td class="categoryk">'.sprintf("%01.2f",$est->presionbarometricaminima).'</td>';
					$estaciones .='<td class="categoryl">'.sprintf("%01.2f",$est->velocidadvientomaxima).'</td>';
					$estaciones .='<td class="categorym">'.sprintf("%01.2f",$est->velocidadvientominima).'</td>';
				$estaciones .='</tr>';
			}
			$estaciones .='<tr><td colspan="13"></td></tr></tbody></table></div>';
			
		}
		return $estaciones;
	}
	function consulta_hitorica($ubicacion, $periodo, $fechainicial, $fechafinal){
       $url='http://intranet.sapal.gob.mx:2948/Estaciones/wshistorico2v.asp?ubicacion='.$ubicacion.'&periodo='.$periodo.'&fechainicial='.$fechainicial.'&fechafinal='.$fechafinal;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch); // execute curl request
        curl_close($ch);
        if($data) {
            $xml = simplexml_load_string($data);
            foreach ($xml as $row) {
                $data_array[] = array($row->fecha,sprintf("%01.2f",$row->temperaturamaxima),sprintf("%01.2f",$row->temperaturaminima),$row->precipitacionacumulada,$row->intensidadmaxima,$row->precipitacionanual,sprintf("%01.2f",$row->humedadrelativamaxima),sprintf("%01.2f",$row->humedadrelativaminima),sprintf("%01.2f",$row->radiacionsolarmaxima),sprintf("%01.2f",$row->presionbarometricamaxima),sprintf("%01.2f",$row->presionbarometricaminima),sprintf("%01.2f",$row->velocidadvientomaxima),sprintf("%01.2f",$row->velocidadvientominima));

                }
            }
        return $data_array;
        
    }
}