<!DOCTYPE html>
<html>
    <head>
        <title>
            JS 1st Class
        </title>
    </head>
<body>
   
<center>
    <h1>
        JS Class
    </h1>
</center>
 
 
<script>
 
console.log ("Hello World");
//alert ("Helo World")
 
var name="MR. Kaisha";
var age=40;
var is_human=true;
var empty;
var kali=null;
name2 = 'Amr dam nai';
 
console.log(typeof name);
console.log(typeof age);
console.log(typeof is_human);
console.log(typeof empty);
console.log(typeof kali);
console.log(typeof name2);
var num1=50;
var num2=50;
 
console.log(num1+num2);




function handelsubmt
{
//get values
var name= document.getElementById("name").value;
var age= document.getElementById("age").value;
var id= document.getElementById("ID").value;
var dept= document.getElementById("Depertment").value;

//clear previous error mesgs


if (name===""||age===""||id===""||dept==="")
{
    alert("Fill the box");
    return false;

}

alert("The registration is completed \n " +
"name: " +name + "\n age: "+age+ "\n id: "+ "\n depertment: "+dept)

return false;


}


 
</script>
</body>
 
 
    </html>
 