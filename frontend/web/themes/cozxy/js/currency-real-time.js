/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//http://www.apilayer.net/api/live?access_key=9a7b73d4d6270d6b5dc46fb65ea2f294&format=1
//http://www.apilayer.net/api/live?access_key=9a7b73d4d6270d6b5dc46fb65ea2f294
//https://currencylayer.com/documentation
// set endpoint and your access key
endpoint = 'live'
access_key = '15781139523abe280c2b49ffee4d643d';//'9a7b73d4d6270d6b5dc46fb65ea2f294';

// get the most recent exchange rates via the "live" endpoint:
$.ajax({
    url: 'http://apilayer.net/api/' + endpoint + '?access_key=' + access_key,
    dataType: 'jsonp',
    success: function (json) {
        console.log(json.quotes);
        // exchange rata data is stored in json.quotes
        //alert(json.quotes.USDGBP);
        $('#currencylayer').val();
        // source currency is stored in json.source
        //alert(json.source);

        // timestamp can be accessed in json.timestamp
        //alert(json.timestamp);

    }
});