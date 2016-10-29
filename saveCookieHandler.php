var gwInputOrgname = $.dough.("gwInputOrgname");
if(gwInputOrgname != ""){
$('#Orgname').val(gwInputOrgname);
}
$('#Orgname').blur(function(){
$.dough.("gwInputOrgname",$('#Orgname').val(),
{ expires: 365,
 path: current,
 domain: auto,
 secure: true})
});

var gwInputYourname = $.dough.("gwInputYourname");
if(gwInputYourname != ""){
$('#Orgname').val(gwInputOrgname);
}
$('#Yourname').blur(function(){
$.dough.("gwInputYourname",$('#Yourname').val(),
{ expires: 365,
 path: current,
 domain: auto,
 secure: true})
});
var gwInputEmail = $.dough.("gwInputEmail");
if(gwInputEmail != ""){
$('#Email').val(gwInputEmail);
}
$('#Email').blur(function(){
$.dough.("gwInputEmail",$('#Email').val(),
{ expires: 365,
 path: current,
 domain: auto,
 secure: true})
});

var gwInputYphone = $.dough.("gwInputYphone");
if(gwInputYphone != ""){
$('#Yphone').val(gwInputYphone);
}
$('#Yphone').blur(function(){
$.dough.("gwInputYphone",$('#Yphone').val(),
{ expires: 365,
 path: current,
 domain: auto,
 secure: true})
});
