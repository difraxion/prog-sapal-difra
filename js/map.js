$(function() {
  var bandera = 0;
  var baseurl = $('#hdn_baseurl').val();
  var myLatlng = new google.maps.LatLng(21.116080, -101.680811);
  var mapOptions = {
    zoom: 13,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false
  }
  var map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
  $.post(baseurl + 'webservices/map_estaciones', function(data) {
    var dato = JSON.parse(data);
    $.each(dato, function(i, datos) {
      convert(datos);
      //convert(datos.Latitud,datos.Longitud,datos.AlarmaConexion1,datos.Nombre,datos.TemperaturaActual1);
    });
   $('#bajarconsulta').click(function(){
   		if (validar(this)){
	   		 window.location.href=baseurl+'webservices/map_estaciones_bajar?ubicacion='+$("#ubi").val()+'&periodo='+$("#per").val()+'&finicio='+$("#dateinicio").val()+'&ffinal='+$("#datefin").val()+'';
   		}
	  
   })
  });

  function convert(datos) {
    var nombres;
    var activo = datos.AlarmaConexion1;
    switch (datos.Nombre) {
      case 'Amalias':
        var nombres = " Sur - Poniente";
        break;
      case 'Colombia':
        var nombres = " Centro";
        break;
      case "Presa 'El Palote'":
        var nombres = " Norte";
        break;
      case 'Jerez':
        var nombres = " Sur - Oriente";
        break;
      case 'Maravillas':
        var nombres = " Nor - Oriente";
        break;
      case 'Piedrero':
        var nombres = " Poniente";
        break;
      case 'Planta de Bombeo':
        var nombres = " Sur";
        break;
      case 'Rebombeo Santa Rosa':
        var nombres = " Sur - Poniente";
        break;
      case 'Villas de San Juan':
        var nombres = " Oriente";
        break;
    }
    
    if (activo == '0') {
      var point = new google.maps.LatLng(datos.LatitudDecimal, datos.LongitudDecimal);
      var marker = new RichMarker({
        position: point,
        map: map,
        flat: true,
        content: '<div class="marker"><span>' + datos.Nombre + '&nbsp;&nbsp;&nbsp;<label class="minuscula">'+ datos.TemperaturaActual1 +'°c</label></span><span class="minuscula">' + datos.TemperaturaActual1 + '°c</span></div>'
      });


      google.maps.event.addListener(marker, 'click', function() {
        var body = $("html, body");
        var infowindow = new google.maps.InfoWindow();
        var datosGen = '',
          viento = '',
          temperaturaG = '',
          precipitacion = '',
          informacion = '',
          line = '';
        body.animate({
          scrollTop: 1400
        }, '500', 'swing', function() {

        });
        datosGen = 'longitud' + '</br>' + datos.Longitud + '</br>' + 'latitud' + '</br>' + datos.Latitud + '</br>' + 'altitud' + '</br><span class="minuscula">' + datos.Altitud + '</span>';
        viento = rangos(datos.DireccionViento1) + '&nbsp;' + datos.DireccionViento1 + ' <span data="unidades">°</span>' + '<br />' + 'velocidad del viento' + '</br>' + datos.VelocidadVientoMaximaDelDia1 + ' <span data="unidades">m/s</span>';
        temperaturaG = '<p>' + 'mínima del día' + '</br>' + datos.TemperaturaMinimaDelDia1 + ' <span data="unidades">°c</span></p><p>' + 'actual' + '</br>' + datos.TemperaturaActual1 + '  <span data="unidades">°c</span></p><p>' + 'máxima del día' + '</br>' + datos.TemperaturaMaximaDelDia1 + '  <span data="unidades">°c</span></p>';
        precipitacion = '<p>' + 'Intensidad ' + '</br>' + datos.PrecipitacionIntensidad1 + ' <span data="unidades">mm/h</span></p><p>' + 'acumulación del día' + '</br>' + datos.PrecipitacionAcumuladaDelDia1 + ' <span data="unidades">mm</span></p><p>' + 'máxima anual' + '</br>' + datos.PrecipitacionMaximaAnual1 + '<span data="unidades">mm</span> -' + datos.FechaPrecipitacionMaximaAnual1 + ' </p><p>' + 'acumulación anual' + '</br>' + datos.PrecipitacionAcumuladaAnual1 + ' <span data="unidades">mm</span></p>';
        informacion = '<p>' + 'Radiación  solar' + '</br>' + datos.RadiacionSolar1 + ' W/<span data="unidades">m<sup>2</sup></span></p><p>' + 'humedad relativa' + '</br>' + datos.HumedadRelativa1 + ' %</p><p>' + 'presión barométrica' + '</br>' + datos.PresionBarometrica1 + ' <span data="unidades">h</span>P<span data="unidades">a</span></p>';
        line = 'Opera desde el ' + datos.FechaOperacion + ' <span class="verde">en línea</span>'
        $('.nombre>h1').text(datos.Nombre);
        $('.nombre>h2').html(line);
        $('.temperatura>h1').html(datos.TemperaturaActual1 + ' <span data="unidades">°c</span>');
        $('.anual>h1').html(datos.PrecipitacionAcumuladaAnual1 + '<span data="unidades_m">mm</span>');
        $('.lluvia>h1').html(datos.PrecipitacionAcumuladaDelDia1 + '<span data="unidades_m">mm/h</span>');
        $('.datos>p').html(datosGen);
        $('.viento>p').html(viento);
        $('.temperaturaG>span').html(temperaturaG);
        $('.precipitacion>span').html(precipitacion);
        $('.informacion>span').html(informacion);
        // marker.setVisible(!marker.getVisible());
        $('.content-map').show('fast');
        //   infowindow.open(map,marker);
        return function() {
          infowindow.setContent(datos.Nombre);
          infowindow.open(map, marker);
        }
      });


    }
  }
  $("#dateinicio").datepicker({
    maxDate: 0,
    dateFormat: "dd/mm/yy"
  });
  $("#datefin").datepicker({
    maxDate: 0,
    dateFormat: "dd/mm/yy",
    showAnim:"fadeIn"
  });
  $('#alert').fadeOut('fast');
});

function rangos(dir) {
  var d = parseFloat(dir);
  if((d > 337.5 && d <= 360) || (d >= 0 && d <= 22.5)) return 'Norte';
  if(d > 22.5 && d <= 67.5) return 'Noreste';
  if(d > 67.5 && d <= 112.5) return 'Este';
  if(d > 112.5 && d <= 157.5) return 'Sureste';
  if(d > 157.5 && d <= 202.5) return 'Sur';
  if(d > 202.5 && d <= 247.5) return 'Suroeste';
  if(d > 247.5 && d <= 292.5) return 'Oeste';
  if(d > 292.5 && d <= 337.5) return 'Noroeste';
}

function validar(formulario) {
   var ubicacion = $("#ubi").val(),
       periodo = $("#per").val(),
       dateI = $("#dateinicio").val(),
       dateF = $("#datefin").val(),
       alert= $('#alert');
    var fi = dateI.split("/");
    var ff = dateF.split("/");
    var finicio = new Date(fi[2],parseInt(fi[1])-1,fi[0]);
    var ffinal = new Date(ff[2],parseInt(ff[1])-1,ff[0]); 
    var gfi = finicio.getTime();
    var gff = ffinal.getTime();   

    if (ubicacion == "") {
      alert.text("Selecione ubicacion").show();
      return false;
    }else if(periodo==""){
      alert.text("Selecione periodo").show();
      return false;
    }else if(dateI=="" || validaFechaDDMMAAAA(dateI)==false){
      alert.text("Selecione Fecha de inicio valida").fadeIn('fast').delay(4000).fadeOut('fast');
      return false;
    }else if(dateF=="" || validaFechaDDMMAAAA(dateF)==false){
      alert.text("Selecione Fecha de fin valida").fadeIn('fast').delay(4000).fadeOut('fast');
      return false;
    }else if(gfi>gff){
   	  alert.text("La fecha final debe ser mayor a la fecha de inicio").fadeIn('fast').delay(3000).fadeOut('fast');
      return false;
    }else{
	  return true;
    }
}
function validaFechaDDMMAAAA(fecha){
  var dtCh= "/";
  var minYear=1900;
  var maxYear=2100;
  function isInteger(s){
    var i;
    for (i = 0; i < s.length; i++){
      var c = s.charAt(i);
      if (((c < "0") || (c > "9"))) return false;
    }
    return true;
  }
  function stripCharsInBag(s, bag){
    var i;
    var returnString = "";
    for (i = 0; i < s.length; i++){
      var c = s.charAt(i);
      if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
  }
  function daysInFebruary (year){
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
  }
  function DaysArray(n) {
    for (var i = 1; i <= n; i++) {
      this[i] = 31
      if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
      if (i==2) {this[i] = 29}
    }
    return this
  }
  function isDate(dtStr){
    var daysInMonth = DaysArray(12)
    var pos1=dtStr.indexOf(dtCh)
    var pos2=dtStr.indexOf(dtCh,pos1+1)
    var strDay=dtStr.substring(0,pos1)
    var strMonth=dtStr.substring(pos1+1,pos2)
    var strYear=dtStr.substring(pos2+1)
    strYr=strYear
    if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
    if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
    for (var i = 1; i <= 3; i++) {
      if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
    }
    month=parseInt(strMonth)
    day=parseInt(strDay)
    year=parseInt(strYr)
    if (pos1==-1 || pos2==-1){
      return false
    }
    if (strMonth.length<1 || month<1 || month>12){
      return false
    }
    if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
      return false
    }
    if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
      return false
    }
    if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
      return false
    }
    return true
  }
  if(isDate(fecha)){
    return true;
  }else{
    return false;
  }
}