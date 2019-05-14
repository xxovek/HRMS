// alert('in edit');
function myFunction(){
  // alert("fname");
  document.getElementById("fnameemp").removeAttribute('readonly');
  document.getElementById("fnameemp").focus();
}

function myFunction1(){
  document.getElementById("lnameemp").removeAttribute('readonly');
  document.getElementById("lnameemp").focus();
}

function myFunction3(){
  document.getElementById("bdate").removeAttribute('readonly');
  document.getElementById("bdate").focus();
}


function EmpPanFocus(){
  // alert("k");
  document.getElementById("ePan").removeAttribute('readonly');
  document.getElementById("ePan").focus();
}

function myFunction5(){
  document.getElementById("pincodeemp").removeAttribute('readonly');
  document.getElementById("pincodeemp").focus();
}
function myFunction6(){
  document.getElementById("emailidemp").removeAttribute('readonly');
  document.getElementById("emailidemp").focus();

}
function myFunction7(){
  document.getElementById("contactnoemp").removeAttribute('readonly');
  document.getElementById("contactnoemp").focus();

}

function myFunction8(){
  document.getElementById("addressemp").removeAttribute('readonly');
  document.getElementById("addressemp").focus();
}

function myFunction9(){
  document.getElementById("joindate").removeAttribute('readonly');
  document.getElementById("joindate").focus();
}
function editcountry(){
   $("#scountry2").attr('disabled',false);
}
function editdesignation(){
  $("#empdesignation").attr('disabled',false);
}
function editdepartment(){
  $("#empdepartment").attr('disabled',false);
}
function editstate(){
  $("#sstate2").attr('disabled',false);
}

function editcity(){
  $("#scity2").attr('disabled',false);
}
