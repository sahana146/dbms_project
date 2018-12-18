
function popup(){
   
window.alert("Thank you!! Your order has been placed and an email has been sent.\nCheck deliver option to know the people who will deliver the order.");
}


function openForm1() {
  document.getElementById("addform").style.display = "block";
  $('#parent').css({'opacity':0.3,'pointer_events':'none'});
  $('table').css({'opacity':0.3,'pointer_events':'none'});
  
}

function closeForm1() {
  document.getElementById("addform").style.display = "none";
   $('#parent').css({'opacity':1,'pointer_events':'auto'});
   $('table').css({'opacity':1,'pointer_events':'none'});
} 
function openForm2() {
  document.getElementById("editform").style.display = "block";
   $('#parent').css({'opacity':0.3,'pointer_events':'none'});
   $('table').css({'opacity':0.3,'pointer_events':'none'});
}

function closeForm2() {
  document.getElementById("editform").style.display = "none";
  $('#parent').css({'opacity':1,'pointer_events':'auto'});
  $('table').css({'opacity':1,'pointer_events':'none'});
} 

function f(){

var n=document.getElementById("in").value;
    if (n.length < 1)
    {
        window.alert("Item name field is blank or not valid");
        return false;
    }
var n=document.getElementById("ip").value;
    if (n.length < 1)
    {
        window.alert("Item price field is blank or not valid ");
        return false;
    }
var n=document.getElementById("iq").value;
    if (n.length < 1)
    {
        window.alert("Item quantity field is blank or not valid");
        return false;
    }
    n=document.getElementById("itype").value;
    if (n=="item")
    {
        window.alert("Select the item type");
        return false;
    }

}

