// JavaScript Document
function nl2br(str, is_xhtml) {
  //  discuss at: http://phpjs.org/functions/nl2br/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Philip Peterson
  // improved by: Onno Marsman
  // improved by: Atli Þór
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Maximusya
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Brett Zamir (http://brett-zamir.me)
  //   example 1: nl2br('Kevin\nvan\nZonneveld');
  //   returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
  //   example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
  //   returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
  //   example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
  //   returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
console.log("At nl2br");
console.log("value of string " + str);
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display
  
console.log("value of breaktag " + breakTag);
  
   var res=str.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
   console.log("value of res after replace " + res);
	return (res + '');
}
